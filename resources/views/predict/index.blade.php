{{--tampilan const a b dan predcition --}}

@extends('template.header')
@section('content')
<main id="main" class="main">
    {{-- <h3>{{}}</h3> --}}
    <div style="">
      <div class="row">

        <div class="col-md-6">
  
          <div class="card">
            <div class="card-body">
              <form action="{{route('predict.store')}}" method="post">
                @method('POST')
                @csrf
            <div class="row mb-3">
              <h5 class="text-center pt-4 fw-bold">Masukan Data Product Yang Ingin Di Prediksi</h5>
                <label class="col-sm-6 col-form-label fw-bold">Nama Product</label>
                <div class="col-sm-12 ">
                
                  <select class="form-control" name="product">
                 {{-- loop x --}}
                 {{-- get ame disbaled by id --}}
                  @foreach ($product as $item)
                      @if ($item['id'] == $productid)
                          <option value="{{ $item['id'] }}" selected>{{ $item['item_produk'] }}</option>
                      @endif
                  @endforeach
                 
                 @foreach ($product as $item)
                 <option value="{{ $item['id'] }}">{{ $item['item_produk'] }}</option>
                @endforeach
                  </select>
                </div>
              </div>
              <button class="btn btn-outline-success" type="submit" id="btn-cardplus">Submit</button>
             
            </form>
            </div>
          </div>
        </div>
        {{-- <div class="col-md-6">
          <div class="row">
            <div class="card">
                <div class="card-body p-4">
                <h5 class="text-center fw-bold text-dark">Mape</h5>
                <button onclick="getMape()" class="btn btn-primary">Lihat Mape</button>
                <h5 class="text-dark fw-bold mt-3" style="display: none" id="mape">Nilai Mape: {{$mape}}% </h5>
                </div>
            </div>
          </div>
        </div> --}}
      </div>

        <section class="section">
          <div class="row">
            <div class="col-lg-12">
    
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Predict App</h5>
                   <!-- Table with hoverable rows -->
                   <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" >X</th>
                            <th scope="col">Y</th>
                            <th scope="col">X2</th>
                            <th scope="col">Y2</th>
                            <th scope="col">Predict</th>
                        </tr>
                    </thead>
                    <tbody>
                      {{-- if ada data x --}}
                      @if (isset($x) && count($x) > 0)
                      @for ($i = 0; $i < count($x); $i++)
                          <tr>
                              <td>{{ $x[$i][0] }}</td>
                              <td>{{ $spss[$i] }}</td>
                              <td>{{$x2[$i]}}</td>
                              <td>{{$y2[$i]}}</td>
                              <td>{{ $predict[$i] }}</td>
                          </tr>
                      @endfor
                  @endif                    </tbody>
                </table>
                
                  <!-- End Table with hoverable rows -->
                </div>
              </div>
              
            </div>
          </div>
        </section>

        {{-- card --}}
        <div class="row">

          <div class="col-md-6">
  
            <div class="card">
              <div class="card-body p-4">
                <h2 class="text-center fw-bold">Const</h2>
                <h5 class="text-dark fw-semibold" >const A = {{$const_a}}</h5>
                <h5 class="text-dark fw-semibold">const B = {{$const_b}}</h5>
                
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body p-4">
                <h2 class="text-center fw-bold">Predict Selanjutnya</h2>
                {{-- checkbox --}}
                <p>Tekan Untuk Melakukan Prediksi Selanjutnya</p>
                @method('POST')
               
                <form action="{{ route('predict.store') }}" method="post">
                  @csrf
                  <div class="row mb-3">
                    <input type="hidden" name="product" value="{{$productid}}">
                    <input type="hidden" name="yes" value="benar">
                       </div>
                      <div class="col-sm-8 mt-1">
                          <button type="submit" class="btn btn-primary">Prediksi</button>
                      </div>
                  </div>
              </form>
              <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Prediksi</th>
                        <th>Mape</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $nextPrediction }}</td>
                        <td>{{ $mape }}%</td>
                    </tr>
                </tbody>
              </table>
            
              </div>
            </div>
          </div>
        </div>

       
      
    </div>
    


</main>

<script>
  function getMape() {

    let mape = document.getElementById('mape');
  
    mape.style.display = 'block';
    

  }
</script>
@endsection