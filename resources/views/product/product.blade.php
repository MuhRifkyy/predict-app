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
       @if (session('success'))
       <div class="col-md-12">
        <div class="alert alert-success alert-dismissible fase show" role="alert">
          <strong>Data Berhasil</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
           
       @endif
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Product List</h5>
              <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                  <a class="btn btn-outline-success" href="{{route('createproduct')}}" role="button">Add Product</a>
                  <form class="d-flex" action="{{route('product')}}">
                    <input class="form-control me-2" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                </div>
              </nav> <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Item Produk</th>
                    <th scope="col">Jenis Produk</th>
                    <th scope="col">Case Produk</th>
                    <th scope="col">Bentuk Produk</th>
                    <th scope="col">Ukuran Produk</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                @foreach($product as $p)
                  <tr>
                      <td>{{ $p->item_produk }}</td>
                      <td>{{ $p->jenis_produk }}</td>
                      <td>{{ $p->case_produk }}</td>
                      <td>{{ $p->bentuk_produk }}</td>
                      <td>{{ $p->ukuran_produk }}</td>
                      <td>
                          <a class="bi bi-pencil-square" style="size: 20px;" href="{{route('editproduct',['id'=>$p->id])}}"></a>
                          |
                          <a class="bi bi-trash-fill" style="size: 20px;" href="{{route('deleteproduct',['id'=>$p->id])}}"></a>
                      </td>
                  </tr>
                  @endforeach
              </table>
              <!-- End Table with hoverable rows -->
            </div>
          </div>
          <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
              <a>
                Showing
                {{ $product->firstItem() }}
                to
                {{ $product->lastItem() }}
                of
                {{ $product->total() }}
                entries
              </a>
              <form class="d-flex">
                {{ $product->links('pagination::bootstrap-4') }}
              </form>
            </div>
            </nav>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection
