
<navbar class="w-100" :isuser="@json(auth('web')->check()) " :iscompany="@json(auth('company')->check())"></navbar>
<div class="w-100">

  {{$slot}}
</div>
  <footer class="shadow bg-white w-100 mt-auto">
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
