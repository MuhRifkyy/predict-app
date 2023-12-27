<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data dari table pegawai
    	$product = DB::table('product')->paginate(10);
         
            if(request()->has('search')){
                $product = Produk::where('item_produk','LIKE','%'.request('search').'%')->paginate(10);
            }
    	//mengirim data pegawai ke view index
    	return view('product.product',['product' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('product.createproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Produk::create([
            'item_produk' => $request->item_produk,
            'jenis_produk' => $request->jenis_produk,
            'case_produk' => $request->case_produk,
            'bentuk_produk' => $request->bentuk_produk,
            'ukuran_produk' => $request->ukuran_produk
        ]);
        return redirect()->back()->with('success', 'Data Produk Berhasil Ditambahkan!');
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
        //mengambil data pegawai berdasarkan id yang dipilih
	    $product = DB::table('product')->where('id',$id)->get();
        // return $product;
	   // passing data pegawai yang didapat ke view edit.blade.php
	    return view('product.editproduct', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // update data product
        Produk::where('id',$request->id)->update([
            'item_produk' => $request->item_produk,
            'jenis_produk' => $request->jenis_produk,
            'case_produk' => $request->case_produk,
            'bentuk_produk' => $request->bentuk_produk,
            'ukuran_produk' => $request->ukuran_produk
	]);
            //alihkan ke halaman pegawai
            return redirect()->route('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // menghapus data pegawai berdasarkan id yang dipilih
	    Produk::where('id',$id)->delete();

	    // alihkan halaman ke halaman pegawai
	    return redirect('product');
    }
}
