@extends('layouts.website')


@section('content')
<x-base-plain>
  @slot('image')
  company-login.jpg
  @endslot
<company-register/>
</x-base-plain>
@endsection
