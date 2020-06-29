<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Cart;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\RegisterRequest;
use App\Product;
use App\ProductType;
use App\Slide;
use App\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function getIndex(){
        $slide = Slide::all();
        $new_product=Product::where('new',1)->paginate(8);
        $sanpham_khuyenmai =Product::where('promotion_price','<>',0)->paginate(4);
        return view('page.trangchu', compact('slide','new_product','sanpham_khuyenmai'));
    }

    public function getLoaiSp($type){

        $sp_theoloai= Product::where('id_type',$type)->get();

        $sp_khac= Product::where('id_type','<>',$type)->limit(3)->get();
        $loai = ProductType::all();

         $loai_sp = ProductType::where('id',$type)->first();
        return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }
    public function getChitiet(Request $req){
        $sanpham= Product::where('id',$req->id)->first();
        $sp_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(3);
        return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu'));
    }

    public function getAddToCart(Request $req, $id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product,$id);
        $req->session()->put('cart', $cart);
        return redirect()->back();
    }
    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
        Session::put('cart',$cart);

        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
    }
    public function getLienhe(){
        return view('page.lienhe');
    }
    public function getAbout(){
        return view('page.gioithieu');
    }
    public function getCheckout(){
        return view('page.dat_hang');
    }

    public function postCheckout(CustomerRequest $req){
        $cart = Session::get('cart');
        $cus = new Customer();
        $cus->name= $req->name;
        $cus->gender=$req->gender;
        $cus->email=$req->email;
        $cus->address=$req->address;
        $cus->note=$req->notes;
        $cus->phone_number=$req->phone;
        $cus->save();

        $bill = new Bill();
        $bill->id_customer= $cus->id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$req->payment_method;
        $bill->note=$req->notes;
        $bill->save();

        foreach($cart->items as $item){
            $billdetail = new BillDetail();
            $billdetail->id_bill= $bill->id;
            $billdetail->id_product=$item['item']['id'];
            //lay gia tung san pham theo cach la chia so luong
            $billdetail->unit_price=$item['price']/$item['qty'];
            $billdetail->quantity=$item['qty'];
            $billdetail->save();
        }

        Session::forget('cart');
        return redirect('index');
    }

    public  function getLogin($error=""){
        //TO DO: get the view of login page
        return view('page.dangnhap',['error'=>$error]);
    }
    public function login(Request $req){
     //TO DO: function for login feature
       if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
           return redirect('/index');
       }else{
           return view('page.dangnhap',['error'=>"Đăng nhập không thành công, vui lòng kiểm tra Email hoặc Password"]);
       }
    }
    public function getRegister(){
        //TO DO: get the view of register page
        return view('page.dangki');
    }
    public function register(RegisterRequest $req){
        //TO DO: register an new account
        $user=new User();
        $user->email=$req->email;
        $user->full_name=$req->fullname;
        $user->address=$req->address;
        $user->phone=$req->phone;
        $user->password=Hash::make($req->password);
        $user->save();
        return redirect("/login");
    }
    public function logout(){
        Auth::logout();
        return redirect('index');
    }
}
