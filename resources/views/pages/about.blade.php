@extends('layouts.website')
@section('meta')
<title>About</title>
@endsection


@section('content')
<x-base>
  <div class="jumbotron parallax jumbotron-fluid mb-0 " style="background-image:linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),url({{ asset('images/websites/about.jpg') }})">
    <div class="container py-5">
      <h1 class="display-4 text-white">{{$text->where('key','about_header_title')->first()->value}}</h1>
      <h2 class="lead text-white">{{$text->where('key','about_header_subtitle')->first()->value}}</h2>
    </div>
  </div>
  <div style="background-color: #051d4d;" class=" w-100">
    <div class="container  d-flex justify-content-center align-items-center py-5">
      <div class="text-center my-3">

        <h3 class="text-center text-light">
          {{$text->where('key','about_subheader')->first()->value}}
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
        <p class="lead text-secondary">{{$text->where('key','about_image_info')->first()->value}}</p>
      </div>
    </div>
  </div>
  <div class="bg-white">
    <div class="container py-5 ">
      <div class="row">
        <div class="col-md-4">
          <div class="media">
            <i class="ri-{{$text->where('key','about_benefit1_icon')->first()->value}} ri-4x text-primary mr-3"></i>
            <div class="media-body">
              <h4 class="mt-0">{{$text->where('key','about_benefit1_title')->first()->value}}</h4>
              <p class="mb-0">{{$text->where('key','about_benefit1_subtitle')->first()->value}}</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 ">
          <div class="media">
            <i class="ri-{{$text->where('key','about_benefit2_icon')->first()->value}} ri-4x text-primary mr-3"></i>
            <div class="media-body">
              <h4 class="mt-0">{{$text->where('key','about_benefit2_title')->first()->value}}</h4>
              <p class="mb-0">{{$text->where('key','about_benefit2_subtitle')->first()->value}}</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 ">
          <div class="media">
            {{-- <i class="fa fa-rocket fa-3x text-primary mr-3"></i> --}}
            <i class="ri-{{$text->where('key','about_benefit3_icon')->first()->value}} ri-4x text-primary mr-3"></i>
            <div class="media-body">
              <h4 class="mt-0">{{$text->where('key','about_benefit3_title')->first()->value}}</h4>
              <p class="mb-0">{{$text->where('key','about_benefit3_subtitle')->first()->value}}</p>
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
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="card mb-3">

            <div class="card-body">
              <div class="card-title">
                <h4>
                  <i class="ri-{{$text->where('key','about_feature1_icon')->first()->value}} ri-lg text-primary mr-2"></i>
                  <b>
                    {{$text->where('key','about_feature1_title')->first()->value}}
                  </b>
                </h4>
              </div>
              <div class="card-text">
                {{$text->where('key','about_feature1_subtitle')->first()->value}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card mb-3">

            <div class="card-body">
              <div class="card-title">
                <h4>
                  <i class="ri-{{$text->where('key','about_feature2_icon')->first()->value}} ri-lg text-primary mr-2"></i>
                  <b>
                    {{$text->where('key','about_feature2_title')->first()->value}}
                  </b>
                </h4>
              </div>
              <div class="card-text">
                {{$text->where('key','about_feature2_subtitle')->first()->value}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card mb-3">

            <div class="card-body">
              <div class="card-title">
                <h4>
                  <i class="ri-{{$text->where('key','about_feature3_icon')->first()->value}} ri-lg text-primary mr-2"></i>
                  <b>
                    {{$text->where('key','about_feature3_title')->first()->value}}
                  </b>
                </h4>
              </div>
              <div class="card-text">
                {{$text->where('key','about_feature3_subtitle')->first()->value}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card mb-3">

            <div class="card-body">
              <div class="card-title">
                <h4>
                  <i class="ri-{{$text->where('key','about_feature4_icon')->first()->value}} ri-lg text-primary mr-2"></i>
                  <b>
                    {{$text->where('key','about_feature4_title')->first()->value}}
                  </b>
                </h4>
              </div>
              <div class="card-text">
                {{$text->where('key','about_feature4_subtitle')->first()->value}}
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
                    {{$text->where('key','about_subheader')->first()->value}}

        </h3>
        <a class="btn btn-light text-primary" href="/company-register">Join Us Now!</a>
      </div>

    </div>
  </div>
</x-base>
@endsection
