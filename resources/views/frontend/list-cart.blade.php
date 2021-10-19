<div class="cart">
            <ul class="tableHead">
                <li style="padding-right:220px" class="prodHeader">Product</li>
                <li>Total</li>
                <li>Remove</li>
            </ul>
            <ul class="cartWrap">
            @if(Session::has("Cart") != null)
                @foreach(Session::get('Cart')->products as $item)
                <li class="items odd">
                                <div class="infoWrap">
                                    <div class="cartSection">
                                        <img src="images/{{$item['productInfo']->photo}}" alt="" class="itemImg" />
                                        <p class="itemNumber">#{{$item['productInfo']->id}}</p>
                                        <h3>{{$item['productInfo']->name}}</h3>

                                        <p><input data-id="{{$item['productInfo']->id}}" class="qty" type="number" id="quanty-item-{{$item['productInfo']->id}}" placeholder="{{$item['quanty']}}" value="{{$item['quanty']}}" />
                                         x ${{$item['productInfo']->price - $item['productInfo']->price*$item['productInfo']->discount /100}}</p>

                                        <p style="cursor:pointer;" class="stockStatus" onclick="SaveListItemCart({{$item['productInfo']->id}});" id="ti-save" >Update</p>
                                    </div>


                                    <div class="prodTotal cartSection">
                                        <p>{{$item['price']}}$</p>
                                    </div>
                                    <div class="cartSection removeWrap">
                                        <a href="#" href="javascript:" onclick="DeleteListItemCart({{$item['productInfo']->id}});" class="remove">x</a>
                                    </div>
                                </div>
                </li>
                @endforeach
            @endif
            </ul>
        </div>

        @if(Session::has("Cart") != null)
        <div id="promoCode" class="promoCode"><label for="promo">Have A Promo Code?</label>
            <form method="POST" action="{{route('check.coupon')}}">
                @csrf
            <input type="text" name="coupon"
                    placholder="Enter Code"  />
            <button type="submit" class="btn"></button>
            </form>
        </div>
        @else
        @endif

        <div class="subtotal cf">
            <button class="btn-update-cart">Update Cart</button>
            <ul>
                <li class="totalRow"><span class="label">Total product</span><span class="value">
                    @if(Session::has("Cart") != null)
                    {{Session::get("Cart")->totalQuanty}}
                    @else 0
                    @endif
                </span>
                </li>
                <li class="totalRow final"><span class="label">Total</span><span class="value">
                    @if(Session::has("Cart") != null)
                    {{number_format(Session::get('Cart')->totalPrice)}}$
                    @else 0
                    @endif
                
                </span>
                </li>
                <li class="totalRow">
                <span class="label">Coupon</span>
                    <span class="value">
                    @if(Session::get('coupon'))
                        @foreach(Session::get('coupon') as $key => $cou)
                        
                            @if($cou['condition'] == 1)
                                Discount: {{$cou['number']}}%
                                    @php
                                    $total_coupon = (Session::get('Cart')->totalPrice * $cou['number'])/100;
                                    echo '<li class="totalRow"><span class="label">Total discount:</span><span class="value">' . $total_coupon . '$</span></li>';
                                    Session::get('Cart')->totalPrice = Session::get('Cart')->totalPrice - $total_coupon;
                                    @endphp
                                <li class="totalRow final"><span class="label">Total</span><span class="value">{{number_format(Session::get('Cart')->totalPrice)}}$</span></li>
                            @elseif($cou['condition'] == 2)
                                     {{$cou['number']}}$ Off
                                        @php
                                        $total_coupon = (Session::get('Cart')->totalPrice -  $cou['number']);
                                        echo '<li class="totalRow final"><span class="label">Total discount:</span><span class="value">' . $total_coupon . '$</span></li>';
                                        Session::get('Cart')->totalPrice = $total_coupon;
                                        @endphp
                            
                            @endif
                        @endforeach

                    @endif
                    
                </span></li>
                
                @if(Session::has("Cart") != null)
                <li class="totalRow"><a href="{{route('checkout')}}" class="btn continue">Checkout</a></li>
                @else 
                @endif
            </ul>
        </div>