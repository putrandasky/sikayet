@extends('layouts.website')


@section('content')
<x-base>
  <x-header-wrapper>
    <div class="row">
      <div class="col-lg-8">
        <x-header-info>
          @slot('image_col')
          3
          @endslot
          @slot('data_col')
          9
          @endslot
          @slot('image_area')
          <div class="bg-white  rounded" style="height: auto;width:120px">
            <img class="img-fluid " src="{{ asset('images/websites/logo-company.png') }}" alt="">
          </div>
          @endslot
          @slot('data_area')
          <div>
            <div class="text-light text-center text-sm-left">Show</div>
            <div class="text-white text-center text-sm-left">
              <h3>Good Company</h3>
            </div>
            <div class="d-flex mb-3 justify-content-center justify-content-sm-start">
              <x-rating-green></x-rating-green>
              <x-rating-green></x-rating-green>
              <x-rating-green></x-rating-green>
              <x-rating-green></x-rating-green>
              <x-rating-grey></x-rating-grey>
            </div>
            <div class="d-flex">
              <div class="text-success">Solutions : 21</div>
              <div class="text-danger ml-3">Complaints : 201</div>
            </div>
          </div>
          @endslot

        </x-header-info>

      </div>
      <div class="col-lg-4 ">
        <div>
          <x-progress>
            @slot('value')
            80
            @endslot
            5 stars
          </x-progress>
          <x-progress>
            @slot('value')
            10
            @endslot
            4 stars
          </x-progress>
          <x-progress>
            @slot('value')
            5
            @endslot
            3 stars
          </x-progress>
          <x-progress>
            @slot('value')
            3
            @endslot
            2 stars
          </x-progress>
          <x-progress>
            @slot('value')
            2
            @endslot
            1 stars
          </x-progress>
        </div>
      </div>
    </div>
  </x-header-wrapper>
  <section class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <user-write-review/>
        </div>
      </div>
    </div>
  </section>
</x-base>
  @endsection
