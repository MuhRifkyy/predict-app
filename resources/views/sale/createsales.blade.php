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
            <form action="" method="POST">
              <div class="row mb-3" id="itemsproduk">
                <label class="col-sm-4 col-form-label">Nomor CDSO</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Nomor CDSO">
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Tanggal Pembelian</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Customer</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Customer">
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Item Produk</label>
                <div id="select-container">
                  <select class="col-sm-10">
                    @foreach ( $produk as $p )
                    <option value="{{$p->id}}">{{$p->item_produk}},{{$p->ukuran_produk}}</option>
                    @endforeach
                  </select>
                </div>
				<br/>
                <div class="col-sm-10">
                  <button type="button" class="btn btn-primary" style="width: 10%;" onclick="addSelect();">+</button>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword" class="col-sm-4 col-form-label">Jumlah Botol</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" placeholder="Jumlah Botol">
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
@endsection

