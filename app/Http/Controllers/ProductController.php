<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data ['title'] = 'Product';
        $data['products'] = Product::all();

        return view('dashbord.pages.product', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data ['title'] = 'Tambah Data Produk';

        return view('dashbord.pages.product_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'stok' => 'required',
            'price' => 'required|numeric',
            'image'=> 'required|image|file|max:1024',
        ]);

        // $image = $request->image;
        // $slug = Str::slug($image->getClientOriginalName());
        // $new_image = time() .'_'. $slug;
        // $image->move('storage/image/', $new_image);

        // $product = new Product();
        // $product->name = $request->name;
        // $product->description = $request->description;
        // $product->stok = $request->stok;
        // $product->price = $request->price;
        // $product->category_id = $request->category_id;
        // $product->image = 'storage/image/'. $new_image;
        // $product->save;
        // dd($request->all());
        // if($request->file('image')){
        //     $validate['image']= $request->file('image')->store('image', 'public');
        // }
        // dd($request);

        // Product::create($validated);

        //upload image
        $image = $request->file('image');
        $image->storeAs('gambar', $image->hashName());

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'stok' =>$request->stok,
            'price' =>$request->price,
            'image' =>$image->hashName()
        ]);

        // dd($request->all());

        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data ['title'] = 'Edit Produk';
        $data['product'] = Product::find($id);

        return view('dashbord.pages.product_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'stok' => 'required',
            'price' => 'required|numeric',
            'image'=> 'image|file|max:1024',
        ]);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('gambar', $image->hashName());

            //delete old image
            Storage::delete('gambar'.$product->image);

            //update post with new image
            $product->update([
                'image'     => $image->hashName(),
                'name' => $request->name,
                'description' => $request->description,
                'stok' =>$request->stok,
                'price' =>$request->price,
            ]);

        } else {

            //update post without image
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'stok' =>$request->stok,
                'price' =>$request->price,
            ]);
        }


        // Product::where('id', $product->id)->update($validated);

        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        //delete image
        Storage::delete('gambar'. $product->image);
        //delete product
        $product->delete();

        return redirect('/product')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
