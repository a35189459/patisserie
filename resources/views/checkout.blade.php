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
    {{-- 載入結帳頁面css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/checkout/checkout.css') }}">

    {{-- 會員邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/profile.js') }}"></script>
    {{-- 購物車邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/cart.js') }}"></script>
    {{-- 結帳邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/checkout/checkout.js') }}"></script>

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
                <a href="" onclick="openCart()">
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
        <h1>結帳頁面</h1>
        <div>
            <h2>商品清單</h2>
            <ul class="checkout-items" id="checkoutCartItems">
                {{-- 已選購的商品 --}}
            </ul>
            <div id="totalCartPrice"></div>
        </div>
        <form class="checkoutForm" id="checkoutForm" data-checkout-route="{{ route('api.product.checkout') }}"
            data-home-route="{{ route('home') }}">
            <div>
                <h2>顧客資訊</h2>
                <label for="name">姓名 </label>
                <span class="required-field">*必填</span>
                <br>
                <input type="text" id="name" name="name" required>
                <br>
                <label for="phone">聯絡電話 </label>
                <span class="required-field">*必填</span>
                <br>
                <input type="tel" id="phone" name="phone" required>
                <br>
                <label for="email">電子郵件 </label>
                <span class="required-field">*必填</span>
                <br>
                <input type="email" id="email" name="email" required>
                <br>
            </div>

            <div>
                <h2>付款方式</h2>
                <span>※本店目前僅接受臨櫃現金支付</span>
                <br>
                <span class="required-field">*必填</span>
                <br>
                <input type="radio" id="cash" name="payment_method" value="cash" checked>
                <label for="cash">現金</label><br>
                <input type="radio" id="credit_card" name="payment_method" value="credit_card" disabled>
                <label for="credit_card">信用卡</label><br>
            </div>
            <div>
                <h2>備註</h2>
                <textarea id="notes" name="notes" rows="10" cols="50"></textarea>
            </div>
            <button class="checkBtn" type="button" onclick="checkoutOrder()">確認訂單</button>
        </form>
    </div>
    <div class="footer">
        <p>
            © 2024 Coffee Time all rights reserved.
        </p>
    </div>

</body>


</html>
