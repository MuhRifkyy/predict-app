@extends('template.header')
@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Stock</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Stock</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Stock<button class="btn btn-outline-success" type="submit" id="btn-cardplus">All Reports</button></h5>

            <!-- General Form Elements -->
            <div class="col-lg-6">
              @foreach ($stocks as $s)
              <form action="{{route('updatestock')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$s->id}}"> <br/>
                <div class="row mb-3">
                  <label for="inputText" class="form-label">Item Produk</label>
                  <select name="product_id" class="form-select">
                    <option value="" selected disabled>--Pilih--</option>
                    @foreach ($product as $p)
                    <option value="{{$p->id}}">{{$p->item_produk}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-4 col-form-label">Tanggal Pembelian</label>
                  <div class="col-sm-10">
                    <input type="date" name="tanggal_pembelian" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Jumlah Botol</label>
                  <div class="col-sm-10">
                    <input type="text" name="jumlah_botol" class="form-control">
                  </div>
                </div>
                <button class="btn btn-outline-success" type="submit" id="btn-cardplus">Edit</button>
              </form>
              @endforeach
          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection
