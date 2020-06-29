@extends('master')
@section('content')
<div class="container">
	<div id="content">
        @include('error');
		<form action="{{route('dathang')}}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="row">@if(Session::has('thongbao')){{Session::get('thongbao')}}@endif</div>
			<div class="row">
				<div class="col-sm-6">
					<h4 style="font-weight: bold ">Đặt hàng</h4>
					<div class="space20">&nbsp;</div>

					<div class="form-block">
						<label style="font-weight: bold" for="name">Họ tên*</label>
						<input type="text" name="name" placeholder="Họ tên" value="{{ Auth::user()->full_name }}">
					</div>
					<div class="form-block">
						<label style="font-weight: bold">Giới tính </label>
						<input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
						<input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>

					</div>

					<div class="form-block">
						<label style="font-weight: bold" for="email">Email*</label>
						<input type="email" id="email" name="email"  placeholder="expample@gmail.com" value="{{ Auth::user()->email }}">
					</div>

					<div class="form-block">
						<label style="font-weight: bold" for="adress">Địa chỉ*</label>
						<input type="text" id="address" name="address" placeholder="Street Address" value="{{ Auth::user()->address }}"  >
					</div>


					<div class="form-block">
						<label style="font-weight: bold" for="phone">Điện thoại*</label>
						<input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}">
					</div>

					<div class="form-block">
						<label style="font-weight: bold" for="notes">Ghi chú</label>
						<textarea id="notes" name="notes"></textarea>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="your-order">
						<div class="your-order-head" style="font-weight: bold" ><h4>Đơn hàng của bạn</h4></div>
						<div class="your-order-body" style="padding: 0px 10px">
							<div class="your-order-item">
								<div>
								@if(Session::has('cart'))
								@foreach($product_cart as $cart)
								<!--  one item	 -->
									<div class="media">
										<img width="25%" src="source/image/product/{{$cart['item']['image']}}" alt="" class="pull-left">
										<div class="media-body" >
											<p style=" margin-bottom: 15px; font-weight: bold ; color:brown" class="font-large">{{$cart['item']['name']}}</p>
											<span class="color-gray your-order-info" style="font-weight: bold ; color: black" >Đơn giá: {{number_format($cart['price'])}} đồng</span>
											<span class="color-gray your-order-info" style="font-weight: bold; color: black">Số lượng: {{$cart['qty']}}</span>
										</div>
									</div>
								<!-- end one item -->
								@endforeach
								@endif
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="your-order-item">
								<div class="pull-left"><p style="font-weight: bold" class="your-order-f18">Tổng tiền:</p></div>
								<div class="pull-right"><h5 class="color-black">@if(Session::has('cart')){{number_format($totalPrice)}}@else 0 @endif đồng</h5></div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="your-order-head"><h5 style="font-weight: bold">Hình thức thanh toán</h5></div>

						<div class="your-order-body">
							<ul class="payment_methods methods">
								<li class="payment_method_bacs">
									<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
									<label for="payment_method_bacs" style="font-weight: bold">Thanh toán khi nhận hàng </label>
									<div class="payment_box payment_method_bacs" style="display: block; font-size: 15px">
										Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
									</div>
								</li>

								<li class="payment_method_cheque">
									<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
									<label for="payment_method_cheque" style="font-weight: bold">Chuyển khoản </label>
									<div class="payment_box payment_method_cheque" style="display: none; font-size: 15px">
										Chuyển tiền đến tài khoản sau:
										<br>- Số tài khoản: 123 456 789
										<br>- Chủ TK: Hồ Thị Sim
										<br>- Ngân hàng Hí Anita, Chi nhánh Đà Nẵng
									</div>
								</li>

							</ul>
						</div>

						<div class="text-center">
                            <button style="font-weight: bold" type="submit" class="beta-btn primary" > Đặt hàng
                                <i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
					</div> <!-- .your-order -->
				</div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection
