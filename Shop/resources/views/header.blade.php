<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    <b>hello.colorlib@gmail.com</b>
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    +65 11.188.888
                </div>
            </div>
            <div class="ht-right">
                <a href="#" class="login-panel">
                    <i class="fa fa-user"></i>
                    Login
                </a>
                <div class="lan-selector">
                    <select class="language_drop" name="countries" id="countries" style="width:300px;">
                        <option value='yt' data-image="img/flag-1.jpg" data-imagecss="flag yt" data-title="English">
                            English
                        </option>
                        <option value='yu' data-image="img/flag-2.jpg" data-imagecss="flag yu" data-title="Bangladesh">
                            German </option>
                    </select>
                </div>
                <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="#">
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
                        <button type="button" class="category-btn">All Categories</button>
                        <form action="#" class="input-group">
                            <input type="text" placeholder="What do you need?">
                            <button type="button"><i class="ti-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                        <li class="heart-icon"><a href="#">
                                <i class="icon_heart_alt"></i>
                                <span>1</span>
                            </a>
                        </li>
                        <li class="cart-icon">
                            @if(Session::has('cart'))
                            <a href="#">
                                <i class="icon_bag_alt"></i>
                                <span>@if(Session::has('cart')){{Session('cart')->totalQty}}@else Trong @endif</span>

                            </a>
                            <div class="cart-hover">
                                <div class="select-items">
                                    <table>
                                        <tbody>
                                            @foreach($product_cart as $products)
                                            <tr>
                                            
                                                <td id="cart-item{{$products['item']['id']}}" class="si-pic"><img style="width: 100px; height: 100px;" src="{{$products['item']['image']}}" alt=""></td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <div class="quantity-selector">
                                                            <button class="quantity-minus">-</button>
                                                            <span class="quantity-value">{{$products['qty']}}</span>
                                                            <button class="quantity-plus">+</button>
                                                            * <span>{{$products['item']['price']}} đồng</span>
                                                        </div>
                                                        
                                                        <h6>{{$products['item']['name']}}</h6>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <a 	 class="cart-item-delete" href="del-cart/{{$products['item']['id']}}" value="{{$products['item']['id']}}" soluong="{{$products['qty']}}"><i class="fa fa-times"></i><img src="source/image/product/{{$products['item']['image']}}" alt=""></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="select-total">
                                    <span>total:</span>
                                    <h5>{{number_format(Session('cart')->totalPrice)}} đồng</h5>
                                </div>
                                <div class="select-button">
                                    <a href="/shoping-cart" class="primary-btn view-card">VIEW CARD</a>
                                    <a href="/check-out" class="primary-btn checkout-btn">CHECK OUT</a>
                                </div>
                            </div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <div class="nav-depart">
                <div class="depart-btn">
                    <i class="ti-menu"></i>
                    <span>All departments</span>
                    <ul class="depart-hover">
                        <li class="active"><a href="#">Women’s Clothing</a></li>
                        <li><a href="#">Men’s Clothing</a></li>
                        <li><a href="#">Underwear</a></li>
                        <li><a href="#">Kid's Clothing</a></li>
                        <li><a href="#">Brand Fashion</a></li>
                        <li><a href="#">Accessories/Shoes</a></li>
                        <li><a href="#">Luxury Brands</a></li>
                        <li><a href="#">Brand Outdoor Apparel</a></li>
                    </ul>
                </div>
            </div>
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Collection</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Pages</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>

<script>
    // Lấy tất cả các nút tăng giảm số lượng
var quantityMinusButtons = document.querySelectorAll('.quantity-minus');
var quantityPlusButtons = document.querySelectorAll('.quantity-plus');

// Xử lý sự kiện khi nhấn nút tăng giảm số lượng
quantityMinusButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var quantityValue = this.nextElementSibling;
        var currentQuantity = parseInt(quantityValue.textContent);

        if (currentQuantity > 1) {
            quantityValue.textContent = currentQuantity - 1;
            updateTotalPrice(-1, this);
        }
    });
});

quantityPlusButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var quantityValue = this.previousElementSibling;
        var currentQuantity = parseInt(quantityValue.textContent);

        quantityValue.textContent = currentQuantity + 1;
        updateTotalPrice(1, this);
    });
});

// Hàm cập nhật tổng giá
function updateTotalPrice(quantityChange, button) {
    var productPrice = parseFloat(button.closest('.si-text').querySelector('.product-selected span').textContent);
    var totalPriceElement = document.querySelector('.select-total h5');
    var currentTotalPrice = parseFloat(totalPriceElement.textContent.replace(/[^0-9.-]+/g,""));
    var newTotalPrice = currentTotalPrice + (quantityChange * productPrice);

    totalPriceElement.textContent = newTotalPrice.toFixed(2) + ' đồng';
}

</script>