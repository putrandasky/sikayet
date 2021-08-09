@component('mail::message')
<h1>@lang('email/common.hello'), {{$data->company->name}}</h1>
@lang('email/new_review.greetings')

@component('mail::panel')
<blockquote>
<h3>{{$data->review_type->name}}</h3>

<strong>{{$data->title}}</strong>
<p>{{$data->description}}</p>

<em>- {{$data->user->name}}</em>
</blockquote>
@endcomponent

@lang('email/common.thanks_for_using')
<br>
<br>
@lang('email/common.best_regards')
<br>
{{ config('app.name') }}

@slot('subcopy')

<a href="{{ config('app.url') }}/term-of-use">@lang('email/common.term_conditions')</a> <a href="{{ config('app.url') }}/privacy-policy">@lang('email/common.privacy')</a> <a href="{{ config('app.url') }}/contact">@lang('email/common.contact_us')</a>
@endslot
@endcomponent
