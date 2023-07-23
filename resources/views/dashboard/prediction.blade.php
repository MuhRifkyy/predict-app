@extends('template.header')
@section('content')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Prediction</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item">Prediction</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Prediction Products</h5>
              <p>Melakukan Prediksi pada Produk yang telah ditentukan</p>

              <!--Dropdown Jenis Produk-->
              <div class="col-lg-6">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownJenisProduk" data-bs-toggle="dropdown" aria-expanded="false">
                  Jenis Produk
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownJenisProduk">
                  <li><a class="dropdown-item active" href="#">Beer</a></li>
                  <li><a class="dropdown-item" href="#">Cider</a></li>
                  <li><a class="dropdown-item" href="#">Liquor</a></li>
                  <li><a class="dropdown-item" href="#">Rum</a></li>
                  <li><a class="dropdown-item" href="#">Vodka</a></li>
                </ul>
              </div>
              <!--Dropdown Jenis Produk-->
              <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                  <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                </div>
              </nav>
              <!--CheckBox-->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="predict" value="true" id="predictApp">
                <label class="form-check-label" for="predictApp">Cek Untuk Melakukan Prediksi</label>
              </div>
              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Age</th>
                    <th scope="col">Start Date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td>35</td>
                    <td>2014-12-05</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Ashleigh Langosh</td>
                    <td>Finance</td>
                    <td>45</td>
                    <td>2011-08-12</td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Angus Grady</td>
                    <td>HR</td>
                    <td>34</td>
                    <td>2012-06-11</td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Raheem Lehner</td>
                    <td>Dynamic Division Officer</td>
                    <td>47</td>
                    <td>2011-04-19</td>
                  </tr>
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
