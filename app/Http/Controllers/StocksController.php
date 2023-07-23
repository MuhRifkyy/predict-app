<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data dari table pegawai
    	$stocks = Stock::with('product')->get();

    	//mengirim data pegawai ke view index
    	return view('stocks.stock',['stock' => $stocks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = DB::table('product')->get();
        return view('stocks.createstock',['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Stock::create([
            'product_id' => $request->product_id,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'jumlah_botol' => $request->jumlah_botol
        ]);

        return redirect()->route('stock');
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
	    $stocks = DB::table('stocks')->where('id',$id)->get();
        $product = DB::table('product')->get();
        // return $product;
	   // passing data pegawai yang didapat ke view edit.blade.php
	    return view('stocks.editstock',['product' => $product, 'stocks' => $stocks]);
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
        Stock::where('id',$request->id)->update([
            'product_id' => $request->product_id,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'jumlah_botol' => $request->jumlah_botol
	]);
            //alihkan ke halaman pegawai
            return redirect()->route('stock');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // menghapus data berdasarkan id yang dipilih
	    Stock::where('id',$id)->delete();

	    // alihkan halaman ke halaman
	    return redirect('stock');
    }
}
