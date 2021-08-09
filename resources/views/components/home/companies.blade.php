<div class="card shadow mb-3">
  <div class="card-body">
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-3  justify-content-center d-flex align-items-center">
            <div class="border border-light p-2">
              {{$avatar}}
              {{-- <img class=" " src="{{ asset('images/websites/company1.png') }}" alt=""> --}}
            </div>
          </div>
          <div class="col-md-9">
            <h4><strong>
                {{$name}}
              </strong>
            </h4>
            <p>
              {{$profile}}
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-3  text-secondary  ">
        <div class="text-center">
          <small>
            @lang('website/home.top_companies.based_on') {{$review}} @lang('website/home.top_companies.reviews')
          </small>
        </div>
        <div class="d-flex justify-content-center mb-1">
          {{$rating}}
        </div>

        <div class="text-center text-secondary mb-2">
          {{$total_rating}}
        </div>
        <div class="text-center">
          <a class="btn btn-primary btn-sm" href="/brand/{{$slug}}">@lang('website/home.top_companies.read_more')</a>
        </div>
      </div>
    </div>
  </div>
</div>
