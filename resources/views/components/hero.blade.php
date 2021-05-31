@props(['addClass' => ''])
<div id="intro" >
  <div {{ $attributes->merge(['class' => ' rounded-o background-full jumbotron mb-0 d-flex  justify-content-center align-items-center text-center '. $addClass])}} style="background-image:linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),url({{ asset('images/websites/cover.jpg') }})">
    <div>
      <h1 id="hero-title" class="text-white  font-weight-bold">{{$title}}</h1>
      <p class="text-white mx-md-5 px-md-5">{{$subtitle}}
      </p>
{{$slot}}
    </div>
  </div>
</div>
