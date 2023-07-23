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
              <a class="btn btn-outline-success" href="{{route('createsales')}}" role="button">Add Sales</a>
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
                        {{-- <a class="bi bi-pencil-square" style="size: 20px;" href="{{route('editproduct',['id'=>$p->id])}}"></a>
        s                |
                        <a class="bi bi-trash-fill" style="size: 20px;" href="{{route('deleteproduct',['id'=>$p->id])}}"></a> --}}
                    </td>
                </tr>
                @endforeach
              </tbody>
              </table>
              <!-- End Table with hoverable rows -->
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
@endsection
