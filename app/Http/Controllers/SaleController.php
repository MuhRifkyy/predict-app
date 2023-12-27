<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Produk;
use App\Models\Sales;
use App\Models\Salesdetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data dari table pegawai
    	// $sales = DB::table('sales')->get();
        // limt row 10
        $sales = Sales::with('sales_detail','sales_detail.product','customer')->orderBy('id','desc')->paginate(20);
        if(request()->has('search')){
    //    search by nomorcdso customer item produk
            $sales = Sales::with('sales_detail','sales_detail.product','customer')
            ->where('nomorcdso','LIKE','%'.request('search').'%')
            ->orWhereHas('customer',function($query){
                $query->where('pelanggan','LIKE','%'.request('search').'%');
            })
            ->orWhereHas('sales_detail',function($query){
                $query->whereHas('product',function($query){
                    $query->where('item_produk','LIKE','%'.request('search').'%');
                });
            })
            ->orderBy('id','desc')->paginate(20);
        }
        // $sales = Customer::get();
        // return $sales;
    	//mengirim data pegawai ke view index
    	return view('sale.sales',['sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["produk"] = Produk::all();
        $data["customer"] = Customer::all();
        return view('sale.createsales',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        for ($i=0; $i < count($request->item_produk); $i++) { 
            $sales = new Sales;
            $sales->customer_id = $request->customer;
            $sales->tanggal_penjualan = $request->tanggal;
            $sales->nomorcdso = $request->nomorcdso;
            $sales->save();

            $sales_detail = new Salesdetail;
            $sales_detail->sales_id = $sales->id;
            $sales_detail->product_id = $request->item_produk[$i];
            $sales_detail->jumlah_botol = $request->jumlah_botol[$i];
            $sales_detail->save();
        }

        return redirect()->back()->with('status','Data Sales Berhasil Ditambahkan!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sales = Sales::find($id);
        $sales->delete();
        return redirect()->back()->with('status','Data Sales Berhasil Dihapus!');
    }
}
