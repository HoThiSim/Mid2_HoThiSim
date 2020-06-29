
	@if (Auth::check())
    <div class="header-top">
        <div class="pull-left auto-width-left">
            <ul class="top-menu menu-beta l-inline">
                <li><a href=""><i class="fa fa-home"></i> {{ Auth::user()->address }} </a></li>
                <li><a href=""><i class="fa fa-phone"></i>{{ Auth::user()->phone }}</a></li>
            </ul>
        </div>
        <div class="pull-right auto-width-right">
            <ul class="top-details menu-beta l-inline">
                <li><a href="#"><i class="fa fa-user"></i>{{ Auth::user()->full_name }}</a></li>
            </ul>
            <form  action="/logout" method="post">
                @csrf
                <button type="submit">Đăng xuất</button>
            </form>
        </div>
    </div>
    @else
    <div class="header-top">
        <div class="pull-left auto-width-left">
            <ul class="top-menu menu-beta l-inline">
                <li><a href=""><i class="fa fa-home"></i> </a></li>
                <li><a href=""><i class="fa fa-phone"></i></a></li>
            </ul>
        </div>
        <div class="pull-right auto-width-right">
            <ul class="top-details menu-beta l-inline">
               <li><a href="/login">Đăng nhập</a></li>
               <li><a href="/register">Đăng ký</a></li>
            </ul>
        </div>
    </div>
    @endif
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="/index" id="logo"><img src="source/assets/dest/images/logo-cake.png" width="200px" alt=""></a>
				</div>
				<div class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="/">
					        <input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." />
					        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>

					<div class="beta-comp">
                       	@if(Session::has('cart'))
		<div class="cart">
			<div style="font-weight: bold ;font-size: 15px; color: chocolate" class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (@if(Session::has('cart')){{Session('cart')->totalQty}}@else Trong @endif) <i class="fa fa-chevron-down"></i></div>
			<div class="beta-dropdown cart-body">

				@foreach($product_cart as $product)
					<div class="cart-item" id="cart-item{{$product['item']['id']}}">
					<a class="cart-item-delete" href="{{route('xoagiohang',$product['item']['id'])}}" value="{{$product['item']['id']}}" soluong="{{$product['qty']}}"><i class="fa fa-times"></i></a>
					<div class="media">
						<a class="pull-left" href="#"><img src="source/image/product/{{$product['item']['image']}}" alt=""></a>
						<div class="media-body">
							<span class="cart-item-title">{{$product['item']['name']}}</span>
                            <span class="cart-item-amount">{{$product['qty']}}*
                                <span id="dongia{{$product['item']['id']}}" value="
                                    @if($product['item']['promotion_price']==0){{($product['item']['unit_price'])}}
                                    @else
                                      {{($product['item']['promotion_price'])}}
                                    @endif">
                                    @if($product['item']['promotion_price']==0){{number_format($product['item']['unit_price'])}}
                                    @else
                                        {{number_format($product['item']['promotion_price'])}}
                                    @endif
                                </span>
                            </span>
						</div>
					</div>
				</div>
				@endforeach

				<div class="cart-caption">
						<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value" value="@if(Session::has('cart')){{($totalPrice)}}@else 0 @endif">@if(Session::has('cart')){{number_format($totalPrice)}}@else 0 @endif đồng</span></div>
					<div class="clearfix"></div>

					<div class="center">
                        <div class="space10">&nbsp;</div>
                        @if (Auth::check())
                        <a href="{{route('dathang')}}" style="font-weight: bold ;font-size: 15px; color: orange" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                        @else
                        <a href="/login" style="font-weight: bold ;font-size: 15px; color: orange" class="beta-btn primary text-center">Đăng nhập để đặt hàng <i class="fa fa-chevron-right"></i></a>
                        @endif
					</div>
				</div>
			</div>
		</div> <!-- .cart -->
	@endif
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom" style="background-color: #0277b8;">
			<div class="container">
				<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a style="font-weight: bold ;font-size: 15px" href="/index">Trang chủ</a></li>
						<li><a style="font-weight: bold ;font-size: 15px" href="#"> Loại Sản phẩm</a>
							<ul class="sub-menu">
                                @foreach ( $loai_sp as $loai )
								    <li><a href="{{ route('loaisanpham',$loai->id) }}">{{ $loai->name }}</a></li>
                                @endforeach
							</ul>
						</li>
						<li><a style="font-weight: bold ;font-size: 15px ;" href="{{ route('about') }}">Giới thiệu</a></li>
						<li><a style="font-weight: bold ;font-size: 15px" href="{{ route('lienhe') }}">Liên hệ</a></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
    </div> <!-- #header -->
