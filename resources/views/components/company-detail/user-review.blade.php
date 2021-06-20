<div class="row ">
      {{$review_visitor ?? ''}}
  <div class="col-md-2 mb-3 mb-md-0 text-md-center">
    <div class="float-md-none float-left mr-3 mr-md-0">
      {{$user_avatar}}
      {{-- <img class="rounded rounded-circle img-fluid" src="{{ asset("images/websites/{$user_avatar}") }}" alt="" style="width: 50px;heigh:auto"> --}}
    </div>
    <div class="mt-2 mt-md-0">
      {{$user_name}}
    </div>
  </div>
  <div class="col-md-10">
    <div class=" d-block d-sm-flex justify-content-between mb-3">
      <div class="d-flex">
        {{$rating}}
      </div>
      <div class="text-muted">
        <em>{{$posted_date}}</em>
      </div>
    </div>
    <div>
      <h4>
        <strong>
          {{$review_title}}
        </strong>
      </h4>
    </div>
    <p>
      {{$review_content}}

    </p>
    <div>
        {{$user_action}}
    </div>
      {{$slot}}
  </div>
</div>
