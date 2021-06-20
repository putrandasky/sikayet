@extends('layouts.website')

@section('meta')
<title>Dashboard | {{$user->name}}</title>



@endsection
@section('content')
<x-base>
  <x-header-wrapper>
    <div class="row my-3">
      <div class="col-sm-6 mb-3 d-flex align-items-center justify-content-center justify-content-sm-start">
        <x-header-info>
          @slot('image_col')
          5
          @endslot
          @slot('data_col')
          7
          @endslot
          @slot('image_area')
          <user-profile-image :profileimage="'{{$user->avatar}}'"></user-profile-image>
          {{-- <img class="img-fluid rounded-circle" style="height: auto;width:120px" src="{{ asset('images/websites/avatar1.jpg') }}" alt=""> --}}
          @endslot
          @slot('data_area')
            <div class="text-white text-center text-sm-left">
              <h3>{{$user->name}}


              </h3>
            </div>
            {{-- <div class="text-light text-center text-sm-left">Turkey</div> --}}
          @endslot

        </x-header-info>
      </div>
      <div class="col-sm-6 d-flex justify-content-center align-items-center">
        <div class="d-flex">
          <x-user-dashboard.summary>
            @slot('value')
            {{$user->review }}
            @endslot
            @slot('title')
            <i class="fa fa-star"></i> Reviews
            @endslot
          </x-user-dashboard.summary>
          <x-user-dashboard.summary>
            @slot('value')
            {{$user->like}}
            @endslot
            @slot('title')
            <i class="fa fa-thumbs-up"></i> Likes
            @endslot
          </x-user-dashboard.summary>
          <x-user-dashboard.summary>
            @slot('value')
            {{$user->dislike}}
            @endslot
            @slot('title')
            <i class="fa fa-thumbs-down"></i> Dislikes
            @endslot
          </x-user-dashboard.summary>

        </div>
      </div>
    </div>
  </x-header-wrapper>
  <section class="py-3">
    <div class="container">
      <div class="card">
        <div class="card-body">
          <user-dashboard :user="{{$user}}"></user-dashboard>

        </div>
      </div>
    </div>
  </section>
</x-base>
@endsection
