@extends('layouts.website')


@section('content')
<x-base>
<x-hero addClass="mt-5  parallax">
  <x-slot name="title">
    Every Review is an Experience!
  </x-slot>
  <x-slot name="subtitle">
  Check Ratings of Businesses, Read Reviews & Make a review
  </x-slot>
<x-home.search/>
</x-hero>

<section class="d-md-block d-none shadow-sm bg-white">
  <div class="container py-3 ">

    <div class="  d-flex  align-items-center justify-content-between">
      <h4 class="mb-0">

        <b>Company Brand : </b>
      </h4>
      <a class="" href="/company-brands">A</a>
      <a class="" href="/company-brands">B</a>
      <a class="" href="/company-brands">C</a>
      <a class="" href="/company-brands">D</a>
      <a class="" href="/company-brands">E</a>
      <a class="" href="/company-brands">F</a>
      <a class="" href="/company-brands">G</a>
      <a class="" href="/company-brands">H</a>
      <a class="" href="/company-brands">I</a>
      <a class="" href="/company-brands">J</a>
      <a class="" href="/company-brands">K</a>
      <a class="" href="/company-brands">L</a>
      <a class="" href="/company-brands">M</a>
      <a class="" href="/company-brands">N</a>
      <a class="" href="/company-brands">O</a>
      <a class="" href="/company-brands">P</a>
      <a class="" href="/company-brands">Q</a>
      <a class="" href="/company-brands">R</a>
      <a class="" href="/company-brands">S</a>
      <a class="" href="/company-brands">T</a>
      <a class="" href="/company-brands">U</a>
      <a class="" href="/company-brands">V</a>
      <a class="" href="/company-brands">W</a>
      <a class="" href="/company-brands">X</a>
      <a class="" href="/company-brands">Y</a>
      <a class="" href="/company-brands">Z</a>
      <a class="" href="/company-brands">Show All</a>
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
    <x-home.companies>
      @slot('rating')
      <x-rating-green></x-rating-green>
      <x-rating-green></x-rating-green>
      <x-rating-green></x-rating-green>
      <x-rating-green></x-rating-green>
      <x-rating-grey></x-rating-grey>
      @endslot
    </x-home.companies>
    <x-home.companies>
      @slot('rating')
      <x-rating-green></x-rating-green>
      <x-rating-green></x-rating-green>
      <x-rating-green></x-rating-green>
      <x-rating-green></x-rating-green>
      <x-rating-grey></x-rating-grey>
      @endslot
    </x-home.companies>
    <x-home.companies>
      @slot('rating')
      <x-rating-green></x-rating-green>
      <x-rating-green></x-rating-green>
      <x-rating-green></x-rating-green>
      <x-rating-green></x-rating-green>
      <x-rating-grey></x-rating-grey>
      @endslot
    </x-home.companies>
    <x-home.companies>
      @slot('rating')
      <x-rating-green></x-rating-green>
      <x-rating-green></x-rating-green>
      <x-rating-green></x-rating-green>
      <x-rating-green></x-rating-green>
      <x-rating-grey></x-rating-grey>
      @endslot
    </x-home.companies>
    <div class="w-100 text-center">
      <button class="btn btn-primary px-5"> Load More </button>
    </div>
  </div>
</section>
</x-base>
@endsection
