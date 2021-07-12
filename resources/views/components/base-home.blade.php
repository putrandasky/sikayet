<navbar class="" :isuser="@json(auth('web')->check()) " :iscompany="@json(auth('company')->check())"></navbar>
<div >

  {{$slot}}
</div>
<footer class="shadow bg-white">
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
          <a class=" p-0 text-dark" href="/about">Business</a>
        </li>
        <li>
          <a class=" p-0 text-dark" href="/company-register">Business Register</a>
        </li>
        <li>
          <a class=" p-0 text-dark" href="/company-login">Business Login</a>
        </li>
        <li>
          <a class=" p-0 text-dark" href="/faq">FAQ Business</a>
        </li>

      </x-footer>
      <x-footer>
        @slot('title')
        Social Media
        @endslot
         <li>
           <a class=" p-0 text-dark" href="/social-facebook" target="_blank">Facebook</a>
         </li>
         <li>
           <a class=" p-0 text-dark" href="/social-instagram" target="_blank">Instagram</a>
         </li>
         <li>
           <a class=" p-0 text-dark" href="/social-twitter" target="_blank">Twitter</a>
         </li>
         <li>
           <a class=" p-0 text-dark" href="/social-linkedin" target="_blank">Linkedin</a>
         </li>
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
    <div class="border-top text-center py-3">
      © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
    </div>
  </div>
</footer>
