@component('mail::message')
# {{ __('global.A comment was posted on your idea')}}

{{ $comment->user->name }} {{ __('global.commented on your idea:')}}

**{{ $comment->idea->title }}**

Comment: {{ $comment->body }}

@component('mail::button', ['url' => route('idea.show', $comment->idea)])
{{ __('global.Go to Idea')}}
@endcomponent

{{ __('Thanks,') }}<br>
{{ config('app.name') }}
@endcomponent
