<div class="row pt-5">
  <div class="col-md-2 d-md-block d-none">
    <div>
      <img class="rounded rounded-circle img-fluid" src="{{ asset("images/websites/{$company_avatar}") }}" alt="" style="width: 50px;heigh:auto">
    </div>
  </div>
  <div class="col-md-10">
    <div class=" border-left pl-3">
      <div class=" d-block d-sm-flex  justify-content-between mb-3">
          <h5>

            <strong>
              Reply from {{$company_name}}
            </strong>
          </h5>
        <div class="text-muted">
          <em>{{$posted_date}}</em>
        </div>
      </div>

      <p>
        {{$reply_content}}
      </p>
    </div>

  </div>
</div>
