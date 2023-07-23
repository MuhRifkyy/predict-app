@extends('template.header')
@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('product')}}">Product</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add Product<button class="btn btn-outline-success" href="{{route('product')}}" >All Reports</button></h5>

            <!-- General Form Elements -->
            <div class="col-lg-6">
            <form action="{{('postproduct')}}" method="post">
              {{ csrf_field() }}
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Item Produk</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="item_produk" required="required">
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Jenis Product  :</label>
                <select name="jenis_produk" class="col-2">
                  <option value="">--Pilih--</option>
                  <option value="Beer">Beer</option>
                  <option value="Cider">Cider</option>
                  <option value="Liquor">Liquor</option>
                  <option value="Rum">Rum</option>
                  <option value="Vodka">Vodka</option>
                </select>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Case Product  :</label>
                <select name="case_produk" class="col-2">
                  <option value="">--Pilih--</option>
                  <option value="1">1</option>
                  <option value="6">6</option>
                  <option value="12">12</option>
                  <option value="16">16</option>
                  <option value="20">20</option>
                  <option value="24">24</option>
                </select>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Bentuk Product  :</label>
                <select name="bentuk_produk" class="col-2">
                  <option value="">--Pilih--</option>
                  <option value="Barrel">Barrel</option>
                  <option value="Bottle">Bottle</option>
                  <option value="Can">Can</option>
                </select>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Ukuran Product  :</label>
                <select name="ukuran_produk" class="col-2 dropdown-menu-end">
                  <option value="">--Pilih--</option>
                  <option value="20 L">20 L</option>
                  <option value="30 L">30 L</option>
                  <option value="200ML">200ML</option>
                  <option value="320ML">320ML</option>
                  <option value="330ML">330ML</option>
                  <option value="360ML">360ML</option>
                  <option value="500ML">500ML</option>
                  <option value="620ML">620ML</option>
                  <option value="640ML">640ML</option>
                  <option value="700ML">700ML</option>
                  <option value="750ML">750ML</option>
                </select>
              </div>
              <button class="btn btn-outline-success" type="submit" id="btn-cardplus">Create</button>
            </form>
          </div>
        </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection

