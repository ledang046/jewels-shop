                           <div class="shopping-cart"> 
                            @if(Session::has("Cart") != null)
                                <div class="shopping-cart-header">                                  
                                    <div class="shopping-cart-total">
                                        <span class="lighter-text">Total:</span>
                                        <span
                                            class="main-color-text">{{number_format(Session::get('Cart')->totalPrice)}}$</span>
                                    </div>
                                </div>
                                <!--end shopping-cart-header -->

                                <ul class="shopping-cart-items">
                                    @foreach(Session::get('Cart')->products as $item)
                                    <li class="clearfix">
                                        <span data-id="{{$item['productInfo']->id}}" class="del-cart"><i
                                                class="far fa-trash-alt"></i></span>
                                        <img style="width:30%;" src="{{asset('images/'.$item['productInfo']->photo)}}"
                                            alt="item1">
                                        <span class="item-name">{{$item['productInfo']->name}}</span>
                                        <span class="item-price">${{$item['productInfo']->price - $item['productInfo']->price*$item['productInfo']->discount /100}}</span>
                                        <span class="item-quantity">Quantity:{{$item['quanty']}}</span>

                                    </li>
                                    @endforeach
                                </ul>
                                <input hidden id="total-quanty-cart" type="number"
                                    value="{{Session::get('Cart')->totalQuanty}}">
                                    <a href="{{url('/List-Cart')}}" class="checkout-view">View Cart</a>
                            @endif  
                            </div>
                            <!--end shopping-cart -->
                          