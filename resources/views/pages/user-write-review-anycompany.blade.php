@extends('layouts.website')


@section('content')
<x-base>
  <x-header-wrapper>
    <div class="py-3 text-white">
    <h1 class="">Write a Review for Any Company May We Don't Have</h1>
    </div>
  </x-header-wrapper>
  <section class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <user-write-review-anycompany/>
        </div>
      </div>
    </div>
  </section>
</x-base>
  @endsection
