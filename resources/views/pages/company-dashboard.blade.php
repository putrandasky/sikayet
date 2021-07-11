@extends('layouts.website')

@section('meta')
<title>Dashboard | {{$data['company']->name}}</title>


@endsection

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

            <company-profile-image :profileimage="'{{ $data['company']->avatar }}'"></company-profile-image>
            {{-- <img class="img-fluid " src="{{ asset('images/websites/logo-company.png') }}" alt=""> --}}
            {{-- <span class="b-avatar badge-secondary rounded-sm" style="width:120px;height:120px"><i class="fa fa-briefcase fa-3x"></i></span> --}}
             {{-- <div class="bg-secondary rounded px-1 mx-1"><i class="fa fa-briefcase text-white  "></i></div> --}}
          @endslot
          @slot('data_area')
          <div>
            <div class="text-light text-center text-sm-left">{{$data['company']->business_category->name}}</div>
            <div class="text-white text-center text-sm-left">
              <a class="text-white" href="/brand/{{$data['company']->slug}}" target="_blank">
                <h3>{{$data['company']->name}}</h3>
              </a>

            </div>
            <div class="d-flex mb-3 justify-content-center justify-content-sm-start">
              @php
              $mod = fmod($data['company']['rating'],1) > 0.5 ? 1 : 0;
              $rating = intval($data['company']['rating']) + $mod;

              @endphp
              @for ($i = 1 ; $i <= $rating; $i++ ) <x-rating-green>
                </x-rating-green>
                @endfor
                @for ($a = 1 ; $a <= (5 - $rating); $a++ ) <x-rating-grey>
                  </x-rating-grey>
                  @endfor
                         <div class="text-light">

                           Rating : {{$data['company']['rating']}} of 5.0
                         </div>
            </div>
            <div class="d-flex" style="overflow: auto;
    white-space: nowrap;">
              <div class="text-success">Solutions : {{$data['company']->review_solution}}</div>
              <div class="text-danger ml-3">Complaints : {{$data['company']->review_complaint}}</div>
              <div class="text-secondary ml-3">Generals : {{$data['company']->review_general}}</div>
            </div>
          </div>
          @endslot

        </x-header-info>

      </div>
      <div class="col-lg-4 ">
        <div class="mb-3">
          @php
          $total_star_count = $data['company']->star_1 + $data['company']->star_2 + $data['company']->star_3 + $data['company']->star_4 + $data['company']->star_5;
          @endphp
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($data['company']->star_5 * 100) /($total_star_count ) : 0 }}
            @endslot
            5 stars
          </x-progress>
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($data['company']->star_4 * 100) /($total_star_count ) : 0 }}
            @endslot
            4 stars
          </x-progress>
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($data['company']->star_3 * 100) /($total_star_count ) : 0 }}
            @endslot
            3 stars
          </x-progress>
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($data['company']->star_2 * 100) /($total_star_count ) : 0 }}
            @endslot
            2 stars
          </x-progress>
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($data['company']->star_1 * 100) /($total_star_count ) : 0 }}
            @endslot
            1 stars
          </x-progress>
        </div>
                <div class="w-100 text-center text-light">
                  Visitor : {{$data['company']->visited ?? 0}}
                </div>
      </div>
    </div>
  </x-header-wrapper>
  <section class="py-3">
    <company-dashboard :company="{{$data['company']}}" :business_category="{{$data['business_category']}}"></company-dashboard>
  </section>
</x-base>
@endsection
