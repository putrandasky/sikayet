@props(['addClass' => ''])
<div id="intro" class="intro-homepage">
  <div {{ $attributes->merge(['class' => 'd-flex justify-content-center align-items-center text-center '. $addClass])}} style="background-image:linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),url({{ asset('images/websites/cover.jpg') }})">
    <div>
      <h1 id="hero-title" class="text-white  font-weight-bold">{{$title}}</h1>
      <p class="text-white mx-md-5 px-md-5">{{$slot}}
      </p>

      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="What are you looking for" aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
              <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
              </div>
            </div>
            <div class="input-group-append">
              <button class="btn btn-primary" type="button" id="button-addon2">Search</button>
            </div>
          </div>>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
