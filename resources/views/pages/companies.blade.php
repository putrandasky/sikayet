@extends('layouts.website')


@section('content')
<x-base>
  <x-header-wrapper>
    <div class="row">
<div class="col-md-6 text-white">
        <h4 class="">{{$count}} Results of your query</h4>

</div>
<div class="col-md-6 w-100">
  <div class="row justify-content-end">

    <home-search></home-search>
  </div>

</div>
    </div>
  </x-header-wrapper>
  <section class="py-3">
    <div class="container">

      @foreach ($companies as $company)
      <x-home.companies>
        @slot('name')
        {{$company['name']}}
        @endslot
              @slot('avatar')
              @if ($company['avatar'])

              <img class="img-fluid " src="{{ asset("/storage/company/{$company['avatar']}") }}" alt="">
              @else
              <span class="b-avatar badge-secondary rounded-sm" style="width:120px;height:120px"><i class="fa fa-briefcase fa-3x"></i></span>
              @endif
              @endslot
        @slot('profile')
        {{$company['profile']}}
        @endslot
        @slot('review')
        {{$company['review']}}
        @endslot
        @slot('rating')
        @php
        $mod = fmod($company['rating'],1) > 0.5 ? 1 : 0;
        $rating = intval($company['rating']) + $mod;

        @endphp
        @for ($i = 1 ; $i <= $rating; $i++ ) <x-rating-green>
          </x-rating-green>
          @endfor
          @for ($a = 1 ; $a <= (5 - $rating); $a++ ) <x-rating-grey>
            </x-rating-grey>
            @endfor
            @endslot
            @slot('slug')
            {{$company['slug']}}
            @endslot
      </x-home.companies>
      @endforeach
        @if ($companies->lastPage() >1)

        <nav aria-label="">
          <ul class="pagination text-center justify-content-center">

            @php
            $paginate_name = (request()->has('name')) ? '&name=' . (request()->input('name')) : '';
            $paginate_url =$paginate_name;
            @endphp
            @for ($i = 1; $i <=$companies->lastPage() ; $i++ )
              <li class="page-item {{$companies->currentPage() == $i ? 'active' : ''}} "><a class="page-link" href="{{(request()->url())}}?page={{$i . $paginate_url}}">{{$i}}</a></li>

              @endfor

          </ul>
        </nav>
        @endif
    </div>
  </section>
</x-base>
@endsection
