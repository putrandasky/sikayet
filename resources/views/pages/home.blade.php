@extends('layouts.website')


@section('content')
<x-base>
<x-hero addClass="mt-5  parallax">
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

<section class="d-md-block d-none shadow-sm bg-white">
  <div class="container py-3 ">

    <div class="  d-flex  align-items-center justify-content-between">
      <h4 class="mb-0">

        <b>Company Brand : </b>
      </h4>
      @foreach ( range('A', 'Z') as $char )
        <a class="" href="/brands/{{$char}}">{{$char}}</a>
      @endforeach
      <a class="" href="/brands">Show All</a>
    </div>

  </div>
</section>

<section>

  <div class="container p-5 ">
    <div class="w-100  mb-3">
      <h2>
        <strong>
          Our Top Companies
        </strong>
      </h2>
    </div>
    @foreach ($data['top-company'] as $company)

    <x-home.companies>
      @slot('name')
          {{$company['name']}}
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
      @for ($i = 1 ; $i <= $rating; $i++ )
      <x-rating-green></x-rating-green>
      @endfor
      @for ($a = 1 ;  $a <= (5 - $rating); $a++ )
      <x-rating-grey></x-rating-grey>
      @endfor
      @endslot
      @slot('slug')
          {{$company['slug']}}
      @endslot
    </x-home.companies>
    @endforeach
    {{-- <div class="w-100 text-center">
      <button class="btn btn-primary px-5"> Load More </button>
    </div> --}}
  </div>
</section>
</x-base>
@endsection
