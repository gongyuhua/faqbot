@component('mail::message')
# Question answered

Hey! Your question just have a new answer!

@component('mail::button', ['url' => ''])
View your Question #{{ $question->id }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
