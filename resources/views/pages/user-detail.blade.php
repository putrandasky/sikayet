@extends('layouts.website')

@section('meta')
<title>{{$user->name}}</title>



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
          <div class="bg-white  rounded" style="height: auto;width:120px">
            @if ($user->avatar)

            <img class="img-fluid " src="{{ asset("/storage/user/{$user->avatar}") }}" alt="">
            @else
            <span class="b-avatar badge-secondary rounded-sm" style="width:120px;height:120px"><i class="fa fa-user fa-5x"></i></span>
            @endif
          </div> @endslot
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
      <div class="row">
        <div class="col-lg-8">
          @foreach ( $reviews as $review )
          <p class="h4">

            Review for <a class="text-primary" href="/brand/{{$review->company->slug}}">{{$review->company->name}}</a>
          </p>
          <x-company-detail.card-review>

            <x-company-detail.user-review>

              @slot('user_avatar')
              @if ($user->avatar)
              <img class="rounded rounded-circle img-fluid" src="{{ asset("/storage/user/tmb128-{$user->avatar}") }}" alt="" style="width: 50px;heigh:auto">
              @else
              <span class="b-avatar badge-secondary rounded rounded-circle" style="width:50px;height:50px"><i class="fa fa-user fa-2x "></i></span>
              @endif
              @endslot
              @slot('user_name')
              {{$user->name}}
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
              @if ($review->company->avatar)
              <img class="rounded rounded-circle img-fluid" src="{{ asset("/storage/company/tmb128-{$review->company->avatar}") }}" alt="" style="width: 50px;heigh:auto">
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
          @endforeach
          @if ($reviews->lastPage() >1)

          <nav aria-label="">
            <ul class="pagination text-center justify-content-center">
          {{ $reviews->links() }}

            </ul>
          </nav>
          @endif
        </div>
      </div>
    </div>
  </section>
</x-base>
@endsection
