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
    {{-- 載入介紹咖啡頁面css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/coffee/coffee.css') }}">

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
        <div class="content-item">
            <h2>咖啡豆介紹</h2>
            <h4>◆ 咖啡豆</h4>
            <p>咖啡樹屬於灌木，播種三到五年後，開白色花，結綠色果實，待成熟後，變成黃色，再變成鮮紅色的成熟果實(cherry)。果實的果肉很薄，嘗起來甜甜的，裡面一對橢圓形的種子，就是我們俗稱的咖啡豆。咖啡豆通常是成對的，果實是由外皮、果肉、內果皮、銀皮以及包在最裡面的種子（咖啡豆）所形成。
            </p>
            <br>
            <h4>◆ 咖啡生長帶</h4>
            <p>生長的區域大約是在南北迴歸線之間，該區較多肥沃有機質土壤，平均氣溫攝氏二十度左右，平均年雨量1,000-2,000mm之間，是理想的咖啡生長產地。全世界五大洲之中，生長咖啡豆的只有非洲、亞洲、美洲。(cherry)。果實的果肉很薄，嘗起來甜甜的，裡面一對橢圓形的種子，就是我們俗稱的咖啡豆。咖啡豆通常是成對的，果實是由外皮、果肉、內果皮、銀皮以及包在最裡面的種子（咖啡豆）所形成。
            </p>
            <br>
            <h4>◆ 咖啡豆種類</h4>
            <p>目前，市場佔有率最重要的兩項咖啡品種為Arabica & Robusta： Arabica
                –種植在海拔較高的區域，須特別細心照顧；其所含油脂成分較多並具有濃郁的芳香氣息，含有較複雜的風味，咖啡因含量也較少，無強烈的苦味，咖啡產量低，因此通常價位也較高。 Robusta
                –低地栽培的咖啡豆，所含油脂較少，特徵為味道較重，具強烈苦味，咖啡因含量為Arabica的3倍，雖適應力強、產量大、抗蟲害但品質較差。</p>
        </div>
        <hr>
        <div class="content-item">
            <h2>咖啡豆處理</h2>
            <h4>◆ 日曬法Nature Dry (又稱乾式加工法)</h4>
            <p>果實採收後，將果實攤放在露天日曬場，以陽光曝曬乾燥。為避免乾燥不平均或發酵，必須適時攪拌。日曬天數視果實的成熟度而定，成熟度愈高則僅需數日，未成熟的果實需要曬上ㄧ至二週。</p>
            <br>
            <h4>◆ 水洗法Washed (又稱濕式加工法)</h4>
            <p>
                首先將咖啡果實的果肉去除，接著用發酵槽去除殘留在果皮上的黏膜，豆子清洗過後加以乾燥。可以透過每個步驟去除瑕疵豆與雜質(石頭或垃圾等)，因此生豆的水準極高，外觀均一，普遍被認為具有高品質。
            </p>
            <br>

            <h4>◆ 半水洗法Semi Washed</h4>
            <p>
                介於日曬法與水洗法中間。先將收成的咖啡果實水洗後，再用機械去除外皮的果肉，用日光使之乾燥，再用機器乾燥結束。與水洗法的不同之處，在於過程中不將咖啡果實放入發酵槽，品質上又比日曬法穩定。
            </p>
            <br>

            <h4>◆ 半日曬處理法Pulped Nattural</h4>
            <p>
                此法是部分使用日曬處理的咖啡園，為了提升日曬法咖啡豆品質而改良出來的。半日曬法的前兩個步驟和水洗法一樣，先初步篩除浮豆，然後去除果皮、果肉。接下來步驟就像日曬法了，將只剩果膠的種子，以日曬的方式進行乾燥。
            </p>
        </div>
        <hr>
        <div class="content-item">
            <h2>咖啡豆的烘培</h2>
            <p>不同程度的焙炒-喚醒香氣的精靈：咖啡的顏色、香氣是透過烘焙過程的複雜化學變化所形成的，並以烘焙的時間與溫度決定其風味，基本上烘焙程度代表咖啡豆受熱程度與焦化程度，隨著烘焙度越深咖啡豆體積會隨之變大，外觀顏色逐漸變黑，咖啡口感會由酸味轉成甜味、鹹味最後變成苦味；香氣則會由花香味轉變成果核香氣、咖啡、巧克力香氣最後焦炭味。
            </p>
        </div>
        <hr>
        <div class="content-item">
            <h2>咖啡豆的保存</h2>
            <h4>◆喝多少磨多少</h4>
            <p>避免品嘗時間較長，風味流失的情況，未磨成細粉的咖啡豆，較不易因與空氣接觸，而產生風味的變化。</p>
            <br>
            <h4>◆ 放置陰涼處或冷藏保存</h4>
            <p>在沖泡之前，請取出適量咖啡豆，離開冷藏約15~20分鐘，使其回到常溫，喚醒咖啡豆中的芳香物質，使沖煮後的咖啡香氣完全展現。</p>
            <br>
            <h4>◆ 單向透氣閥袋</h4>
            <p>將磨好或未磨好的豆子，放置此類型的咖啡豆袋內保存，若是家中有不透光的密封罐，也是非常適合用來保存咖啡豆。</p>
        </div>
        <hr>
        <div class="content-item">
            <h2>咖啡品嚐</h2>
            <h4>◆ 品嚐4步驟</h4>
            <p>咖啡最佳飲用期為焙炒後7-45天，且新鮮能表現出最佳的香味。</p>
            <br>
            <ol>
                <li>『聞』品嚐咖啡的香氣：品嚐咖啡前的第一個感受。</li>
                <li>『啜飲』咖啡的酸和苦：用力吸取一口，將咖啡散佈在舌尖裡，讓充滿咖啡的口腔，慢慢體會味蕾所呈現出的酸、甜、苦等風味。</li>
                <li>『感受』咖啡的香醇：小酌咖啡含在口中，並在舌尖內慢慢攪動，與唾液中和，感受咖啡的濃稠度及原始風味。</li>
                <li>『分享』咖啡的滋味：在聞、啜飲、感受等步驟後，用自己品嚐到的感受與經驗，與周圍的人分享感觸和印象。</li>
            </ol>
        </div>
        <hr>
        <div class="content-item">
            <h2>何謂Espresso</h2>
            <h4>◆ 一種烹調咖啡的方式</h4>
            <p>快速烹調咖啡，以機器的壓力萃取。</p>
            <br>
            <h4>◆ 一種綜合咖啡豆的名稱</h4>
            <p>指一種綜合咖啡豆，專為espresso機器烘焙的咖啡豆。厚實的crema、濃郁的口感中帶有巧克力的香氣，非常適合純飲或花式變化。</p>
            <br>
            <h4>◆ 一種咖啡飲料的名稱</h4>
            <p>是一種濃縮，粹取咖啡香醇精華的飲料。使用8g的咖啡粉萃取出約30c.c的濃縮精華，呈現赭紅色的黃金泡沫與醇厚的口感。</p>
            <br>
            <h4>◆ 完美的Espresso Shot – 涵蓋3個層面的享受</h4>
            <ul>
                <li>濃郁的黃金泡沫 (呈現赭紅色、綿密的金黃泡沫-濃稠且持久)</li>
                <li>醇厚的口感 (涵蓋-甜、酸、苦的均衡表現，厚實滑順)</li>
                <li>風味餘韻 (獨特性、整體延續性強)</li>
            </ul>
        </div>
        <hr>
        <div class="content-item">
            <h2>何謂手沖咖啡</h2>
            <ul>
                <li>咖啡粉放入濾紙和濾杯中，注入82℃~92℃熱水，並在濾杯下方放上任何壺或杯，盛接滴出的咖啡，因此又稱作「滴漏式咖啡」。</li>
                <li>藉由濾紙濾去咖啡油脂雜質，更鮮明且完整地嘗到隱藏在咖啡豆中的多元層次風味。</li>
            </ul>
        </div>
    </div>

    <div class="footer">
        <p>
            © 2024 Coffee Time all rights reserved.
        </p>
    </div>

</body>

</html>
