document.addEventListener('DOMContentLoaded', function() {
    // 在DOM加載完成後才執行
    let prod = document.querySelector('.product-list');

    // user 選擇類別
    // 預設網頁顯示咖啡
    getCategory(1);
    prod.addEventListener('click', function(e) {
        if (e.target.nodeName != 'A') {
            return;
        }
        if (e.target.className == 'coffee') {
            getCategory(1);
        } else if (e.target.className == 'tea') {
            getCategory(2);
        } else if (e.target.className == 'sandwich') {
            getCategory(3);
        } else if (e.target.className == 'cake') {
            getCategory(4);
        } else if (e.target.className == 'fired') {
            getCategory(5);
        };
    });

    // 產品種類
    function getCategory(category_id) {
        const prodRoute = prod.getAttribute('data-list-route');
        const url = `${prodRoute}?category_id=${category_id}`;
        fetch(url)
            .then(response => {
                return response.json();
            })
            .then(data => {
                if(data == ''){
                    alert('產品正在研發中，敬請期待!');
                }
                
                let prodItem = document.querySelector('.product-item');

                prodItem.innerHTML = '';
                data.forEach(productData => {

                    let item = document.createElement('ul');
                    item.classList.add('item');
                    item.innerHTML = `
                            <li class="prodDetail">
                                <div class="pic"><img src="${productData.image_url}" /></div>
                                <h3 class="title" title="${productData.prod_name}">${productData.prod_name}</h3>
                                <p class="price">售價 ${productData.price}</p>
                                <p class="description">${productData.description}</p>
                                <button class="add-itme" onclick="addItem(${productData.prod_id},'${productData.prod_name}', ${productData.price})">加入購物車</button>
                            </li>
                        `;

                    prodItem.appendChild(item);
                });
            })
            .catch(error => {
                console.log(error);
            });
    }
});
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

// 檢查本地儲存是否有購物車內容
const storedCart = localStorage.getItem('cart');
if (storedCart) {
    cart = JSON.parse(storedCart);
    renderCart();
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