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
    {{-- 載入關於我們的頁面css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/index.css') }}">

    {{-- 會員邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/profile.js') }}"></script>
    {{-- 購物車邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/cart.js') }}"></script>
    {{-- 結帳邏輯 --}}
    <script type="text/javascript" src="{{ URL::asset('js/checkout.js') }}"></script>

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
        <div class="cafes">
            <img src="https://images.unsplash.com/photo-1463797221720-6b07e6426c24?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="">
            <div class="introduce">
                <h2>關於我們 - 啡時光</h2>
                <p>歡迎來到啡時光咖啡廳！</p>
                <p>我們是您放鬆身心、享受美味咖啡與輕食的理想場所。</p>
                <p>在這裡，我們致力於提供高品質的咖啡、精緻的輕食以及令人愉悅的用餐體驗，</p>
                <p>讓您在繁忙的生活中找到片刻的寧靜。</p>
            </div>
        </div>
        <div class="cafes">
            <div class="introduce">
                <h2>我們的理念</h2>
                <p>在啡時光，我們相信每一杯咖啡都是一段時光的見證，每一道輕食都是味蕾的享受。</p>
                <p>我們的理念是將新鮮、精選的食材與獨特的烹飪技巧相結合，為您帶來美味與健康的餐點。</p>
                <p>我們的咖啡師擁有豐富的烘焙經驗，精心為您沖泡每一杯香濃的咖啡，帶您展開一場充滿香氣的味覺旅程。</p>
            </div>
            <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="">
        </div>
        <div class="cafes">
            <img src="https://images.unsplash.com/photo-1503481766315-7a586b20f66d?q=80&w=2053&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="">
            <div class="introduce">
                <h2>我們的產品</h2>
                <p>在我們的菜單上，您會找到多種口味豐富的咖啡，從濃郁的拿鐵到清爽的冰美式，都能滿足您的需求。</p>
                <p>此外，我們還提供各式口感豐富的輕食，包括新鮮沙拉、營養豐富的三明治以及美味的甜點，讓您享受健康美味的同時，也滿足您的味蕾需求。</p>
            </div>
        </div>
        <div class="cafes">
            <div class="introduce">
                <h2>我們的服務</h2>
                <p>除了提供美味的食物和飲品之外，</p>
                <p>我們的團隊將以親切、專業的服務態度迎接您的光臨。</p>
                <p>無論您是想在這裡與朋友聊天，還是獨自閱讀一本書，</p>
                <p>我們都希望您在這裡感受到家的溫暖和舒適。</p>
            </div>
            <img src="https://plus.unsplash.com/premium_photo-1686877902053-f507b1ccef4f?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="">
        </div>
    </div>
    <div class="footer">
        <p>
            © 2024 Coffee Time all rights reserved.
        </p>
    </div>

</body>

</html>
