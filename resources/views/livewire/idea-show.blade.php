<div class="idea-and-buttons container">
    
    <div class="idea-container bg-white dark:bg-slate-700 dark:text-white rounded-xl flex mt-4">

        <div class="flex w-full flex-col md:flex-row flex-1 px-4 py-6">
            <div class="flex-none mx-2 md:mx-4">
                <a href="#">
                    <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="w-full md:mx-4 mx-2">
                <h4 class="text-xl font-semibold"><a href="#" class="hover:underline">{{ $idea->title }}</a>
                </h4>
                <div class="md:w-full hidden md:block font-bold text-gray-900 dark:text-white mt-2">
                    {{ $idea->user->name }}</div>
                <div class="text-gray-600 dark:text-white mt-3 line-clamp-3">
                    @admin
                        @if ($idea->spam_reports > 0)
                            <div class="text-red mb-2">{{ __('global.Spam Reports:') }} {{ $idea->spam_reports }}</div>
                        @endif
                    @endadmin
                    {!! nl2br(e($idea->description)) !!}
                </div>
                <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 dark:text-gray-200 font-semibold space-x-2">
                        <div>{{ $idea->created_at->diffForHumans() }}</div>
                        <div>&middot;</div>
                        <div>
                            @if (App::isLocale('en'))
                                {{ $idea->category->name }}
                            @elseif (App::isLocale('fr'))
                                {{ $idea->category->name_fr }}
                            @endif
                        </div>
                        <div>&middot;</div>
                        <div class="text-gray-900 dark:text-white">{{ $idea->comments->count() }} {{ __('global.comment') }}@if($idea->comments->count() > 1)s @endif</div>
                    </div>
                    <div x-data="{ isOpen: false }" class="flex items-center space-x-2 mt-4 md:mt-0">
                        <div
                            class="{{ 'status-'.Str::kebab($idea->status->name) }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                            @if (App::isLocale('en'))
                            {{ $idea->status->name }}
                            @elseif (App::isLocale('fr'))
                            {{ $idea->status->name_fr }}
                            @endif
                        </div>
                        @auth
                            <div class="relative">
                                <button @click="isOpen = !isOpen"
                                    class="relative bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 border dark:border-gray-500 rounded-full h-7 transition duration-150 ease-in pt-0 pb-3 px-3 text-gray-400">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                    </svg>
                                </button>
                                <ul x-cloak x-show="isOpen" x-transition.origin.top.left.duration.100ms
                                    @click.away="isOpen= false" @keydown.escape.window="isOpen = false"
                                    class="absolute z-10 w-44 text-left font-semibold bg-white dark:bg-slate-700 dark:text-white shadow-dialog rounded-xl py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0">
                                    @can('update', $idea)
                                        <li>
                                            <a @click.prevent="$dispatch('custom-show-edit-modal')
                                                isOpen= false
                                            "
                                                href="#"
                                                class="text-gray-600 dark:text-white block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">
                                                {{ __('global.Edit Idea') }}
                                            </a>
                                        </li>
                                    @endcan

                                    @can('delete', $idea)
                                        <li>
                                            <a @click.prevent="$dispatch('custom-show-delete-modal')
                                                        isOpen= false
                                                    "
                                                href="#"
                                                class="dark:text-white  block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">
                                                {{ __('global.Delete Idea') }}
                                            </a>
                                        </li>
                                    @endcan
                                    <li>
                                        <a
                                            href="#"
                                            @click.prevent="
                                                isOpen = false
                                                $dispatch('custom-show-mark-idea-as-spam-modal')
                                            "
                                            class="dark:text-white hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                        >
                                        {{ __('global.Mark as Spam') }}
                                        </a>
                                    </li>

                                    @admin
                                        @if ($idea->spam_reports > 0)
                                        <li>
                                            <a
                                                href="#"
                                                @click.prevent="
                                                    isOpen = false
                                                    $dispatch('custom-show-mark-idea-as-not-spam-modal')
                                                "
                                                class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                            >
                                            {{ __('global.Not Spam') }}
                                            </a>
                                        </li>
                                        @endif
                                    @endadmin
                                </ul>
                            </div>
                        @endauth

                    </div>
                    <div class="md:hidden flex items-center mt-4 md:mt-0">
                        <div class="bg-gray-100 dark:bg-slate-600 dark:text-white text-center rounded-xl h-10 px-4 py-2 pr-8">
                            <div
                                class="vote-mobile text-sm font-bold leading-none @if ($hasVoted) text-blue @endif">
                                {{ $votesCount }}</div>
                            <div class="text-xxs font-semibold leading-none text-gray-400">{{ __('global.vote') }}@if($votesCount > 1)s @endif</div>
                        </div>
                        @if ($hasVoted)
                            <button wire:click.prevent="vote"
                                class="w-20 bg-blue text-white font-bold hover:bg-blue-hover text-xxs uppercase rounded-xl px-4 py-3 transition duration-150 ease-in -mx-5">
                                {{ __('global.Voted') }}
                            </button>
                        @else
                            <button wire:click.prevent="vote"
                                class="w-20 bg-gray-200 font-bold hover:bg-gray-400 text-xxs uppercase rounded-xl px-4 py-3 transition duration-150 ease-in -mx-5">
                                {{ __('global.I vote') }}
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div><!-- end idea container -->

    <div class="button-container flex items-center justify-between mt-6">
        <div class="flex flex-col md:flex-row items-center md:space-x-4 md:ml-6">
            <livewire:add-comment :idea="$idea" />
            @admin
                <livewire:set-status :idea="$idea" />
            @endadmin
        </div>
        <div class="hidden md:flex items-center space-x-3">
            <div class="bg-white dark:bg-slate-600 dark:text-white font-semibold text-center rounded-xl px-3 py-2">
                <div class="vote-desktop text-xl leading-snug @if ($hasVoted) text-blue @endif">
                    {{ $votesCount }}</div>
                    <div class="text-gray-500 dark:text-gray-300">{{ __('global.vote') }}@if($votesCount > 1)s @endif</div>
            </div>
            @if ($hasVoted)
                <button wire:click.prevent="vote" type="button"
                    class="w-32 h-11 text-xs 
                            bg-blue text-white font-bold uppercase rounded-xl border-none
                            hover:border-blue-hover
                            transition duration-150 easi-in
                            px-6 py-3 ml-6">
                    <span>{{ __('global.Voted') }}</span>
                </button>
            @else
                <button wire:click.prevent="vote" type="button"
                    class="w-32 h-11 text-xs 
                                bg-gray-200 font-bold uppercase rounded-xl border border-gray-200 
                                hover:border-gray-400
                                transition duration-150 easi-in
                                px-6 py-3 ml-6">
                    <span>{{ __('global.I vote') }}</span>
                </button>
            @endif


        </div>

    </div>
    <!--End Button container -->
</div>
