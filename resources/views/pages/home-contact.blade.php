@extends('layouts.website')
@section('meta')
<title>@lang('website/home.general_title.contact_us')</title>
@endsection

@section('content')
<x-base>
  <x-header-wrapper>
    <div class="text-center text-white">
    <h1>@lang('website/home.general_title.get_in_touch')</h1>
    </div>
  </x-header-wrapper>
  <section class="py-3">
    <contact></contact>
  </section>
</x-base>
@endsection
