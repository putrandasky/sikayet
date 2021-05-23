@extends('layouts.website')


@section('content')
<x-base>
  <div class="jumbotron parallax jumbotron-fluid mt-5 mb-0 " style="background-image:linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),url({{ asset('images/websites/about.jpg') }})">
    <div class="container py-5">
      <h1 class="display-4 text-white">The Power of your most passionate customers</h1>
      <p class="lead text-white">We helps grow your business using customer reviews!</p>
    </div>
  </div>
  <div style="background-color: #051d4d;" class=" w-100">
    <div class="container  d-flex justify-content-center align-items-center py-5">
      <div class="text-center my-3">

        <h3 class="text-center text-light">
          Get started now with us.. Improve your business
        </h3>
        <a class="btn btn-light text-primary" href="/company-register">Join Us Now!</a>
      </div>

    </div>
  </div>
  <div class="container py-3">
    <div class="row">
      <div class="col-md-6">
        <img class="img-fluid" src="{{ asset('images/websites/about1.jpg') }}" alt="">
      </div>
      <div class="col-md-6 p-4">
        <h2 class="font-weight-bold">Passion Drive Us</h2>
        <p class="lead text-secondary">Dolor detraxit duo in, ei sea dicit reformidans. Mel te accumsan patrioque referrentur. Has causae perfecto ut, ex choro assueverit eum. Qui omnium cetero expetenda no, detracto vivendum corrumpit cu duo.</p>
      </div>
    </div>
  </div>
  <div class="bg-white">
    <div class="container py-5 ">
      <div class="row">
        <div class="col-md-4">
          <div class="media">
            <i class="fa fa-bullhorn fa-3x text-primary mr-3"></i>
            <div class="media-body">
              <h4 class="mt-0">Benefit 1</h4>
              <p>Idque saperet assentior mea an. Nisl copiosae reformidans</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 ">
          <div class="media">
            <i class="fa fa-flag fa-3x text-primary mr-3"></i>
            <div class="media-body">
              <h4 class="mt-0">Benefit 2</h4>
              <p>Idque saperet assentior mea an. Nisl copiosae reformidans</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 ">
          <div class="media">
            <i class="fa fa-rocket fa-3x text-primary mr-3"></i>
            <div class="media-body">
              <h4 class="mt-0">Benefit 3</h4>
              <p>Idque saperet assentior mea an. Nisl copiosae reformidans</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-white">
    <div class="container py-3 ">
      <div class="w-100 text-center">
        <h2 class="font-weight-bold">Features</h2>
        <p class="lead text-secondary">Detracto vivendum corrumpit cu duo.</p>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="card mb-3">

            <div class="card-body">
              <div class="card-title">
                <h4>
                  <i class="fa fa-plus text-primary mr-2"></i>
                  <b>
                    Features 1
                  </b>
                </h4>
              </div>
              <div class="card-text">
                Quod exerci torquatos id sit, ne vix officiis consetetur. Te viris corpora voluptaria mea, hendrerit prodesset no cum.
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card mb-3">

            <div class="card-body">
              <div class="card-title">
                <h4>
                  <i class="fa fa-plus text-primary mr-2"></i>
                  <b>
                    Features 2
                  </b>
                </h4>
              </div>
              <div class="card-text">
                Quod exerci torquatos id sit, ne vix officiis consetetur. Te viris corpora voluptaria mea, hendrerit prodesset no cum.
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card mb-3">

            <div class="card-body">
              <div class="card-title">
                <h4>
                  <i class="fa fa-plus text-primary mr-2"></i>
                  <b>
                    Features 3
                  </b>
                </h4>
              </div>
              <div class="card-text">
                Quod exerci torquatos id sit, ne vix officiis consetetur. Te viris corpora voluptaria mea, hendrerit prodesset no cum.
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card mb-3">

            <div class="card-body">
              <div class="card-title">
                <h4>
                  <i class="fa fa-plus text-primary mr-2"></i>
                  <b>
                    Features 4
                  </b>
                </h4>
              </div>
              <div class="card-text">
                Quod exerci torquatos id sit, ne vix officiis consetetur. Te viris corpora voluptaria mea, hendrerit prodesset no cum.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div style="background-color: #051d4d;" class=" w-100">
      <div class="container  d-flex justify-content-center align-items-center py-5">
        <div class="text-center my-3">

          <h3 class="text-center text-light">
            Get started now with us.. Improve your business
          </h3>
        <a class="btn btn-light text-primary" href="/company-register">Join Us Now!</a>
        </div>

      </div>
    </div>
</x-base>
@endsection
