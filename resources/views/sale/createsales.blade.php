@extends('template.header')
@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Customer</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('sales')}}">Sales</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Create Sales<button class="btn btn-outline-success" type="submit" id="btn-cardplus">All Reports</button></h5>

            <!-- General Form Elements -->
            <div class="col-lg-6">
            <form action="{{route('postsales')}}" method="POST">
              @csrf
             @method('POST')
              <div class="row mb-3" id="itemsproduk">
                <label class="col-sm-4 col-form-label">Nomor CDSO</label>
                <div class="col-sm-10">
                  <input type="int" class="form-control" placeholder="Nomor CDSO" name="nomorcdso">
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Tanggal Pembelian</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" name="tanggal">
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Customer</label>
                <div class="col-sm-10">
                
                  <select class="form-control" name="customer">
                    @foreach ($customer as $c)
                    <option value="{{$c->id}}">{{$c->pelanggan}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Item Produk</label>
                <div class="row">
                  <div class="col-md-8">
                   
                          <select class="form-control" name="item_produk[]">
                              @foreach ($produk as $p)
                              <option value="{{$p->id}}">{{$p->item_produk}}, {{$p->ukuran_produk}}</option>
                              @endforeach
                          </select>
                   
                  </div>
                  <div class="col-md-3">
                    <input type="number" class="form-control" placeholder="Jumlah" name="jumlah_botol[]" required>
                  </div>
              </div>
              <div id="dynamicItems"></div>
              
              
		
                <div class="col-sm-10 mt-2">
                  <button type="button" class="btn btn-primary" style="width: 10%;" onclick="addSelect()">+</button>
                </div>
              </div>
           
             
              <button class="btn btn-outline-success" type="submit" id="btn-cardplus">Submit</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function addSelect(){
    var html = '<div class="row mt-3"><div class="row"><div class="col-md-8"><select class="form-control" name="item_produk[]">@foreach ($produk as $p)<option value="{{$p->id}}">{{$p->item_produk}}, {{$p->ukuran_produk}}</option>@endforeach</select></div><div class="col-md-3"><input type="number" class="form-control" placeholder="Jumlah" name="jumlah_botol[]"></div></div><div id="dynamicItems"></div><div class="col-sm-10 mt-2"></div></div>';
    $('#dynamicItems').append(html);

  }
</script>



@endsection

