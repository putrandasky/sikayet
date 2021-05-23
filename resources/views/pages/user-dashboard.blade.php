@extends('layouts.website')


@section('content')
<x-base>
  <x-header-wrapper>
    <div class="row my-3">
      <div class="col-sm-6 mb-3 d-flex align-items-center justify-content-center justify-content-sm-start">
        <x-header-info>
          @slot('image_col')
          5
          @endslot
          @slot('data_col')
          7
          @endslot
          @slot('image_area')
          <img class="img-fluid rounded-circle" style="height: auto;width:120px" src="{{ asset('images/websites/avatar1.jpg') }}" alt="">
          @endslot
          @slot('data_area')
          <div>
            <div class="text-white text-center text-sm-left">
              <h3>John Doe</h3>
            </div>
            <div class="text-light text-center text-sm-left">Turkey</div>
          </div>
          @endslot

        </x-header-info>
      </div>
      <div class="col-sm-6 d-flex justify-content-center align-items-center">
        <div class="d-flex">
          <x-user-dashboard.summary>
            @slot('value')
            300
            @endslot
            @slot('title')
            <i class="fa fa-star"></i> Reviews
            @endslot
          </x-user-dashboard.summary>
          <x-user-dashboard.summary>
            @slot('value')
            30
            @endslot
            @slot('title')
            <i class="fa fa-user"></i> Reads
            @endslot
          </x-user-dashboard.summary>
          <x-user-dashboard.summary>
            @slot('value')
            3
            @endslot
            @slot('title')
            <i class="fa fa-thumbs-up"></i> Useful
            @endslot
          </x-user-dashboard.summary>

        </div>
      </div>
    </div>
  </x-header-wrapper>
  <section class="py-3">
    <div class="container">
      <div class="card">
        <div class="card-body">
          <user-dashboard></user-dashboard>

        </div>
      </div>
    </div>
  </section>
</x-base>
@endsection
