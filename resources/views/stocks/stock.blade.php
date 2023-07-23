@extends('template.header')
@section('content')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Stock</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('stock')}}">Stock</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissible fase show" role="alert">
            <strong>Data Berhasil</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Stock List</h5>
              <a class="btn btn-outline-success" role="button" href="{{route('createstock')}}">Add Stock</a>
              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Item Produk</th>
                    <th scope="col">Tanggal Pembelian</th>
                    <th scope="col">Jumlah Botol</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                @foreach($stock as $s)
                  <tr>
                      <td>{{ $s->product->item_produk }}</td>
                      <td>{{ $s->tanggal_pembelian }}</td>
                      <td>{{ $s->jumlah_botol }}</td>
                      <td>
                          <a class="bi bi-pencil-square" style="size: 20px;" href="{{route('editstock',['id'=>$s->id])}}"></a>
                          |
                          <a class="bi bi-trash-fill" style="size: 20px;" href="{{route('deletestock',['id'=>$s->id])}}"></a>
                      </td>
                  </tr>
                  @endforeach
              </table>
              <!-- End Table with hoverable rows -->
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
@endsection
