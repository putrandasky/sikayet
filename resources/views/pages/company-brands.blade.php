@extends('layouts.website')


@section('content')
<x-base>

<div id="header-company-brands" class="container my-5 py-5">
  <div class="w-100 text-center mb-5">
    <h1>
      <strong>

        @lang('website/home.company_brand')
      </strong>
    </h1>
  </div>
  <div class="alphabet w-100 d-flex align-items-center justify-content-between" style="overflow: auto;
    white-space: nowrap">

      @foreach ( range('A', 'Z') as $char )
      <a class="mr-1" href="/brands/{{$char}}">{{$char}}</a>
      @endforeach
      {{-- <a class="" href="/brands">Show All</a> --}}
  </div>

</div>
<section class=" bg-white">

  <div class="container-fluid py-5">
    @foreach ( $data as $key => $brands)

    <x-company-brand.brand-list>
      @slot('title') {{$key}} @endslot
      @foreach ( $brands as $brand )

      <x-company-brand.brand-list-item>
      @slot('slug') {{$brand['slug']}} @endslot
        {{$brand['name']}}
      </x-company-brand.brand-list-item>
      @endforeach

    </x-company-brand.brand-list>
       @endforeach

  </div>
</section>
</x-base>

@endsection
