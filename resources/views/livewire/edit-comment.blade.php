<div 
    x-cloak 
    x-data="{ isOpen: false }" 
    x-show="isOpen" 
    @keydown.escape.window="isOpen = false" 
    {{-- @custom-show-edit-modal.window="
        isOpen = true
        $nextTick(() => $refs.title.focus()) 
    " --}}
    x-init="Livewire.on('commentWasUpdated', () => {
        isOpen = false
    })
    Livewire.on('editCommentWasSet', () => {
        isOpen = true
        $nextTick(() => $refs.editComment.focus())
    })" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div x-show="isOpen" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity">
    </div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="isOpen" x-transition.origin.bottom.duration.300ms
                class="modal relative transform overflow-hidden rounded-xl bg-white transition-all py-4 sm:max-w-lg sm:w-full">
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button @click="isOpen = false" class="text-gray-400 hover:text-gray-500">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>

                    </button>
                </div>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mt-3 text-center">
                        <h3 class="text-center text-lg font-medium leading-6 text-gray-900" id="modal-title">
                            {{ __('global.Edit Comment') }}
                        </h3>
                        <div class="mt-2">
                            <form wire:submit.prevent="updateComment" action="#" method="POST"
                                class="space-y-4 px-4 py-6">
                                <div>
                                    <textarea x-ref="editComment" wire:model.defer="body" name="idea" id="idea" cols="30" rows="4"
                                        class="w-full bg-gray-100 text-sm border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="{{ __('global.Type your comment here ...') }}" required></textarea>
                                    @error('body')
                                        <p class="text-red text xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-between">
                                    <button type="submit"
                                        class="flex text-white items-center justify-center w-1/2 h-11 text-xs 
                                bg-blue font-semibold rounded-xl 
                                hover:bg-blue-hover
                                transition duration-150 easi-in
                                px-6 py-3">
                                        <span class="ml-1">{{ __('global.Update') }}</span>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
