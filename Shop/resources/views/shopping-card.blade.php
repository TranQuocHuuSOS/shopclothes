
@extends('master')

    <!-- Header End -->
    @section('content')


    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./home.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
   <!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name">Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (session('cart') && count(session('cart')->items) > 0)
                                @foreach (session('cart')->items as $id => $item)
                                    <tr>
                                        <td class="cart-pic first-row"><img src="{{ $item['item']->image }}" alt=""></td>
                                        <td class="cart-title first-row">
                                            <h5>{{ $item['item']->name }}</h5>
                                        </td>
                                        <td class="p-price first-row">{{ $item['item']->price }}</td>
                                        <td class="qua-col first-row">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{ $item['qty'] }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="total-price first-row">{{ $item['price'] }}</td>
                                        <td class="close-td first-row"><i class="ti-close"></i></td>
                                        <td class="close-td first-row"><i class="ti-save"></i></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">No items in the cart</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 offset-lg-8">
                        <div class="proceed-checkout">
                            @if (session('cart') && count(session('cart')->items) > 0)
                                <ul>
                                    <li class="subtotal">Subtotal <span>{{ session('cart')->totalPrice }}</span></li>
                                    <li class="cart-total">Total <span>{{ session('cart')->totalPrice }}</span></li>
                                </ul>
                                <a href="#" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    
@endsection