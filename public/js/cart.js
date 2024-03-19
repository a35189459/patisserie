// 初始化購物車
let cart = [];
function openCart() {
    if (cart.length === 0) {
        alert('尚未選購產品');
    } else {
        // 打開/關閉購物車彈出框
        document.getElementById('cartIcon').addEventListener('click', function() {
            const cartPopup = document.getElementById('cartPopup');
            if (cartPopup.style.display === 'block') {
                cartPopup.style.display = 'none';
            } else {
                cartPopup.style.display = 'block';
            }
        });
        document.getElementById('cartPopup').style.display = 'block';
    }
}
// 將商品加入購物車
function addItem(productId, productName, productPrice) {
    let itemExists = false;
    cart.forEach(item => {
        if (item.id === productId) {
            item.quantity++;
            item.totalPrice = item.quantity * productPrice;
            itemExists = true;
        }
    });
    if (!itemExists) {
        cart.push({
            id: productId,
            name: productName,
            price: productPrice,
            quantity: 1,
            totalPrice: productPrice
        });
    }
    alert(productName + ' 已加入購物車');
    // 更新本地儲存
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
}

// DOM載入後才進行渲染
document.addEventListener('DOMContentLoaded', function() {
    
    // 檢查本地儲存是否有購物車內容
    const storedCart = localStorage.getItem('cart');
    if (storedCart) {
        cart = JSON.parse(storedCart);
        renderCart();
    }

    // 渲染購物車列表
    function renderCart() {
        const cartItems = document.getElementById('cartItems');
        const totalPriceElement = document.getElementById('totalPrice');
        let totalPrice = 0; // 初始化總價格為0
        cartItems.innerHTML = ` 
        <li>
            <span class="item-name">商品名稱</span>
            <span class="item-price">單價</span>
            <span class="item-quantity">數量</span>
            <span class="item-price">總價格</span>
            <span class="item-actions">刪除</span>
        </li> 
        `;
        cart.forEach(item => {
            const li = document.createElement('li');
            li.innerHTML = `
            <span class="item-name">${item.name}</span>
            <span class="item-price">${item.price}</span>
            <span class="item-quantity">${item.quantity}</span>
            <span class="item-total">${item.price * item.quantity}</span>
            <span class="item-actions"><button onclick="removeItem(${item.id})"> X </button></span>
        `;
            cartItems.appendChild(li);
            totalPrice += item.price * item.quantity;
        });
        totalPriceElement.innerHTML = `
                <span class="total">總計</span>
                <span class="total-price">${totalPrice}</span>
            `; // 更新總價格的顯示
    }
    // 從購物車中刪除指定的產品項目
    function removeItem(productId) {
        // 在購物車中查找具有指定ID的產品項目的索引
        const index = cart.findIndex(item => item.id === productId);
        // 如果找到了相應的產品項目
        if (index !== -1) {
            // 從購物車中刪除該項目
            cart.splice(index, 1);
            // 更新本地儲存
            localStorage.setItem('cart', JSON.stringify(cart));
            // 重新渲染購物車
            renderCart();
            // 購物車無產品時自動關閉
            if (cart.length === 0) {
                closeCart();
            }
        }
    }

});

// 清空購物車
function clearCart() {
    cart = [];
    localStorage.removeItem('cart');
    closeCart();
}

// 關閉購物車
function closeCart() {
    document.getElementById('cartPopup').style.display = 'none';
}


// 前往購物車結帳頁面
function checkout() {
    // 檢查用戶是否登入
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    const checkoutRoute = document.querySelector('.checkout').getAttribute('data-checkout-route')

    if (!isLoggedIn) {
        // 如果用戶未登入，彈出警告提示
        alert("請先登入後再進行結帳！");
    } else {
        // 如果用戶已登入，導向到結帳頁面
        window.location.href = checkoutRoute;
    }
}