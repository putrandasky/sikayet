@extends('layouts.website')
@section('meta')
<title>Frequently Asked Question</title>
@endsection

@section('content')
<x-base>
  <x-header-wrapper>
    <div class="row">
      <div class="col-md-6 text-white">
        <h4 class="">Frequently Asked Question</h4>

      </div>
      <div class="col-md-6 w-100">
        <div class="row justify-content-end">

          <home-search></home-search>
        </div>

      </div>
    </div>
  </x-header-wrapper>
  <section class="py-3">
<faq :data="{{$data}}"></faq>
  </section>
</x-base>
@endsection
