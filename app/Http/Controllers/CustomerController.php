<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data dari table pegawai
    	$customers = DB::table('customers')->get();

    	//mengirim data pegawai ke view index
    	return view('customers.customer',['customers' => $customers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.createcustomer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Customer::create([
            'pelanggan' => $request->pelanggan,
            'alamat' => $request->alamat
        ]);
        return redirect()->route('customer');
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
	    $customers = DB::table('customers')->where('id',$id)->get();
        // return $customers;
	   // passing data pegawai yang didapat ke view edit.blade.php
	    return view('customers.editcustomer', compact('customers'));
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
        	// update data pegawai
            Customer::where('id',$request->id)->update([
            'pelanggan' => $request->pelanggan,
            'alamat' => $request->alamat
	]);
            //alihkan ke halaman pegawai
            return redirect()->route('customer');
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
	    Customer::where('id',$id)->delete();

	    // alihkan halaman ke halaman pegawai
	    return redirect('customer');
    }
}
