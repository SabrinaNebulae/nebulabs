<div 
    x-cloak
    x-data="{ isOpen: false }"
    x-show="isOpen"
    @keydown.escape.window="isOpen = false"
    @custom-show-edit-modal.window="
        isOpen = true
        $nextTick(() => $refs.title.focus())
    " 
    x-init="window.livewire.on('ideaWasUpdated', () => {
        isOpen = false
    })"
    class="relative z-10" 
    aria-labelledby="modal-title" 
    role="dialog" 
    aria-modal="true"
>
    <div 
        x-show="isOpen"
        x-transition.opacity
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
    >
    </div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                x-show ="isOpen"
                x-transition.origin.bottom.duration.300ms
                class="modal relative transform overflow-hidden rounded-xl bg-white transition-all py-4 sm:max-w-lg sm:w-full"
            >
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button 
                        @click="isOpen = false"
                        class="text-gray-400 hover:text-gray-500"
                    >
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>

                    </button>
                </div>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mt-3 text-center">
                        <h3 class="text-center text-lg font-medium leading-6 text-gray-900" id="modal-title">
                            {{ __('global.Edit Idea') }}
                        </h3>
                        <p class="text-sm text-center text-gray-500 mt-4 leading-5 px-6">{{ __('global.You have one hour to edit your idea from the
                            time you created it.') }}</p>
                        <div class="mt-2">
                            <form wire:submit.prevent="updateIdea" action="#" method="POST"
                                class="space-y-4 px-4 py-6">
                                <div>
                                    <input wire:model.defer="title" x-ref="title" type="text"
                                        class="w-full text-sm bg-gray-100 border-none rounded-xl placeholder-gray-900 px-4 py-2"
                                        placeholder="{{ __('global.Your Idea') }}" required>
                                    @error('title')
                                        <p class="text-red text xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <select wire:model.defer="category" name="category_add" id="category_add"
                                        class="bg-gray-100 text-sm w-full rounded-xl border-none px-4 py-2">
                                        @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category')
                                    <p class="text-red text xs mt-1">{{ $message }}</p>
                                @enderror
                                <div>
                                    <textarea wire:model.defer="description" name="idea" id="idea" cols="30" rows="4"
                                        class="w-full bg-gray-100 text-sm border-none rounded-xl placeholder-gray-900 px-4 py-2"
                                        placeholder="Describe your idea" required></textarea>
                                    @error('description')
                                        <p class="text-red text xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex items-center justify-between space-x-3">
                                    <button type="button"
                                        class="flex items-center justify-center w-1/2 h-11 text-xs 
                                bg-gray-200 font-semibold rounded-xl border border-gray-200 
                                hover:border-gray-400
                                transition duration-150 easi-in
                                px-6 py-3">
                                        <svg class="text-gray-600 w-4 transform -rotate-45" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                        </svg>
                                        <span class="ml-1">{{ __('global.Attach') }}</span>
                                    </button>

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
