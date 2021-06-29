@component('mail::message')
<h1>Hello, {{$data->company->name}}</h1>
New review has been sent to your company.

@component('mail::panel')
<blockquote>
<h3>{{$data->review_type->name}}</h3>

<strong>{{$data->title}}</strong>
<p>{{$data->description}}</p>

<em>- {{$data->user->name}}</em>
</blockquote>
@endcomponent

Thank you for using our application.
<br>
<br>
Best Regards
<br>
{{ config('app.name') }}

@slot('subcopy')

<a href="{{ config('app.url') }}/term-of-use">Term Condition</a> <a href="{{ config('app.url') }}/privacy-policy">Privacy Policy</a> <a href="{{ config('app.url') }}/contact">Contact Us</a>
@endslot
@endcomponent
