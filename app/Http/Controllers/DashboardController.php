<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Produk;
use App\Models\Sales;
use App\Models\Stock;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get leng product
        $count["produk"] = Produk::select('id')->count();
        $count["customer"] = Customer::select('id')->count();
        // chart sales
        $salesData = Sales::selectRaw('YEAR(tanggal_penjualan) as year, MONTH(tanggal_penjualan) as month, COUNT(*) as total_sales')
        ->whereRaw('YEAR(tanggal_penjualan) >= YEAR(CURDATE()) - 2')
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();
        $stockData = Stock::selectRaw('YEAR(tanggal_pembelian) as year, MONTH(tanggal_pembelian) as month, COUNT(*) as total_stock')
        ->whereRaw('YEAR(tanggal_pembelian) >= YEAR(CURDATE()) - 2')
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();



        return view('dashboard.dashboard',compact('salesData','stockData'),$count);
    }

    public function predict()
    {
        return view('dashboard.prediction');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
