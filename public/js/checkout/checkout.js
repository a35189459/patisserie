// 在頁面加載完成後渲染購物車
document.addEventListener('DOMContentLoaded', function() {
    if (cart) {
        renderCart();
    }
});
// 渲染購物車列表
function renderCart() {
    const cartItems = document.getElementById('checkoutCartItems');
    const totalPriceElement = document.getElementById('totalCartPrice');
    let totalPrice = 0;
    cartItems.innerHTML = ''; // 清空購物車列表
    cartItems.innerHTML = ` 
        <li>
            <span class="check-name">商品名稱</span>
            <span class="check-price">單價</span>
            <span class="check-quantity">數量</span>
            <span class="check-price">總價格</span>
        </li> 
        `;
    cart.forEach(item => {
        const li = document.createElement('li');
        li.innerHTML = `
            <span class="check-name">${item.name}</span>
            <span class="check-price">${item.price}</span>
            <span class="check-quantity">${item.quantity}</span>
            <span class="check-total">${item.price * item.quantity}</span>
        `;
        cartItems.appendChild(li);
        totalPrice += item.price * item.quantity;
    });
    totalPriceElement.innerHTML = `
        <span class="total">總計</span>
        <span class="total-price">${totalPrice}</span>
    `;
}
function checkoutOrder() {
    // 獲取顧客資訊
    const name = document.getElementById('name').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const notes = document.getElementById('notes').value;
    const cashInput = document.getElementById('cash');
    const creditCardInput = document.getElementById('credit_card');
    const user_id = localStorage.getItem('userData');
    let payment_method = '';
    // 付款方式
    if (cashInput.checked) {
        payment_method = 'cash';
    } else if (creditCardInput.checked) {
        payment_method = 'credit_card';
    }
    if (name == '' || phone == '' || email == '' || payment_method == '') {
        alert('請填寫完整訂購資訊');
        return;
    }
    // 計算訂單總數和總金額
    let totalQuantity = 0;
    let amount = 0;
    cart.forEach(item => {
        totalQuantity += item.quantity;
        amount += item.totalPrice;
    });
    // 訂單資訊物件
    const orderData = {
        user_id: user_id,
        user_name: name,
        user_phone: phone,
        user_email: email,
        payment_method: payment_method,
        notes: notes,
        items: cart,
        total_quantity: totalQuantity,
        amount: amount
    };
    const checkoutRoute = document.getElementById('checkoutForm').getAttribute('data-checkout-route');
    const homeRoute = document.getElementById('checkoutForm').getAttribute('data-home-route');
    // 使用fetch發送POST請求
    fetch(checkoutRoute, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(orderData), // 將orderData轉換為JSON字符串
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            alert(data.message);
            // 清空購物車
            clearCart();
            // 導回首頁
            window.location.href = homeRoute;
        })
        .catch(error => {
            console.log(error);
        });
}
