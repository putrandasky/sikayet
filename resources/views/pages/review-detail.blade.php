@extends('layouts.website')

@section('meta')
<title>{{$review->company->name}} reviewed by {{$review->user->name}} </title>



@endsection
@section('content')
<x-base>

  <section class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <p class="h4">

            Review for <a class="text-primary" href="/brand/{{$review->company->slug}}">{{$review->company->name}}</a>
          </p>
          <x-company-detail.card-review>

            <x-company-detail.user-review>

              @slot('review_visitor')
              <div class="col-12 mb-3 pb-2 text-right text-secondary border-bottom border-grey">
               {{$review->visited}} visitor
              </div>
              @endslot
              @slot('user_avatar')
              @if ($review->user->avatar)
              <img class="rounded rounded-circle img-fluid" src="{{ asset("/storage/user/tmb128-{$review->user->avatar}") }}" alt="" style="width: 50px;heigh:auto">
              @else
              <span class="b-avatar badge-secondary rounded rounded-circle" style="width:50px;height:50px"><i class="fa fa-user fa-2x "></i></span>
              @endif
              @endslot
              @slot('user_name')

              <a href="/user/{{$review->user->slug}}" class="text-dark">
                {{$review->user->name}}
              </a>
              <div>
                <small class="text-secondary">{{$review->user->review}} <i class="fa fa-pencil"></i> </small>
                <small class="text-secondary">{{$review->user->like}} <i class="fa fa-thumbs-up"></i> </small>
                <small class="text-secondary">{{$review->user->dislike}} <i class="fa fa-thumbs-down"></i></small>

              </div> @endslot
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
                  {{$review->title}}
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

        </div>
      </div>
    </div>
  </section>
</x-base>
@endsection
