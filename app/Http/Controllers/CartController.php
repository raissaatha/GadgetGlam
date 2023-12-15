<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class CartController extends Controller
{
    public function index()
    {
        $data ['title'] = 'Rumah Makan Minang Raya';
        $data['products'] = Product::all();

        return view('frontend.home', $data);
    }

    // detail cart
    public function dcart($id){
        $data ['title'] = 'Detail Cart';
        $data['products'] = Product::find($id);

        return view('frontend.detail', $data);
    }

    // dashbord cart
    public function cart()
    {
		$data ['title'] = 'Cart';
        $data['cart'] = Cart::with('user')->get();

    	return view('dashbord.pages.cart', $data);
    }
}
