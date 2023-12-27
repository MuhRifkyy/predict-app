@extends('template.header')
@section('content')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Sales</h1>
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
              <h5 class="card-title">Sales Products</h5>
              <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                  <a class="btn btn-outline-success" href="{{route('createsales')}}" role="button">Add Sales</a>
                  <form class="d-flex" action="{{route('sales')}}">
                    <input class="form-control me-2" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                </div>
              </nav>
              {{-- search --}}
            
              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Nomor CDSO</th>
                    <th scope="col">Tanggal Penjualan</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Item Produk</th>
                    <th scope="col">Jumlah Botol</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($sales as $s)
                <tr>
                    <td>{{ $s->nomorcdso }}</td>
                    <td>{{ $s->tanggal_penjualan }}</td>
                    <td>{{ $s->customer->pelanggan}}</td>
                    <td>
                      @foreach ($s->sales_detail as $detail)
                        {{$detail->product->item_produk . ' - '.$detail->product->ukuran_produk}} <br>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($s->sales_detail as $detail)
                        {{$detail->jumlah_botol}} <br>
                      @endforeach
                    </td>
                    <td>
                     {{-- form delete --}}
                      <form action="{{route('deletesales', $s->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-outline-danger" type="submit" id="btn-cardplus">Delete</button>
                      </form>
                    </td>
                  </tr>
                  
                  @endforeach
                </tbody>
                
              </table>
              {{-- paginate --}}
              
              <!-- End Table with hoverable rows -->
            </div>
          </div>
          
        </div>
      </div>
    </section>
   
      <!-- ... konten lainnya ... -->
      
      <!-- Links pagination -->
      {{-- <div class="d-flex justify-around">

       
      
        {{ $sales->links('pagination::bootstrap-4') }}
   
       
      </div> --}}
      <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <a>
            Showing
            {{ $sales->firstItem() }}
            to
            {{ $sales->lastItem() }}
            of
            {{ $sales->total() }}
            entries
          </a>
          <form class="d-flex">
            {{ $sales->links('pagination::bootstrap-4') }}
          </form>
        </div>
        </nav>
  

  </main><!-- End #main -->
 
@endsection
