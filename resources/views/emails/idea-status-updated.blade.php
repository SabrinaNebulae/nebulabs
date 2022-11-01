@component('mail::message')
# {{ __('global.Your Idea status was updated by an admin')}}

{{ $comment->user->name }} {{ __('global.updated status for your idea:')}}

**{{ $comment->idea->title }}**

{{__('global.Status changed to:')}} 
@if (App::isLocale('en'))
    {{ $comment->idea->status->name }}
@elseif (App::isLocale('fr'))
    {{ $comment->idea->status->name_fr }}
@endif

@component('mail::button', ['url' => route('idea.show', $comment->idea)])
{{ __('global.Go to Idea')}}
@endcomponent

{{ __('global.Thanks,') }}<br>
{{ config('app.name') }}
@endcomponent
