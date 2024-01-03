<?php


namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Sales;
use App\Models\Salesdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Phpml\Regression\LeastSquares;


class MetodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMape($actual, $predicted)
    {
        $count = count($actual);
        $sumAPE = 0;
    
        for($i = 0; $i < $count; $i++){
            $sumAPE += abs(($actual[$i] - $predicted[$i][0]) / $actual[$i]);
        }
    
        $mape = ($sumAPE / $count) * 100;

       
        return $mape;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bulan = 12;

        $tahunAwal = Sales::selectRaw('YEAR(tanggal_penjualan) as year')
            ->orderBy('tanggal_penjualan', 'asc')
            ->limit(1)
            ->first()
            ->year;
        $tahunAkhir = Sales::selectRaw('YEAR(tanggal_penjualan) as year')
            ->orderBy('tanggal_penjualan', 'desc')
            ->limit(1)
            ->first()
            ->year;

        

        foreach (range($tahunAwal, $tahunAkhir) as $year) {
            foreach (range(1, $bulan) as $month) {
                $indexBulan = (($year - $tahunAwal) * $bulan) + $month;

                $data["x"][] = [
                    'x' => $indexBulan,

                ];
            }
        }

        $data['product'] = Produk::all();

        $data['y'] = [];
        $data['x'] = [];
        $data['predict'] = [];
        $data['mape'] = 0;
        $data['x2'] = [];
        $data['y2'] = [];
        $data['cost_a'] = 0;
        $data['cost_b'] = [0];
        $nextPrediction = 0;
        if ($request->has('product')) {
            $productid = $request->input('product');
        } else {
            $productid = 1;
            
        }

        return view("metode", ['data' => $data,  'product' => $data['product'], 'x' => $data['x'], 'y' => $data['y'],'nextPrediction' => $nextPrediction,'productid'=>$productid,'mape'=>$data["mape"],'x2'=>$data["x2"],'y2'=>$data["y2"]]);
    }

    public function store(Request $request)
    {
        
        $firstDate = Sales::orderBy('tanggal_penjualan', 'asc')->value('tanggal_penjualan');
        $lastDate = Sales::orderBy('tanggal_penjualan', 'desc')->value('tanggal_penjualan');

        $firstYear = date('Y', strtotime($firstDate));
        $firstMonth = date('m', strtotime($firstDate));
        $lastYear = date('Y', strtotime($lastDate));
        $lastMonth = date('m', strtotime($lastDate));
        $totalMonths = (($lastYear - $firstYear) * 12) + ($lastMonth - $firstMonth) + 1;


        // get data x


        $data['x'] = [];

        for ($i = 1; $i <= $totalMonths; $i++) {
            $data['x'][] = [
                $i,
            ];
        }


        for ($i = 0; $i < $totalMonths; $i++) {
          
            $currentYear = $firstYear + floor(($firstMonth + $i - 1) / 12);
            $currentMonth = ($firstMonth + $i - 1) % 12 + 1;

            $totalPenjualan = Salesdetail::selectRaw('COALESCE(SUM(salesdetail.jumlah_botol), 0) as total_penjualan')
                ->join('sales', 'sales.id', '=', 'salesdetail.sales_id')
                ->whereYear('sales.tanggal_penjualan', $currentYear)
                ->whereMonth('sales.tanggal_penjualan', $currentMonth)
                ->where('salesdetail.product_id', $request->input('product'))
                ->first()   
                ->total_penjualan;

            $result[] = $totalPenjualan;
        }

        $data['y'] = $result;

        $data['product'] = Produk::all();
        if($request->has('product')){

            $productid = $request->input('product');
        }
        else{
            $productid = 1;
        }
      
        $regression = new LeastSquares();
        $regression->train($data['x'], $data['y']);
        // loop predict dar jumlah  data x
        for ($i = 0; $i < count($data["x"]); $i++) {
            $data['predict'][] = $regression->predict([$data['x'][$i]]);
            
        }
        $nextPrediction = 0;
        if ($request->has('predict')) {
            $nextPrediction = $regression->predict([$request->input('predict')]);
          
        }

        $data["cost_a"] = $regression->getIntercept();
        $data["cost_b"] = $regression->getCoefficients();
        // get mape
        $data["mape"] = $this->getMape($data['y'], $data['predict']);
        $data["mape"] = round($data["mape"], 0);
     
        // kuadrat x,y
        $data["x2"] = [];
        foreach ($data["x"] as $row){
            $data["x2"][] = $row[0] * $row[0];

        }

        
        $data["y2"] = array_map(function($x) { return $x * $x; }, $data["y"]);
     

        return view("metode", ['data' => $data,'productid'=>$productid, 'x' => $data['x'], 'y' => $data['y'], 'predict' => $data['predict'], 'product' => $data['product'],"nextPrediction"=>$nextPrediction,'mape'=>$data["mape"],'x2'=>$data["x2"],'y2'=>$data["y2"]]);


    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function next()
    {   
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

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
