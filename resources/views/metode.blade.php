{{--tampilan const a b dan predcition --}}

@extends('template.header')
@section('content')
<main id="main" class="main">
    {{-- <h3>{{}}</h3> --}}
    <div style="width: 50%">
        <form action="{{route('methode.store')}}" method="post">
            @method('POST')
            @csrf
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Data X</label>
            <div class="col-sm-6 ">
            
              <select class="form-control" name="product">
             {{-- loop x --}}
             @foreach ($product as $item)
             <option value="{{ $item['id'] }}">{{ $item['item_produk'] }}</option>
         @endforeach
              </select>
            </div>
          </div>
         
          <button class="btn btn-outline-success" type="submit" id="btn-cardplus">Submit</button>
         
        </form>

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
                            <th scope="col">Predict</th>
                        </tr>
                    </thead>
                    <tbody>
                      {{-- if ada data x --}}
                      @if (isset($data['x']) && count($data['x']) > 0)
                      @for ($i = 0; $i < count($data['x']); $i++)
                          <tr>
                              <td>{{ $data['x'][$i][0] }}</td>
                              <td>{{ $data['y'][$i] }}</td>
                              <td>{{ $data['predict'][$i][0] }}</td>
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
        <div class="card">
          <div class="card-body">
            <h3>{{$data["cost_a"]}}</h3>
            <h3>{{$data["cost_b"][0]}}</h3>
          </div>
        </div>

      
    </div>
    <form action="{{ route('methode.store') }}" method="post">
      @method('POST')
      @csrf
      <div class="row mb-3">
        <input type="hidden" name="product" value="{{$productid}}">
          <label class="col-sm-2 col-form-label">Predict penjualan ke</label>
          <div class="col-sm-6">
              <input type="number" name="predict" placeholder="Masukkan prediksi selanjutnya">
          </div>
          <div class="col-sm-4">
              <button type="submit" class="btn btn-primary">Prediksi</button>
          </div>
      </div>
  </form>
  
    <h1>Nilai Prediksi Selanjutnya: {{ $nextPrediction }}</h1>

</main>

@endsection