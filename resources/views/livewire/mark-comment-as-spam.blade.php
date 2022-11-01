<x-modal-confirm
    livewire-event-to-open-modal="MarkAsSpamCommentWasSet"
    event-to-close-modal="commentWasMarkedAsSpam"
    modal-title="{{ __('global.Mark Comment as Spam') }}"
    modal-description="{{ __('global.Are you sure you want to mark this comment as spam?') }}"
    modal-confirm-button-text="{{ __('global.Mark as Spam') }}"
    wire-click="markCommentAsSpam"
/>