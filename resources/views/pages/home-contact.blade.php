@extends('layouts.website')
@section('meta')
<title>Contact Us</title>
@endsection

@section('content')
<x-base>
  <x-header-wrapper>
    <div class="text-center text-white">
    <h1>Get in Touch with Us</h1>
    </div>
  </x-header-wrapper>
  <section class="py-3">
    <contact></contact>
  </section>
</x-base>
@endsection
