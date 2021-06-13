  <nav id="main-navbar" class="navbar navbar-expand-sm navbar--ontop fixed-top bg-white px-md-5 shadow-sm">
    <div class="navbar-nav d-flex d-sm-none mr-auto">
      <b-btn variant="outline-secondary">
        <i class="fa fa-list"></i>
      </b-btn>
    </div>
    <a class="navbar-brand d-none d-sm-flex" href="{{url("")}}">
      APP LOGO
      {{-- <img src="{{ asset('images/icon_signfinger.svg') }}" alt="">
      <img src="{{ asset('images/signfinger.svg') }}" alt=""> --}}
    </a>
    <a class="navbar-brand center-h d-flex d-sm-none" href="{{url("")}}">
      APP LOGO
      {{-- <img src="{{ asset('images/icon_signfinger.svg') }}" alt="">
      <img src="{{ asset('images/signfinger.svg') }}" alt=""> --}}
    </a>
    <ul class="navbar-nav ml-auto d-sm-flex d-none ">
      <li class="nav-item active">
        <a class="nav-link" href="/about">About</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/contact">Contact</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/faq">FAQ</span></a>
      </li>
    </ul>
    <div class="navbar justify-content-end d-none d-sm-flex">

      @if (!auth('company')->check() )

      <a class="mr-2 btn btn-primary btn-sm" href="/write-review">Write a Review</a>

      @endif
      @if (!auth('company')->check() && !auth('web')->check())

      <a class="mr-2 btn btn-dark btn-sm " href="/company-login">For Companies</a>
      <a class="btn btn-outline-secondary btn-sm" href="/user-login"><i class="fa fa-sign-in"></i></a>
      @endif
      @if (auth('web')->check())

      <a class="btn btn-outline-secondary btn-sm" href="/user-dashboard"><i class="fa fa-user"></i></a>
      @endif
      @if (auth('company')->check())

      <a class="btn btn-outline-secondary btn-sm" href="/company-dashboard"><i class="fa fa-briefcase"></i></a>
      @endif

      {{-- <ul class="nav justify-content-end d-flex d-md-none">
        <button type="button" class="btn btn-primary btn-sm" v-b-toggle.sidebar-1>
          Write a Review
        </button>
        <button type="button" class="btn btn-dark btn-sm">
          For Companies
        </button> --}}
      </ul>
    </div>
  </nav>
  {{-- <div id="sidebar">

    <sidebar-menu/>
  </div> --}}
  {{$slot}}
  <footer class="shadow bg-white w-100">
    <div class="container pt-5 ">
      <div class="row">
        <x-footer>
          @slot('title')
          Quick Links
          @endslot
          <li>
            <a class=" p-0 text-dark" href="/about">About</a>
          </li>
          <li>
            <a class=" p-0 text-dark" href="/faq">FAQ</a>
          </li>
          <li>
            <a class=" p-0 text-dark" href="/agreement">Agreement</a>
          </li>
          <li>
            <a class=" p-0 text-dark" href="/term-of-use">Term of Use</a>
          </li>
          <li>
            <a class=" p-0 text-dark" href="/privacy-policy">Privacy Policy</a>
          </li>

        </x-footer>
        <x-footer>
          @slot('title')
          Business
          @endslot
          <li>
            <a class=" p-0 text-dark" href="">Business</a>
          </li>
          <li>
            <a class=" p-0 text-dark" href="/company-register">Business Register</a>
          </li>
          <li>
            <a class=" p-0 text-dark" href="/company-login">Business Login</a>
          </li>
          <li>
            <a class=" p-0 text-dark" href="">FAQ Business</a>
          </li>

        </x-footer>
        <x-footer>
          @slot('title')
          Blog
          @endslot

        </x-footer>
        <x-footer>
          @slot('title')
          Other Country
          @endslot
          <x-footer-items>
            France
          </x-footer-items>
          <x-footer-items>
            Germany
          </x-footer-items>
          <x-footer-items>
            italy
          </x-footer-items>
          <x-footer-items>
            Denmark
          </x-footer-items>
        </x-footer>
      </div>
      <div class="w-100 border-top py-3">
        © 2021 My domain, Inc. All rights reserved.
      </div>
    </div>
  </footer>
