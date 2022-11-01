<x-modal-confirm
  event-to-open-modal="custom-show-delete-modal"
  event-to-close-modal="ideaWasDeleted"
  modal-title="{{ __('global.Delete Idea') }}"
  modal-description="{{ __('global.Are you sure you want to delete this idea? This action cannot be undone.') }}"
  modal-confirm-button-text="{{ __('global.Delete') }}"
  wire-click="deleteIdea"
/>