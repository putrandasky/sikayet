@extends('layouts.website')


@section('content')
<x-base>
  <x-header-wrapper>
    <div class="py-3 text-white">
    <h1 class="">@lang('user/review.review_any_company')</h1>
    </div>
  </x-header-wrapper>
  <section class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <user-write-review-anycompany :reviewtype='@json($review_type)' :term='@json($term)' :social-login-status="'{{ session('status') ?? '' }}'" :is-logged-in="'{{auth('web')->check() ?? false}}'" />
        </div>
      </div>
    </div>
  </section>
</x-base>
  @endsection
