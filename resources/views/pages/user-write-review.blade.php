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
            <div class="text-light text-center text-sm-left">{{$company->business_category->name}}</div>
            <div class="text-white text-center text-sm-left">
              <h3>{{$company->name}}</h3>
            </div>
            <div class="d-flex mb-3 justify-content-center justify-content-sm-start">
              @php
              $mod = fmod($company['rating'],1) > 0.5 ? 1 : 0;
              $rating = intval($company['rating']) + $mod;

              @endphp
              @for ($i = 1 ; $i <= $rating; $i++ ) <x-rating-green>
                </x-rating-green>
                @endfor
                @for ($a = 1 ; $a <= (5 - $rating); $a++ ) <x-rating-grey>
                  </x-rating-grey>
                  @endfor
            </div>
            <div class="d-flex">
              <div class="text-success">Solutions : {{$company->review_solution}}</div>
              <div class="text-danger ml-3">Complaints : {{$company->review_complaint}}</div>
              <div class="text-secondary ml-3">Generals : {{$company->review_general}}</div>
            </div>
          </div>
          @endslot

        </x-header-info>

      </div>
      <div class="col-lg-4 ">
        <div>
                    @php
                    $total_star_count = $company->star_1 + $company->star_2 + $company->star_3 + $company->star_4 + $company->star_5;
                    @endphp
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($company->star_5 * 100) /($total_star_count) : 0 }}
            @endslot
            5 stars
          </x-progress>
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($company->star_4 * 100) /($total_star_count) : 0 }}
            @endslot
            4 stars
          </x-progress>
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($company->star_3 * 100) /($total_star_count) : 0 }}
            @endslot
            3 stars
          </x-progress>
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($company->star_2 * 100) /($total_star_count) : 0 }}
            @endslot
            2 stars
          </x-progress>
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($company->star_1 * 100) /($total_star_count) : 0 }}
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
          @if ($reviewed)
<div class="alert alert-info">
Company Reviewed
</div>
          @else
          <user-write-review :companyid='@json($company->id)' :slug='@json($company->slug)' :companyname='@json($company->name)' :reviewtype='@json($review_type)' :term='@json($term)'>
            @endif
        </div>
      </div>
    </div>
  </section>
</x-base>
@endsection
