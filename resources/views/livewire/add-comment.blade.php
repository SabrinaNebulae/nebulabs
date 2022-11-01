<div 
    x-data="{ isOpen: false }" 
    class="relative"
    x-init="Livewire.on('commentWasAdded', () => {
        isOpen = false
    })

        Livewire.hook('message.processed', (message, component) => {
            {{-- Pagination --}}
            if (['goToPage','nextPage','previousPage'].includes(message.updateQueue[0].method)) {
                const firstComment = document.querySelector('.comment-container:first-child')
                firstComment.scrollIntoView({ behavior: 'smooth'})
            }
            {{-- Adding Comment --}}
            if ((message.updateQueue[0].payload.event === 'commentWasAdded' || message.updateQueue[0].payload.event === 'statusWasUpdated')
            && message.component.fingerprint.name === 'idea-comments') {
                const lastComment = document.querySelector('.comment-container:last-child')
                lastComment.scrollIntoView({ behavior: 'smooth'})
                lastComment.classList.add('bg-green-50')
                setTimeout(() => {
                    lastComment.classList.remove('bg-green-50')
                }, 2000)
            }
        })
        @if (session('scrollToComment'))
            const commentToScrollTo = document.querySelector('#comment-{{ session('scrollToComment') }}')
            commentToScrollTo.scrollIntoView({ behavior: 'smooth'})
            commentToScrollTo.classList.add('bg-green-50')
            setTimeout(() => {
                commentToScrollTo.classList.remove('bg-green-50')
            }, 5000)
        @endif  
    "
>
    <button 
        @click="isOpen = !isOpen
            if (isOpen) {
                $nextTick(() => $refs.comment.focus())
            }
        " 
        type="button"
        class="flex text-white items-center w-36 justify-center h-11 text-sm 
                bg-blue font-semibold rounded-xl 
                hover:bg-blue-hover
                transition duration-150 easi-in
                px-6 py-3">
        {{ __('global.Reply') }}
    </button>
    <div x-cloak x-show="isOpen" x-transition.origin.top.left.duration.20ms @click.away="isOpen= false"
        @keydown.escape.window="isOpen = false"
        class="absolute z-10 w-64 md:w-104 text-left font-semibold bg-white dark:bg-slate-700 dark:text-white shadow-dialog rounded-xl mt-2">
        @auth
            <form wire:submit.prevent="addComment" action="#" class="space-y-4 px-4 py-5" method="POST">
                <div>
                    <textarea x-ref="comment" wire:model="comment" name="post_comment" id="post_comment" cols="30" rows="4"
                        class="w-full text-sm text-gray-900 dark:text-zinc-800 bg-gray-100 rounded-xl placeholder-gray-900 dark:placeholder-gray-900 border-none px-4 py-2"
                        placeholder="{{ __('global.Go ahead, don\'t be shy. Share your thoughts ...') }}" required></textarea>

                    @error('comment')
                        <p class="text-red text xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col md:flex-row items-center md:space-x-3">
                    <button type="submit"
                        class="flex text-white  items-center w-full md:w-36 justify-center h-11 text-sm 
                    bg-blue font-semibold rounded-xl 
                    hover:bg-blue-hover
                    transition duration-150 easi-in
                    px-6 py-3">
                    {{ __('global.Post comment') }}
                    </button>
                    {{-- <button type="button"
                        class="flex items-center justify-center w-full md:w-36 h-11 text-xs 
                    bg-gray-200 font-semibold rounded-xl border border-gray-200 
                    hover:border-gray-400
                    transition duration-150 easi-in
                    px-6 py-3 mt-5 md:mt-0 ml-0">
                        <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                        <span class="ml-1">{{ __('global.Attach') }}</span>
                    </button> --}}
                </div>
            </form>
        @else
            <div class="px-4 py-6">
                <p class="font-normal">{{ __("Please login or create an account to post a comment.") }}</p>
                <div class="flex items-center text-center space-x-3 mt-8">
                    <a 
                        wire:click.prevent="redirectToLogin"
                        href="{{ route('login') }}"
                        class="inline-block text-white items-center justify-center w-1/2 h-11 text-xs 
                                    bg-blue font-semibold rounded-xl 
                                    hover:bg-blue-hover
                                    transition duration-150 easi-in
                                    px-3 py-3 my-2">
                        <span class="ml-1">{{ __("Login") }}</span>
                    </a>
                    <a 
                        wire:click.prevent="redirectToRegister"
                        href="{{ route('register') }}"
                        class="inline-block items-center justify-center w-1/2 h-11 text-xs 
                                    bg-gray-200 font-semibold rounded-xl 
                                    hover:bg-gray-400
                                    dark:text-gray-700
                                    transition duration-150 easi-in
                                    px-3 py-3 my-2">
                        <span class="ml-1">{{ __("Sign up") }}</span>
                    </a>
                </div>
            </div>
        @endauth
    </div>
</div>
