<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>啡時光</title>
    {{-- css-reset --}}
    <link rel="stylesheet" href="{{ URL::asset('css/cssReset.css') }}">
    {{-- 載入頁首的css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    {{-- 載入購物車css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/cart.css') }}">
    {{-- 載入頁尾css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/footer.css') }}">

    {{-- 會員邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/profile.js') }}"></script>
    {{-- 購物車邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/cart.js') }}"></script>
    {{-- 結帳邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/checkout.js') }}"></script>

    <style>
        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .contact-form {
            height: 100vh;
        }

        .content h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .contact {
            display: flex;
            justify-content: center;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
        }

        .contact input {
            margin: 10px 30px 20px 30px;
            line-height: 22px;
            border: 1px solid #b2b2b2;
            text-align: center;
        }

        .contact textarea {
            margin: 10px 30px 20px 30px;
            border: 1px solid #b2b2b2;
            text-align: center;
        }

        .send-btn button {
            padding: 10px;
            border: 0;
            background: #b88440;
            color: white;
            font-size: 18px;
        }

        #letter_content {
            resize: none;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="https://firebasestorage.googleapis.com/v0/b/frontback-rong.appspot.com/o/%E5%92%96%E5%95%A1%E5%BB%B3%E7%85%A7%E7%89%87%2F%E5%92%96%E5%95%A1%E5%BB%B3logo.png?alt=media&token=f051848b-ee7c-461b-a528-60f7c1884b81"
                    alt="">
            </a>
        </div>
        <div class="nav">
            <ul class="nav-list">
                <li><a href="{{ route('home') }}">關於啡時光</a></li>
                <li><a href="{{ route('product') }}">線上菜單</a></li>
                <li><a href="{{ route('coffee') }}">咖啡介紹</a></li>
                <li><a href="{{ route('contact') }}">商業合作</a></li>
            </ul>
            <span id="cartIcon">
                <a href="#" onclick="openCart()">
                    <img class="cart-logo"
                        src="https://firebasestorage.googleapis.com/v0/b/frontback-rong.appspot.com/o/%E5%92%96%E5%95%A1%E5%BB%B3%E7%85%A7%E7%89%87%2F%E8%B3%BC%E7%89%A9%E8%BB%8Aicon.png?alt=media&token=f8e41f40-8ab6-4814-acca-e4381fa25e84"
                        alt="">
                </a>
            </span>
            <button class="authButton" id="authButton" data-member-route="{{ route('member') }}"
                data-profile-route="{{ route('profile') }}">
                <script>
                    const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
                </script>
            </button>
        </div>
    </div>
    {{-- 彈出式購物車 --}}
    <div>
        <div class="product-item">
        </div>

        <div class="cart-popup" id="cartPopup">
            <h2>
                購物車
                <button class="close-cart" onclick="closeCart()">X</button>
            </h2>
            <ul class="cart-items" id="cartItems">
                {{-- 已選購的商品 --}}
            </ul>
            <div id="totalPrice"></div>
            <div class="cart-btn">
                <button onclick="clearCart()">清空</button>
                <button class="checkout" onclick="checkout()" data-checkout-route="{{ route('checkout') }}">結帳</button>
            </div>
        </div>
    </div>

    <div class="content">
        <div>
            <h2>商業合作</h2>
            <p>若您對啡時光的通路合作或商品聯名販售有興趣，歡迎填寫表單與我們聯絡！ 也可直接來信至： xxxxxx@gmail.com</p>
        </div>
        <div>
            <form class="contact-form" id="contactForm" method="get" action="{{ route('api.user.contact') }}"
                target="nm-iframe">
                <div class="contact">
                    <div>
                        <label for="contact_person">姓名</label><br>
                        <input type="text" id="contact_person" name="contact_person" placeholder="請輸入姓名"
                            required><br>
                        <label for="contact_phone">手機號碼</label><br>
                        <input type="tel" id="contact_phone" name="contact_phone" placeholder="請輸入電話" required
                            pattern="[0-9]{10}" /><br>
                        <label for="contact_email">信箱</label><br>
                        <input type="email" id="contact_email" name="contact_email" placeholder="請輸入信箱" required><br>
                    </div>

                    <div>
                        <label for="letter_title">信件主旨</label><br>
                        <input type="text" id="letter_title" name="letter_title" size="40" placeholder="請輸入信件主旨"
                            required><br>
                        <label for="letter_content">信件內容</label><br>
                        <textarea id="letter_content" name="letter_content" rows="8" cols="40" placeholder="請輸入信件內容" required></textarea>
                    </div>
                </div>

                <div class="send-btn">
                    <button class="send" type="submit">送出</button>
                </div>
            </form>
            {{-- 預防表單送出後跳轉 --}}
            <iframe id="id-iframe" name="nm-iframe" style="display-none;"></iframe>
        </div>
    </div>

    <div class="footer">
        <p>
            © 2024 Coffee Time all rights reserved.
        </p>
    </div>
    <script>
        // 送出合作邀請
        document.getElementById("contactForm").addEventListener("submit", sendContact);

        function sendContact() {
            alert("表單已送出，請耐心等候聯繫~");
            // 延遲表單清空，避免未送出資料就清空
            setTimeout(clearInput, 500);
        }
        // 清空表單字段
        function clearInput() {

            document.getElementById("contact_person").value = "";
            document.getElementById("contact_phone").value = "";
            document.getElementById("contact_email").value = "";
            document.getElementById("letter_title").value = "";
            document.getElementById("letter_content").value = "";
        }
    </script>
</body>

</html>
