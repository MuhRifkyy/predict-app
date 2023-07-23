@extends('template.header')
@section('content')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Customer</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('customer')}}">Customer</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Customer<button class="btn btn-outline-success">All Reports</button></h5>

              <!-- General Form Elements -->
              <div class="col-lg-6">
              <form action="{{('customerpost')}}" method="post">
                {{ csrf_field() }}
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Pelanggan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="pelanggan" required="required">
                  </div>
                </div>
                <div class="col mb-12">
                  <label class="col-sm-4 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" type="text" name="alamat" required="required"></textarea>
                  </div>
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
