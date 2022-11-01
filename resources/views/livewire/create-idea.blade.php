<div>
    @auth
        <form wire:submit.prevent="createIdea" action="#" method="POST" class="space-y-4 px-4 py-6">
            <div>
                <input wire:model.defer="title" type="text" class="w-full text-sm bg-gray-100 dark:text-zinc-800 border-none rounded-xl placeholder-gray-900 px-4 py-2"
                    placeholder="{{ __('global.Your Idea') }}" required>
                    @error('title')
                        <p class="text-red text xs mt-1">{{ $message }}</p>
                    @enderror    
            </div>
            <div>
                <select wire:model.defer="category" name="category_add" id="category_add" class="bg-gray-100 text-sm text-gray-900 w-full rounded-xl border-none px-4 py-2">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        @if (App::isLocale('en'))
                            {{ $category->name }}
                        @elseif (App::isLocale('fr'))
                            {{ $category->name_fr }}
                        @endif 
                    </option>
                    @endforeach
                </select>
            </div>
                    @error('category')
                        <p class="text-red text xs mt-1">{{ $message }}</p>
                    @enderror   
            <div>
                <textarea wire:model.defer="description" name="idea" id="idea" cols="30" rows="4"
                    class="w-full bg-gray-100 text-sm dark:text-zinc-800 border-none rounded-xl placeholder-gray-900 px-4 py-2"
                    placeholder="{{ __('global.Describe your idea') }}" required></textarea>
                    @error('description')
                        <p class="text-red text xs mt-1">{{ $message }}</p>
                    @enderror   
            </div>
            <div class="flex items-center justify-center text-center">
                {{-- <button type="button"
                    class="flex items-center justify-center w-1/2 h-11 text-xs 
                    bg-gray-200 font-semibold rounded-xl border border-gray-200 
                    hover:border-gray-400
                    transition duration-150 easi-in
                    px-6 py-3">
                    <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                    <span class="ml-1">{{ __('global.Attach') }}</span>
                </button> --}}

                <button type="submit"
                    class="flex text-white items-center justify-center w-1/2 h-11 text-xs 
                    bg-blue font-semibold rounded-xl 
                    hover:bg-blue-hover
                    transition duration-150 easi-in
                    px-6 py-3">
                    <span class="ml-1">{{ __('global.Submit') }}</span>
                </button>
            </div>
        </form>
    @else
        <div class="my-3 text-center">
            <a
                wire:click.prevent="redirectToLogin"
                href="{{ route('login') }}"
                class="inline-block text-white items-center justify-center w-1/2 h-11 text-xs 
                    bg-blue font-semibold rounded-xl 
                    hover:bg-blue-hover
                    transition duration-150 easi-in
                    px-6 py-3 my-2">
                <span class="ml-1">{{ __('global.Login') }}</span>
            </a>
            <a
                wire:click.prevent="redirectToRegister"
                href="{{ route('register') }}"
                class="inline-block items-center justify-center w-1/2 h-11 text-xs 
                    bg-gray-200 font-semibold rounded-xl 
                    hover:bg-gray-400
                    dark:text-gray-700
                    transition duration-150 easi-in
                    px-6 py-3 my-2">
                <span class="ml-1">{{ __('global.Sign up') }}</span>
            </a>
        </div>
    @endauth   
</div>
