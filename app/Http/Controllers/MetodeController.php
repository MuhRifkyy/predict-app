<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // loop jumlah bulan in all date
        // store to array x 
        // loop jumlah penjualan per bulan 
        // store to array y
        
        // x = periode/ bulan
        // y = jumlah penjualan/bulan
        // Data x dan y yang akan digunakan untuk regresi linear
        $data["x"] = [[24], [22], [21], [20], [22], [19], [20], [23], [24], [25], [21], [20], [20], [19], [25], [27], [28], [25], [26], [24], [27], [23], [24], [23], [22], [21], [26], [25], [26], [27]]; # 30 data
        $data['y'] = [5, 5, 6, 3, 6, 4, 5, 9, 11, 13, 7, 4, 6, 3, 12, 13, 16, 12, 14, 12, 16, 9, 13, 11, 7, 5, 12, 11, 13, 14]; # 30 data
    
        // Buat model regresi linear
        $regression = new LeastSquares();
        $regression->train($data["x"], $data["y"]);
        // add const a const b 
        $data["const_a"] = $regression->getIntercept();
        $data["const_b"] = $regression->getCoefficients();
      
        $prediction0 = $regression->predict([[10]]);
        $prediction1 = $regression->predict([[11]]);    
        
        $data["prediction"] = [$prediction0,$prediction1];
        return $data;
        return view('metode',$data);
    }

public function store(Request $request)
{
  

    $x = [24, 22, 21, 20, 22, 19, 20, 23, 24, 25, 21, 20, 20, 19, 25, 27, 28, 25, 26, 24, 27, 23, 24, 23, 22, 21, 26, 25, 26, 27]; # 30 data
    $y = [10, 5, 6, 3, 6, 4, 5, 9, 11, 13, 7, 4, 6, 3, 12, 13, 16, 12, 14, 12, 16, 9, 13, 11, 7, 5, 12, 11, 13, 14]; # 30 data

    // linear regression
    $metode = new MetodeLinearRegresion;
   

        // single prediction
        $prediction_single_x = $metode->LinearRegresion_x($x, $y, 0);
    $const_a = $metode->getConstA();
    $const_b = $metode->getConstB();
    $x2 = $metode->getValueX2();
    $y2 = $metode->getValueY2();
    $xy = $metode->getValueXY();

    // Mendapatkan data matriks
    $example_matrix = [$x, $y, $x2, $y2, $xy];
    $matrix = new MatrixClass;
    $data = $matrix->flip_matrix($example_matrix);
return redirect()->back()->with('status','set!');
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
