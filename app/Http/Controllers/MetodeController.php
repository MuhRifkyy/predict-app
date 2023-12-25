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
        $data['cost_a'] = 0;
        $data['cost_b'] = [0];
        $nextPrediction = 0;

        return view("metode", ['data' => $data,  'product' => $data['product'], 'x' => $data['x'], 'y' => $data['y'],'nextPrediction' => $nextPrediction]);
    }

    public function store(Request $request)
    {
        // dd($request->input('predict')); 
        $firstDate = Sales::orderBy('tanggal_penjualan', 'asc')->value('tanggal_penjualan');
        $lastDate = Sales::orderBy('tanggal_penjualan', 'desc')->value('tanggal_penjualan');

        // Memecah tanggal pertama dan terakhir untuk mendapatkan bulan dan tahunnya
        $firstYear = date('Y', strtotime($firstDate));
        $firstMonth = date('m', strtotime($firstDate));
        $lastYear = date('Y', strtotime($lastDate));
        $lastMonth = date('m', strtotime($lastDate));

        // Menghitung total bulan dalam rentang tanggal
        $totalMonths = (($lastYear - $firstYear) * 12) + ($lastMonth - $firstMonth) + 1;


        // get data x


        $data['x'] = [];

        for ($i = 1; $i <= $totalMonths; $i++) {
            $data['x'][] = [
                $i,
            ];
        }


        for ($i = 0; $i < $totalMonths; $i++) {
            // Hitung tahun dan bulan berdasarkan indeks bulan
            $currentYear = $firstYear + floor(($firstMonth + $i - 1) / 12);
            $currentMonth = ($firstMonth + $i - 1) % 12 + 1;

            // Menghitung total penjualan untuk bulan saat ini
            $totalPenjualan = Salesdetail::selectRaw('COALESCE(COUNT(salesdetail.id), 0) as total_penjualan')
                ->join('sales', 'sales.id', '=', 'salesdetail.sales_id')
                ->whereYear('sales.tanggal_penjualan', $currentYear)
                ->whereMonth('sales.tanggal_penjualan', $currentMonth)
                ->where('salesdetail.product_id', $request->input('product'))
                ->first()
                ->total_penjualan;

            // Menambahkan total penjualan ke dalam array
            $result[] = $totalPenjualan;
        }

        $data['y'] = $result;


        $data['product'] = Produk::all();
        $productid = $request->input('product');
        //  return $data;
        // return $data;
        $regression = new LeastSquares();
        $regression->train($data['x'], $data['y']);
        // loop predict dar jumlah  data x
        for ($i = 0; $i < count($data["x"]); $i++) {
            $data['predict'][] = $regression->predict([$data['x'][$i]]);
            
        }
        $nextPrediction = 0;
        if ($request->has('predict')) {
          
            // predict nya dari reques
            $nextPrediction = $regression->predict([$request->input('predict')]);
          
        }

        $data["cost_a"] = $regression->getIntercept();
        $data["cost_b"] = $regression->getCoefficients();
       
     

        return view("metode", ['data' => $data,'productid'=>$productid, 'x' => $data['x'], 'y' => $data['y'], 'predict' => $data['predict'], 'product' => $data['product'],"nextPrediction"=>$nextPrediction]);


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
