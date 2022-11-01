<x-modal-confirm
    livewire-event-to-open-modal="MarkAsNotSpamCommentWasSet"
    event-to-close-modal="commentWasMarkedAsNotSpam"
    modal-title="{{ __('global.Reset Spam Counter') }}"
    modal-description="{{ __('global.Are you sure you want to mark this comment as NOT spam? This will reset the spam counter to 0.') }}"
    modal-confirm-button-text="{{ __('global.Reset Spam Counter') }}"
    wire-click="markCommentAsNotSpam"
/>