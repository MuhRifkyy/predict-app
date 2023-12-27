@extends('template.header')
@section('content')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Product</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-receipt"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$produk}}</h6>
                    
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Stock Card -->
            {{-- <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Sales</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-bag-dash"></i>
                    </div>
                    <div class="ps-3">
                      <h6>264</h6>
                   
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card --> --}}

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Customers</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$customer}}</h6>
                 
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-6">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Sales</h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>
                  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      const salesData = @json($salesData);
                  
                      const labels = [];
                      const data = [];
                  
                      // Mengelompokkan data per bulan dari hasil query
                      salesData.forEach(item => {
                        const monthYear = `${item.year}-${item.month}`;
                        labels.push(monthYear);
                        data.push(item.total_sales);
                      });
                  
                      const options = {
                        chart: {
                          type: 'line',
                          height: 350,
                          toolbar: {
                            show: false
                          }
                        },
                        series: [{
                          name: 'Jumlah Penjualan Perbulan',
                          data: data
                        }],
                        xaxis: {
                          categories: labels,
                          title: {
                            text: 'Date'
                          }
                        },
                        yaxis: {
                          title: {
                            text: 'Jumlah Penjualan'
                          }
                        },
                        colors: ['#4154f1']
                      };
                  
                      const chart = new ApexCharts(document.querySelector("#reportsChart"), options);
                      chart.render();
                    });
                  </script>
                  
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->
            {{-- stock --}}
            <div class="col-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Stock</h5>
                  {{-- chart --}}
                  <div id="stockChart"></div>
                  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      const stockData = @json($stockData);
                  
                      const labels = [];
                      const data = [];
                  
                      // Mengelompokkan data per bulan dari hasil query
                      stockData.forEach(item => {
                        const monthYear = `${item.year}-${item.month}`;
                        labels.push(monthYear);
                        data.push(item.total_stock);
                      });
                  
                      const options = {
                        chart: {
                          type: 'line',
                          height: 350,
                          toolbar: {
                            show: false
                          }
                        },
                        series: [{
                          name: 'Jumlah Stock Perbulan',
                          data: data
                        }],
                        xaxis: {
                          categories: labels,
                          title: {
                            text: 'Date'
                          }
                        },
                        yaxis: {
                          title: {
                            text: 'Jumlah Stock'
                          }
                        },
                        colors: ['#4154f1']
                      };
                  
                      const chart = new ApexCharts(document.querySelector("#stockChart"), options);
                      chart.render();
                    });
                   </script>
                </div>
              </div>
            </div>
            {{-- endstock --}}
            <!-- Recent Sales -->
            {{-- <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Brandon Jacob</td>
                        <td><a href="#" class="text-primary">At praesentium minu</a></td>
                        <td>$64</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2147</a></th>
                        <td>Bridie Kessler</td>
                        <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                        <td>$47</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2049</a></th>
                        <td>Ashleigh Langosh</td>
                        <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                        <td>$147</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Angus Grady</td>
                        <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                        <td>$67</td>
                        <td><span class="badge bg-danger">Rejected</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Raheem Lehner</td>
                        <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                        <td>$165</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales --> --}}


          </div>
        </div><!-- End Left side columns -->

        
      </div>
    </section>

  </main><!-- End #main -->
@endsection
