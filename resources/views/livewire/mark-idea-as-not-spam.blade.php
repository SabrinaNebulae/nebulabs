<x-modal-confirm
  event-to-open-modal="custom-show-mark-idea-as-not-spam-modal"
  event-to-close-modal="ideaWasMarkedAsNotSpam"
  modal-title="{{ __('global.Reset Spam Counter') }}"
  modal-description="{{ __('global.Are you sure you want to mark this idea as NOT spam? This will reset the spam counter to 0.') }}"
  modal-confirm-button-text="{{ __('global.Reset Spam Counter') }}"
  wire-click="markAsNotSpam"
/>
