@extends('layouts.website')


@section('content')
<x-base>

<div id="header-company-brands" class="container my-5 py-5">
  <div class="w-100 text-center mb-5">
    <h1>
      <strong>

        Company Brand
      </strong>
    </h1>
  </div>
  <div  class="alphabet w-100  d-sm-flex d-none  align-items-center justify-content-between">

    <a class="" href="">A</a>
    <a class="" href="">B</a>
    <a class="" href="">C</a>
    <a class="" href="">D</a>
    <a class="" href="">E</a>
    <a class="" href="">F</a>
    <a class="" href="">G</a>
    <a class="" href="">H</a>
    <a class="" href="">I</a>
    <a class="" href="">J</a>
    <a class="" href="">K</a>
    <a class="" href="">L</a>
    <a class="" href="">M</a>
    <a class="" href="">N</a>
    <a class="" href="">O</a>
    <a class="" href="">P</a>
    <a class="" href="">Q</a>
    <a class="" href="">R</a>
    <a class="" href="">S</a>
    <a class="" href="">T</a>
    <a class="" href="">U</a>
    <a class="" href="">V</a>
    <a class="" href="">W</a>
    <a class="" href="">X</a>
    <a class="" href="">Y</a>
    <a class="" href="">Z</a>
    <a class="" href="">Show All</a>
  </div>

</div>
<section class=" bg-white">

  <div class="container-fluid py-5">
    <x-company-brand.brand-list>
      @slot('title') A @endslot
      <x-company-brand.brand-list-item>
        Ark Naturals
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          Arm & Hammer
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          Ark
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          Armstrong
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          AtlantickAuthority
        </x-company-brand.brand-list-item>
    </x-company-brand.brand-list>
    <x-company-brand.brand-list>
      @slot('title') B @endslot
      <x-company-brand.brand-list-item>
        Ark Naturals
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          Arm & Hammer
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          Ark
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          Armstrong
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          AtlantickAuthority
        </x-company-brand.brand-list-item>
    </x-company-brand.brand-list>
    <x-company-brand.brand-list>
      @slot('title') C @endslot
      <x-company-brand.brand-list-item>
        Ark Naturals
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          Arm & Hammer
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          Ark
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          Armstrong
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          AtlantickAuthority
        </x-company-brand.brand-list-item>
    </x-company-brand.brand-list>
    <x-company-brand.brand-list>
      @slot('title') D @endslot
      <x-company-brand.brand-list-item>
        Ark Naturals
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          Arm & Hammer
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          Ark
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          Armstrong
        </x-company-brand.brand-list-item>
        <x-company-brand.brand-list-item>
          AtlantickAuthority
        </x-company-brand.brand-list-item>
    </x-company-brand.brand-list>
  </div>
</section>
</x-base>

@endsection
