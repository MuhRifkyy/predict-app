<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Salesdetail;
use App\Models\Salesdetail_temp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Phpml\Regression\LeastSquares;

class PredictController extends Controller
{
    public function getMape($actual, $predicted)
    {
        $count = count($actual);
        $sumAPE = 0;
    
        for($i = 0; $i < $count; $i++){
            $sumAPE += abs(($actual[$i] - $predicted[$i]) / $actual[$i]);
        }
    
        $mape = ($sumAPE / $count) * 100;
        return $mape;
    }


    public function index(Request $request)
    {
        $data["product"] = Produk::all();
     
    //   jika ada product id
        if ($request->has('product')) {
            $data["productid"] = $request->input('product');
        } else {
            $data["productid"] = 1;
            
        }

        $data["mape"] = 0;
        $data["predict"] = [];
        $data["x"] = [];
        $data["y"] = [];
        $data["x2"] = [];
        $data["y2"] = [];
        $data["const_a"] = 0;
        $data["const_b"] = 0;
        $data["nextPrediction"] = 0;
        return view('predict.index', $data);
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
        $data['product'] = Produk::all();
        if ($request->has('product')) {
            $data["productid"] = $request->input('product');
        } else {
            $data["productid"] = 1;
            
        }
      
        $data["x"] = Salesdetail_temp::where("id_produk",$request->input("product"))->get("bulan")->pluck("bulan")->toArray();
        foreach($data["x"] as $key => $value){
           $data["x"][$key] = [$value];
       }
       $data["y"] = Salesdetail_temp::where("id_produk",$request->input("product"))->get("jumlah_produk")->pluck("jumlah_produk")->toArray();
       $data["spss"] = Salesdetail_temp::where("id_produk",$request->input("product"))->get("spss")->pluck("spss")->toArray();
       $regression = new LeastSquares();
       $regression->train($data["x"], $data["spss"]);
       for($i = 1; $i <= 36; $i++){
           $data["predict"][] = round($regression->predict([$i]));
        }
       
       $data["const_a"] = $regression->getIntercept();
        $data["const_b"] = $regression->getCoefficients();

       $data["const_b"] = $data["const_b"][0];
   
         $data["const_a"] = round($data["const_a"], 0);
         $data["const_b"] = round($data["const_b"], 0);
       $data["mape"] = $this->getMape($data["spss"], $data["predict"]);
       $data["mape"] = round($data["mape"], 2);
       $data["x2"] = [];
       foreach ($data["x"] as $row){
           $data["x2"][] =  $row[0] * $row[0];
       }
       $data["y2"] = array_map(function($x){return $x * $x;}, $data["y"]);
       if($request->has("yes") == "benar"){
           $data["nextPrediction"] = round($regression->predict([37]));
       }
       else{
           $data["nextPrediction"] = 0;
       }
       return view('predict.index', $data);
        
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
