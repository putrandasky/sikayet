@extends('layouts.website')

@section('meta')
<title>{{$company->name}}</title>
<meta name="description" content="{{$company->profile}}">
<meta name="keywords" content="{{$keywords}}">
<meta property="og:title" content="{{$company->name}}" />
<meta property="og:site_name" content="{{$company->name}}" />
<meta property="og:type" content="website" />
<meta property="og:description" content="{{$company->profile}}">
<meta property="og:image" content="{{ $company->avatar ? asset("/storage/company/{$company->avatar}") : asset("/images/company-no-avatar.png") }}">
<meta property="og:url" content="{{url()->current()}}" />
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{$company->name}}">
<meta name="twitter:description" content="{{$company->profile}}">
<meta name="twitter:image:src" content="{{ $company->avatar ? asset("/storage/company/{$company->avatar}") : asset("/images/company-no-avatar.png") }}">
<meta name="twitter:image" content="{{ $company->avatar ? asset("/storage/company/{$company->avatar}") : asset("/images/company-no-avatar.png") }}">


@endsection
@section('content')
<x-base>
  <x-header-wrapper>
    <div class="row">
      <div class="col-lg-8">
        <x-header-info>
          @slot('image_col')
          3
          @endslot
          @slot('data_col')
          9
          @endslot
          @slot('image_area')
          <div class="bg-white  rounded" style="height: auto;width:120px">
            @if ($company->avatar)

            <img class="img-fluid " src="{{ asset("/storage/company/{$company->avatar}") }}" alt="">
            @else
            <span class="b-avatar badge-secondary rounded-sm" style="width:120px;height:120px"><i class="fa fa-briefcase fa-3x"></i></span>
            @endif
          </div>
          @endslot
          @slot('data_area')
          <div>
            <div class="text-light text-center text-sm-left">{{$company->business_category->name}}</div>
            <div class="text-white text-center text-sm-left">
              <h1>{{$company->name}}</h1>
            </div>
            <div class="d-flex mb-3 justify-content-center justify-content-sm-start">
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
                  <div class="text-light">

                    Rating : {{$company->rating}} of 5.0
                  </div>
            </div>
            <div class="d-flex">
              <div class="text-success">Solutions : {{$company->review_solution ?? 0}}</div>
              <div class="text-danger ml-3">Complaints : {{$company->review_complaint ?? 0}}</div>
              <div class="text-secondary ml-3">Generals : {{$company->review_general ?? 0}}</div>
            </div>
          </div>
          @endslot

        </x-header-info>

      </div>
      <div class="col-lg-4 ">
        <div class="mb-3">
          @php
          $total_star_count = $company->star_1 + $company->star_2 + $company->star_3 + $company->star_4 + $company->star_5;
          @endphp
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($company->star_5 * 100) /($total_star_count ) : 0 }}
            @endslot
            5 stars
          </x-progress>
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($company->star_4 * 100) /($total_star_count ) : 0 }}
            @endslot
            4 stars
          </x-progress>
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($company->star_3 * 100) /($total_star_count ) : 0 }}
            @endslot
            3 stars
          </x-progress>
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($company->star_2 * 100) /($total_star_count ) : 0 }}
            @endslot
            2 stars
          </x-progress>
          <x-progress>
            @slot('value')
            {{ $total_star_count ? ($company->star_1 * 100) /($total_star_count ) : 0 }}
            @endslot
            1 stars
          </x-progress>
        </div>
        <div class="w-100 text-center text-light">
          Visitor : {{$company->visited}}
        </div>
      </div>
    </div>

  </x-header-wrapper>
  <section class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          @php
          $urlquery = (request()->url()) .'?';
          @endphp

          @if (request()->input('keyword') && count($reviews) == 0)
          <div class="alert alert-info">
            <p class="h4 alert-heading">Review Not Found</p>
            <p>The review base on your keyword was not found, please try with different keyword</p>
          </div>
          @endif
          @if (!request()->input('keyword') && count($reviews) > 0)

          <div class="border-bottom border-dark w-100 pb-1 d-flex  align-items-center">
            @php
            $url_order_by = (request()->has('rating')) ? (request()->url()).'?rating=' . (request()->input('rating')) .'&' : (request()->url()) . '?';
            @endphp
            <a class="text-dark mr-3  {{(request()->input('order_by') != 'oldest') ? 'border rounded border-secondary py-1 px-2 btn disabled' : ''}} " href="{{ $url_order_by }}order_by=latest  ">
              <h3 class="mb-0">
                Latest
              </h3>
            </a>
            <a class="text-dark btn {{(request()->input('order_by') == 'oldest') ? 'border rounded border-secondary py-1 px-2  btn disabled' : ''}} " href="{{$url_order_by}}order_by=oldest">
              <h3 class="mb-0">
                Oldest
              </h3>
            </a>
          </div>
          <div class="d-flex pt-3 mb-3 align-items-center">
            <a class="text-dark  mr-3 {{!(request()->input('rating')) ? 'border rounded border-secondary py-1 px-2  btn disabled' : ''}}  " href="/brand/{{$company->slug}}">
              <h5 class="mb-0">
                All
              </h5>
            </a>

            <a class="text-dark mr-3 {{(request()->input('rating') == 5) ? 'border rounded border-secondary py-1 px-2  btn disabled' : ''}}  " href="{{$urlquery}}rating=5">
              <h5 class="mb-0">

                5 Stars ({{$company->star_5 ?? 0}})
              </h5>
            </a>
            <a class="text-dark mr-3 {{(request()->input('rating') == 4) ? 'border rounded border-secondary py-1 px-2  btn disabled' : ''}}  " href="{{$urlquery}}rating=4">
              <h5 class="mb-0">
                4 Stars ({{$company->star_4 ?? 0}})
              </h5>
            </a>
            <a class="text-dark mr-3 {{(request()->input('rating') == 3) ? 'border rounded border-secondary py-1 px-2  btn disabled' : ''}}  " href="{{$urlquery}}rating=3">
              <h5 class="mb-0">
                3 Stars ({{$company->star_3 ?? 0}})
              </h5>
            </a>
            <a class="text-dark mr-3 {{(request()->input('rating') == 2) ? 'border rounded border-secondary py-1 px-2  btn disabled' : ''}}  " href="{{$urlquery}}rating=2">
              <h5 class="mb-0">
                2 Stars ({{$company->star_2 ?? 0}})
              </h5>
            </a>
            <a class="text-dark mr-3 {{(request()->input('rating') == 1) ? 'border rounded border-secondary py-1 px-2  btn disabled' : ''}}  " href="{{$urlquery}}rating=1">
              <h5 class="mb-0">
                1 Stars ({{$company->star_1 ?? 0}})
              </h5>
            </a>
          </div>
          @endif
          @if (!request()->input('keyword') && count($reviews) == 0)
          <div class="alert alert-info">
            <p class="h4 alert-heading">Review Not Found</p>
            <p>Be the the first to review this company</p>
          </div>
          @endif
          @foreach ( $reviews as $review )

          <x-company-detail.card-review>

            <x-company-detail.user-review>

              @slot('user_avatar')
              @if ($review->user->avatar)
              <img class="rounded rounded-circle img-fluid" src="{{ asset("/storage/user/tmb128-{$review->user->avatar}") }}" alt="" style="width: 50px;heigh:auto">
              @else
              <span class="b-avatar badge-secondary rounded rounded-circle" style="width:50px;height:50px"><i class="fa fa-user fa-2x "></i></span>
              @endif
              @endslot
              @slot('user_name')
              <a href="/user/{{$review->user->slug}}" class="text-dark">
                {{ explode(' ',trim($review->user->name))[0] }}
              </a>
              <div style="white-space: nowrap">
                <small class="text-secondary">{{$review->user->review}} <i class="fa fa-pencil"></i> </small>
                <small class="text-secondary">{{$review->user->like}} <i class="fa fa-thumbs-up"></i> </small>
                <small class="text-secondary">{{$review->user->dislike}} <i class="fa fa-thumbs-down"></i></small>

              </div>
              @endslot
              @slot('rating')
              @php
              $usermod = fmod($review->rating,1) > 0.5 ? 1 : 0;
              $userrating = intval($review->rating) + $usermod;

              @endphp

              @for ($i = 1 ; $i <= $userrating; $i++ ) <x-rating-green>
                </x-rating-green>
                @endfor

                @for ($a = 1 ; $a <= (5 - $userrating); $a++ ) <x-rating-grey>
                  </x-rating-grey>
                  @endfor

                  @endslot
                  @slot('posted_date')
                  Published {{Carbon\Carbon::parse($review->created_at)->format('d M Y')}}
                  @endslot
                  @slot('review_title')
                  <a class="text-dark" href="/review/{{$review->slug}}">{{$review->title}}</a>

                  @endslot
                  @slot('review_content')
                  {{$review->description}}
                  <div class="badge badge-{{$review->review_type->name == 'SOLUTION' ? 'success' : ($review->review_type->name == 'COMPLAIN' ? 'danger' : 'secondary') }}">
                    {{$review->review_type->name}}
                  </div>
                  @endslot
                  @slot('user_action')

                  <review-action :review_owner_id="@json($review->user->id)" :user="{{ auth()->user() ?? '{}'}}" :review_id="@json($review->id)" :proplike="@json($review->like)" :propdislike="@json($review->dislike)"></review-action>
                  @endslot
                  @if ($review->photo)
                  <div>
                    <img class="img-fluid" src="{{ asset("/storage/reviewasset/{$review->photo}") }}" alt="" srcset="">
                  </div>
                  @endif
            </x-company-detail.user-review>
            @if ($review->company_respond)

            <x-company-detail.company-reply>

              @slot('company_avatar')
              @if ($company->avatar)
              <img class="rounded rounded-circle img-fluid" src="{{ asset("/storage/company/tmb128-{$company->avatar}") }}" alt="" style="width: 50px;heigh:auto">
              @else
              <span class="b-avatar badge-secondary rounded rounded-circle" style="width:50px;height:50px"><i class="fa fa-briefcase fa-2x "></i></span>
              @endif
              @endslot
              @slot('company_name')
              {{$review->company_respond->company->name}}
              @endslot

              @slot('posted_date')
              Published {{ Carbon\Carbon::parse($review->company_respond->created_at)->format('d M Y')}}

              @endslot

              @slot('reply_content')
              {{$review->company_respond->description}}

              @endslot
            </x-company-detail.company-reply>


            @endif

          </x-company-detail.card-review>
          @if ($loop->index == 2)
          @if (!$company->membership_active)
          <x-ads></x-ads>
          @endif
          @endif
          @endforeach
          @if ($reviews->lastPage() >1)

          <nav aria-label="">
            <ul class="pagination text-center justify-content-center">
              {{-- {{ $reviews->links() }} --}}
              {{-- <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li> --}}
              @php
              $paginate_order_by = (request()->has('order_by')) ? '&order_by=' . (request()->input('order_by')) : '';
              $paginate_rating = (request()->has('rating')) ? '&rating=' . (request()->input('rating')) : '';
              $paginate_keyword = (request()->has('keyword')) ? '&keyword=' . (request()->input('keyword')) : '';
              $paginate_url = $paginate_keyword . $paginate_rating . $paginate_order_by;
              @endphp
              @for ($i = 1; $i <=$reviews->lastPage() ; $i++ )
                <li class="page-item {{$reviews->currentPage() == $i ? 'active' : ''}} "><a class="page-link" href="{{(request()->url())}}?page={{$i . $paginate_url}}">{{$i}}</a></li>

                @endfor
                {{-- <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li> --}}
                {{-- <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>  --}}
            </ul>
          </nav>
          @endif
        </div>
        <div class="col-lg-4">
          <div class="w-100 mb-3">
            @if (auth('web')->check() && !$reviewed)

            <a class="btn btn-success btn-block" href="/brand/{{$company->slug}}/write-review">Write a Review</a>
            @endif
            @if (!auth('web')->check() && !auth('company')->check())
            <a class="btn btn-success  btn-block" href="/user-login">Write a Review</a>
            @endif
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <div class="mb-3">
                <strong>Profile</strong>
                <div>
                  {{$company->profile}}
                </div>
              </div>
              <div class="mb-3">
                <strong>Website</strong>
                <div>
                  <a href="{{$company->website}}">{{$company->website}}</a>
                </div>
              </div>
              <div>
                <strong>Our Social Media</strong>
                <div>

                  @if ($company->facebook_url)
                  <a href="{{$company->facebook_url}}" class="badge badge-primary p-1" style="background-color: #1877f2"><i class="fa fa-facebook"></i> Facebook</a>
                  @endif
                  @if ($company->twitter_url)
                  <a href="{{$company->twitter_url}}" class="badge badge-primary p-1" style="background-color: #1da1f2"><i class="fa fa-twitter"></i> Twitter</a>
                  @endif
                  @if ($company->linkedin_url)
                  <a href="{{$company->linkedin_url}}" class="badge badge-primary p-1" style="background-color: #007bb5"><i class="fa fa-linkedin"></i> Linkedin</a>
                  @endif
                  @if ($company->instagram_url)
                  <a href="{{$company->instagram_url}}" class="badge badge-primary p-1" style="background-color: #c32aa3"><i class="fa fa-instagram"></i> Instagram</a>
                  @endif
                </div>
              </div>

            </div>

          </div>
          @if (count($reviews) > 0)
          <div class="card mb-3">
            <div class="card-body">
              <div class="card-title">
                <p class="h4">Keyword Filter</p>
              </div>
              <div class="mb-3">
                <form action="{{request()->url()}}" method="get">
                  <div class="form-group position-relative">
                    <input class="form-control pl-5" type="text" name="keyword">
                    <i class="fa fa-search position-absolute text-secondary" style="top:12px;left:15px"></i>

                  </div>
                </form>
              </div>
              <div class="d-flex flex-wrap">
                <a class="btn {{(request()->input('keyword') ) ? 'btn-outline-secondary ' : 'btn-secondary disabled'    }}  mr-1 mb-1" href="{{request()->url()}}">Show All</a>
                @foreach ( $common_words as $word )
                <a class="btn {{(request()->input('keyword') == $word) ? 'btn-secondary disabled' : 'btn-outline-secondary '  }} mr-1 mb-1" href="{{$urlquery}}keyword={{$word}}">{{$word}}</a>
                @endforeach
                {{-- <common-words :slug="'{{$company->slug}}'"></common-words> --}}
              </div>
            </div>
          </div>
          @endif
           @if (!$company->membership_active)
           <x-ads></x-ads>
           @endif
        </div>
      </div>

    </div>
  </section>
</x-base>
@endsection
