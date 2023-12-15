<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TransactionController extends Controller
{
    public function pesan(Request $request, $id)
{
    $product = Product::where('id', $id)->first();
    $tanggal = Carbon::now();

    // validasi apakah melebihi stok
    if ($request->jumlah_pesan > $product->stok) {
        echo ("tes");
        return redirect('detail/'.$id);
    }

    // cek validasi
    $cek_cart = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();

    // simpan ke database cart
    if (empty($cek_cart)) {
        $cart = new Cart;
        $cart->user_id = Auth::user()->id;
        $cart->tanggal = $tanggal;
        $cart->status = 0;
        $cart->jumlah_harga = 0;
        $cart->save();
    }

    // simpan ke database cart detail
    $cart_baru = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();

    // cek cart detail
    $cek_transaction = Transaction::where('product_id', $product->id)->where('cart_id', $cart_baru->id)->first();

    if (empty($cek_transaction)) {
        $transaction = new Transaction;
        $transaction->product_id = $product->id;
        $transaction->cart_id = $cart_baru->id;
        $transaction->jumlah = $request->jumlah_pesan;
        $transaction->jumlah_harga = $product->price * $request->jumlah_pesan;
        $transaction->save();
    } else {
        $transaction = Transaction::where('product_id', $product->id)->where('cart_id', $cart_baru->id)->first();

        $transaction->jumlah = $transaction->jumlah + $request->jumlah_pesan;

        // Harga sekarang
        $harga_transaction_baru = $product->price * $request->jumlah_pesan;
        $transaction->jumlah_harga = $transaction->jumlah_harga + $harga_transaction_baru;
        $transaction->update();
    }

    // jumlah total
    $cart = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();
    $cart->jumlah_harga = $cart->jumlah_harga + $product->price * $request->jumlah_pesan;
    $cart->update();

    return redirect('/');
}

public function hapusMenu($id)
{
    $transaction = Transaction::where('id', $id)->first();
    $product = Product::where('id', $transaction->product_id)->first();
    $cart = Cart::where('id', $transaction->cart_id)->first();

    $cart->jumlah_harga = $cart->jumlah_harga - $transaction->jumlah_harga;
    $cart->update();

    if ($transaction->jumlah == 0) {
        $transaction->delete();
    } else {
        $transaction->update();
    }

    return redirect('/');
}

    public function check_out()
    {
        $title = 'Cart';
        $cart = Cart::where('user_id', Auth::user()->id)->where('status',0)->first();
 	    $transactions = [];
        if(!empty($cart))
        {
            $transactions = Transaction::where('cart_id', $cart->id)->get();

        }
        
        return view('frontend.pesan.check_out', compact('cart', 'transactions', 'title'));
    }

    public function delete($id)
{
    $transaction = Transaction::find($id);
    $product = Product::find($transaction->product_id);
    $cart = Cart::find($transaction->cart_id);

    $cart->jumlah_harga = $cart->jumlah_harga - $transaction->jumlah_harga;
    $cart->update();

    if ($transaction->jumlah == 0) {
        $transaction->delete();
    } else {
        $transaction->update();
    }

	Transaction::destroy($id);
    return redirect('/check-out');
}

	public function konfirmasi()
    {
        $user = User::where('id', Auth::user()->id)->first();

        if(empty($user->alamat))
        {
            return redirect('profile');
        }

        if(empty($user->nohp))
        {
            return redirect('profile');
        }

        $cart = Cart::where('user_id', Auth::user()->id)->where('status',0)->first();
        $cart_id = $cart->id;
        $cart->status = 1;
        $cart->update();

        $transactions = Transaction::where('cart_id', $cart_id)->get();
        foreach ($transactions as $transaction) {
            $product = Product::where('id', $transaction->product_id)->first();
            $product->stok = $product->stok-$transaction->jumlah;
            $product->update();
        }

        return redirect('history/'.$cart_id);
    }

	// melengkapi profile sebelum chek out
	public function pindex()
    {
        $data ['title'] = 'Riwayat';
        $data ['user'] = User::where('id', Auth::user()->id)->first(); 

    	return view('frontend.profile.index', $data);
    }

    public function update(Request $request)
    {
    	 $this->validate($request, [
            'password'  => 'confirmed',
        ]);

    	$user = User::where('id', Auth::user()->id)->first();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->nohp = $request->nohp;
    	$user->alamat = $request->alamat;
        
    	if(!empty($request->password))
    	{
    		$user->password = Hash::make($request->password);
    	}
    	
    	$user->update();

    	return redirect('/check-out');
    }

	// transaksi dashbord
	public function transaksi()
    {
		$data ['title'] = 'Transaksi';
        $data['transaction'] = Transaction::with('cart', 'product')->get();
        $data['buktitransfer'] = Cart::orderBy('id', 'asc')->get();
    	return view('dashbord.pages.transaksi', $data);
    }

	public function verify(Request $request, Cart $cart){
      
        $cart = Cart::find($request)->first();

        if($cart){
            $cart->status = '2';
            $cart->save();
        }

        return redirect('/transaksi');
    }
   
	public function block(Request $request){
		  
	    $cart = Cart::find($request)->first();
	    if($cart){
            $cart->status = '1';
	        $cart->save();
	    }
   
	    return redirect('/transaksi');
	}
}
