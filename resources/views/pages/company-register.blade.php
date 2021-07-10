@extends('layouts.website')

@section('meta')
<title>Company Register | {{config('app.name')}}</title>
<meta property="og:title" content="Company Register | {{config('app.name')}}" />
<meta property="og:site_name" content="Company Register | {{config('app.name')}}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{{ asset('images/icon.png') }}">
<meta property="og:url" content="{{config('app.url')}}" />
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="Company Register | {{config('app.name')}}">
<meta name="twitter:image:src" content="{{ asset('images/icon.png') }}">
<meta name="twitter:image" content="{{ asset('images/icon.png') }}">


@endsection
@section('content')
<x-base-plain>
  @slot('image')
  company-login.jpg
  @endslot
<company-register :category='@json($category)'/>
</x-base-plain>
@endsection
