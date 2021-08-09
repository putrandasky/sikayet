@extends('layouts.website')
@section('meta')
<title>@lang('website/home.general_title.faq')</title>
@endsection

@section('content')
<x-base>
  <x-header-wrapper>
    <div class="row">
      <div class="col-md-6 text-white">
        <h4 class="">@lang('website/home.general_title.faq')</h4>

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
