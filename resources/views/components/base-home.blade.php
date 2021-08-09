<navbar class="" :isuser="@json(auth('web')->check()) " :iscompany="@json(auth('company')->check())"></navbar>
<div >

  {{$slot}}
</div>
<footer class="shadow bg-white">
  <div class="container pt-5 ">
    <div class="row">
      <x-footer>
        @slot('title')
        @lang('website/footer.title.quick_links')
        @endslot
        <x-footer-items-quicklinks></x-footer-items-quicklinks>
      </x-footer>
      <x-footer>
        @slot('title')
        @lang('website/footer.title.business')
        @endslot
        <x-footer-items-business></x-footer-items-business>
      </x-footer>
      <x-footer>
        @slot('title')
        @lang('website/footer.title.social_media')
        @endslot
        <x-footer-items-social></x-footer-items-social>

      </x-footer>
      <x-footer>
        @slot('title')
        @lang('website/footer.title.other_country')
        @endslot
        <x-footer-items-region></x-footer-items-region>

      </x-footer>
    </div>
    <div class="border-top text-center py-3">
<x-footer-trademark></x-footer-trademark>
    </div>
  </div>
</footer>
