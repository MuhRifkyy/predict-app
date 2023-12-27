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
            <h5 class="card-title">Customer List</h5>
            <nav class="navbar navbar-light bg-light">
              <div class="container-fluid">
                <a class="btn btn-outline-success" href="{{route('customercreate')}}" role="button">Add Customer</a>
                <form class="d-flex" action="{{route('customer')}}">
                  <input class="form-control me-2" name="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </nav>
            <!-- Table with hoverable rows -->
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Pelanggan</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              @foreach($customers as $c)
                <tr>
                    <td>{{ $c->pelanggan }}</td>
                    <td>{{ $c->alamat }}</td>
                    <td>
                        <a class="bi bi-pencil-square" style="size: 20px;" href="{{route('customeredit',['id'=> $c->id])}}"></a>
                        |
                        <a class="bi bi-trash-fill" style="size: 20px;" href="{{route('customerdelete',['id'=> $c->id])}}"></a>
                    </td>
                </tr>
                @endforeach
            </table>
            <!-- End Table with hoverable rows -->
          </div>
        </div>
        {{-- paginate --}}
    
        <nav class="navbar navbar-light bg-light">
          <div class="container-fluid">
            <a>
              Showing
              {{ $customers->firstItem() }}
              to
              {{ $customers->lastItem() }}
              of
              {{ $customers->total() }}
              entries
            </a>
            <form class="d-flex">
              {{ $customers->links('pagination::bootstrap-4') }}
            </form>
          </div>
          </nav>

      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection
