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
    {{-- 載入會員資料css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/member/member.css') }}">

    {{-- 會員邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/profile.js') }}"></script>
    {{-- 會員登出邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/logout.js') }}"></script>
    {{-- 購物車邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/cart.js') }}"></script>
    {{-- 結帳邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/checkout.js') }}"></script>
    {{-- 會員資料邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/member/member.js') }}"></script>

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
        <div class="change">
            {{-- 切換內容頁 --}}
            <button id="account" class="change-active" onclick="showForm('account') , getAccount()">帳戶資訊</button>
            <button id="order" onclick="showForm('order'),getOrderList()">訂單總覽</button>
            <button id="logoutBtn" onclick="logout(event)" id="logoutBtn"
                data-logout-route="{{ route('api.auth.logout') }}" data-home-route="{{ route('home') }}">登出</button>

        </div>
        <div class="form">
            {{-- 帳戶資訊 --}}
            <form class="content active" id="accountForm" data-account-route="{{ route('api.user.info') }}">
                <table class="account-list">

                </table>

            </form>
            {{-- 訂單總覽 --}}
            <form class="content" id="orderForm" data-order-route="{{ route('api.product.orderList') }}">
                <div class="order-list">

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
