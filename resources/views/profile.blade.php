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
    {{-- 載入登入註冊畫面css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/profile/profile.css') }}">

    {{-- 會員邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/profile.js') }}"></script>
    {{-- 購物車邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/cart.js') }}"></script>
    {{-- 結帳邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/checkout.js') }}"></script>
    {{-- 登入註冊畫面邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/profile/profile.js') }}"></script>

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
    <div class="container">
        <div class="form">
            <div class="change">
                {{-- 切換登入註冊 --}}
                <button id="register" class="change-active" onclick="showForm('register')">註冊</button>
                <button id="login" onclick="showForm('login')">登入</button>
            </div>
            {{-- 註冊 --}}
            <form class="content active" id="registerForm" data-register-route="{{ route('api.auth.register') }}">
                <label for="user_name">姓名</label><br>
                <input type="text" id="user_name" name="user_name" placeholder="請輸入姓名" required><br>

                <label for="user_phone">手機號碼</label><br>
                <input type="tel" id="user_phone" name="user_phone" placeholder="請輸入電話" required
                    pattern="[0-9]{10}" /><br>

                <label for="user_email">信箱</label><br>
                <input type="email" id="user_email" name="user_email" placeholder="請輸入信箱" required><br>
                <label for="user_password">密碼</label><br>
                <div class="password-input">
                    <input type="password" class="register_password" id="user_password" name="user_password"
                        placeholder="請輸入密碼">
                    <button class="btn" type="button" onclick="showPassword(this)">顯示</button>
                </div><br>
                <div class="send-btn">
                    <button class="send" type="submit" onclick="sendRegistrationRequest(event)">註冊</button>
                </div>
            </form>
            {{-- 登入 --}}
            <form class="content" id="loginForm" data-login-route="{{ route('api.auth.login') }}"
                data-home-route="{{ route('home') }}">
                <label for="user_email">信箱</label><br>
                <input type="email" id="user_email" name="user_email" placeholder="請輸入信箱"><br>

                <label for="user_password">密碼</label><br>
                <div class="password-input">
                    <input type="password" class="login_password" id="user_password" name="user_password"
                        placeholder="請輸入密碼">
                    <button class="btn" type="button" onclick="showPassword(this)">顯示</button>
                </div><br>
                <div class="send-btn">
                    <button class="send" type="submit" onclick="submitLoginForm(event)">登入</button>
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        <p>
            © 2024 Coffee Time all rights reserved.
        </p>
    </div>

</body>

</html>
