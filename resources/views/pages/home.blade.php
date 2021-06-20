@extends('layouts.website')


@section('content')
<x-base>
  <x-hero addClass="  parallax">
    <x-slot name="title">
      {{$data['header']['title']}}
    </x-slot>
    <x-slot name="subtitle">
      {{$data['header']['subtitle']}}
    </x-slot>
    <div class="row justify-content-center">

      <home-search></home-search>
    </div>
    {{-- <x-home.search/> --}}
  </x-hero>

  <section class=" shadow-sm bg-white">
    <div class="container py-3 ">
      <div class="w-100 text-center">

        <h4>

          <b>Company Brand </b>
        </h4>
      </div>
      <div class="  d-flex  align-items-center justify-content-between">
        {{-- <h4 class="mb-0">

        <b>Company Brand : </b>
      </h4> --}}
        @foreach ( range('A', 'Z') as $char )
        <a class="" href="/brands/{{$char}}">{{$char}}</a>
        @endforeach
        {{-- <a class="" href="/brands">Show All</a> --}}
      </div>

    </div>
  </section>

  <section>

    <div class="container p-5 ">
      <div class="w-100 text-center  mb-3">
        <h2>
          <strong>
            Our Top Companies
          </strong>
        </h2>
      </div>
      {{-- @foreach ($data['top-company'] as $company)

      <x-home.companies>
        @slot('name')
        <a class="text-dark" href="/brand/{{$company['slug']}}">{{$company['name']}}</a>

        @endslot
        @slot('avatar')
        <a class="text-dark" href="/brand/{{$company['slug']}}">
        @if ($company['avatar'])

          <img class="img-fluid " src="{{ asset("/storage/company/{$company['avatar']}") }}" alt="">
          @else
          <span class="b-avatar badge-secondary rounded-sm" style="width:120px;height:120px"><i class="fa fa-briefcase fa-3x"></i></span>
          @endif
        </a>
        @endslot
        @slot('profile')
        {{$company['profile']}}
        @endslot
        @slot('review')
        {{$company['review']}}
        @endslot
        @slot('rating')
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
            @endslot
            @slot('total_rating')
       Rating: {{$company['rating']}} of 5.0
            @endslot
            @slot('slug')
            {{$company['slug']}}
            @endslot
      </x-home.companies>
      @endforeach --}}
      {{-- <div class="w-100 text-center">
      <button class="btn btn-primary px-5"> Load More </button>
    </div> --}}
    <home-top-company></home-top-company>
    </div>
  </section>
</x-base>
@endsection
