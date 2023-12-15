<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $data ['title'] = 'History';
        $data['carts'] = Cart::where('user_id', Auth::user()->id)->where('status', '!=',0)->get();

    	return view('frontend.history.index', $data);
    }

    public function detail($id)
    {
        $title = 'Detail Riwayat';
    	$cart = Cart::where('id', $id)->first();
    	$transaction = Transaction::where('cart_id', $cart->id)->get();

     	return view('frontend.history.detail', compact('title','cart','transaction'));
    }

    public function store(Request $request, $id)
    {
        $cart = Cart::where('id', $id)->first();
        $image = $request->file('photo');
        $image->storeAs('buktitransfer', $image->hashName());


    $cart->update([
        'buktitransfer' => $image->hashName()
    ]);
        // dd($carts);
        return redirect('/history');
    }
}
