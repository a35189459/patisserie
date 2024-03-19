document.addEventListener('DOMContentLoaded', function() {
    // 在DOM加載完成後才執行
    getAccount();
});

// 切換內容頁
function showForm(formType) {
    const accountForm = document.getElementById('accountForm');
    const orderForm = document.getElementById('orderForm');
    const changeBtn = document.querySelector(".change");
    // 以class中是否有active來顯示表單
    // 有則顯示，無則隱藏
    if (formType === 'account') {
        accountForm.classList.add('active');
        orderForm.classList.remove('active');
    } else if (formType === 'order') {
        orderForm.classList.add('active');
        accountForm.classList.remove('active');
    }

    changeBtn.addEventListener('click', function(e) {
        if (e.target.getAttribute('id') == 'account') {
            account.classList.add('change-active');
            order.classList.remove('change-active');
        } else {
            account.classList.remove('change-active');
            order.classList.add('change-active');
        }
    });
}

function getAccount() {
    const accountRoute = accountForm.getAttribute('data-account-route');
    const user_id = localStorage.getItem('userData');
    const url = `${accountRoute}?user_id=${user_id}`;
    fetch(url)
        .then(response => {
            return response.json();
        })
        .then(data => {
            let account = document.querySelector('.account-list');

            account.innerHTML = `
                        <thead>
                            <tr>
                                <th scope="row" colspan="2">
                                帳戶資訊
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>會員姓名</td>
                                <td>${data.userData.user_name}</td>
                            </tr>
                            <tr>
                                <td>手機號碼</td>
                                <td>${data.userData.user_phone}</td>
                            </tr>
                            <tr>
                                <td>電子信箱</td>
                                <td>${data.userData.user_email}</td>
                            </tr>
                        </tbody>
                    `;
        })
        .catch(error => {
            console.log(error);
        });
}

function getOrderList() {
    const orderRoute = orderForm.getAttribute('data-order-route');
    const user_id = localStorage.getItem('userData');
    const url = `${orderRoute}?user_id=${user_id}`;
    fetch(url)
        .then(response => {
            return response.json();
        })
        .then(data => {
            let orderList = document.querySelector('.order-list');

            data.forEach(order => {
                let totalQuantity = order.order_items.reduce((total, item) => total + item.quantity, 0);
                let totalAmount = order.order_items.reduce((total, item) => total + item.total_price,
                    0);
                orderList.innerHTML += `
                    <div class="order">
                        <h3>訂單編號: ${order.order_id}</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>產品名稱</th>
                                    <th>價格</th>
                                    <th>數量</th>
                                    <th>小計</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${order.order_items.map(item => `
                                                                                                        <tr>
                                                                                                            <td>${item.product_name}</td>
                                                                                                            <td>${item.price}</td>
                                                                                                            <td>${item.quantity}</td>
                                                                                                            <td>${item.total_price}</td>
                                                                                                        </tr>
                                                                                                    `
                                    ).join('')}
                            </tbody>
                        </table>
                        <p>總數量: ${totalQuantity}</p>
                        <p>總金額: ${totalAmount}</p>
                    </div>
                `;

            });
        })
        .catch(error => {
            console.log(error);
        });
}
