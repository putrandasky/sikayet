@extends('layouts.website')
@section('meta')
<title>Agreement</title>
@endsection

@section('content')
<x-base>
  <div class="pt-5 bg-white" style="min-height:100%">
    <div class="container pb-3">

      {!! $text !!}
    </div>
  </div>
</x-base>
@endsection
