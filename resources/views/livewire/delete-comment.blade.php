<x-modal-confirm
    livewire-event-to-open-modal="deleteCommentWasSet"
    event-to-close-modal="commentWasDeleted"
    modal-title="{{ __('global.Delete Comment') }}"
    modal-description="{{ __('global.Are you sure you want to delete this comment? This action cannot be undone.') }}"
    modal-confirm-button-text="{{ __('global.Delete') }}"
    wire-click="deleteComment"
/>