<div 
    id="comment-{{ $comment->id }}"
    class="@if ($comment->is_status_update) is-status-update dark:border-none {{ 'status-'.Str::kebab($comment->status->name) }}@endif  comment-container dark:comment-container-dark relative bg-white dark:bg-slate-700 dark:text-white rounded-xl flex transition duration-500 ease-in mt-4"
>

    <div class="flex w-full flex-col md:flex-row px-4 py-6 dark:bg-slate-700 dark:text-white rounded-xl">
        <div class="flex-none">
            <a href="#">
                <img src="{{ $comment->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
            @if ($comment->user->isAdmin())
                <div class="text-center uppercase text-blue text-xxs font-bold mt-1">{{ __('global.Admin') }}</div>
            @endif
        </div>
        <div class="w-full md:mx-4">
            <div class="text-gray-600 dark:text-white">
                @admin
                    @if ($comment->spam_reports > 0)
                        <div class="text-red mb-2">{{ __('global.Spam Reports:') }} {{ $comment->spam_reports }}</div>
                    @endif
                @endadmin
                @if ($comment->is_status_update)
                    <h4 class="text-xl font-semibold mb-3">
                        {{ __('global.Status changed to') }} "{{ $comment->status->name }}"
                    </h4>
                @endif
                <div>
                    {!! nl2br(e($comment->body)) !!}
                </div>
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div class="@if ($comment->is_status_update) text-blue @endif font-bold text-gray-900 dark:text-white">{{ $comment->user->name }}</div>
                    <div>&middot;</div>

                    @if ($comment->user->id === $ideaUserId)
                        <div class="rounded-full border bg-gray-100 px-3 py-1">OP</div>
                        <div>&middot;</div>
                    @endif

                    <div>{{ $comment->created_at->diffForHumans() }}</div>
                </div>

                @auth
                    <div x-data="{ isOpen: false }" class="flex items-center space-x-2 mt-4 md:mt-0">
                        <div class="relative">
                            <button @click="isOpen = !isOpen"
                                class="relative bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 border dark:border-gray-500 rounded-full h-7 transition duration-150 ease-in pt-0 pb-3 px-3 text-gray-400 ">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                            </button>
                            <ul x-cloak x-show="isOpen" x-transition.origin.top.left.duration.100ms
                                @click.away="isOpen= false" @keydown.escape.window="isOpen = false"
                                class="absolute z-10 w-44 text-left font-semibold bg-white dark:bg-slate-700 dark:text-white shadow-dialog rounded-xl py-3 md:ml-8 top-8 md:top-6 left-0">
                                @can('update', $comment)
                                    <li>
                                        <a @click.prevent="isOpen= false
                                                Livewire.emit('setEditComment', {{ $comment->id }})
                                            "
                                            href="#"
                                            class="text-gray-600 dark:text-white block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">
                                            {{ __('global.Edit Comment') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('delete', $comment)
                                    <li>
                                        <a @click.prevent="isOpen= false
                                                Livewire.emit('setDeleteComment', {{ $comment->id }})
                                            "
                                            href="#"
                                            class="text-gray-600 dark:text-white block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">
                                            {{ __('global.Delete Comment') }}
                                        </a>
                                    </li>
                                @endcan

                                <li>
                                    <a @click.prevent="isOpen= false
                                                Livewire.emit('setMarkAsSpamComment', {{ $comment->id }})
                                            "
                                        href="#"
                                        class="text-gray-600 dark:text-white block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">
                                        {{ __('global.Mark as Spam') }}
                                    </a>
                                </li>

                                @admin
                                    @if ($comment->spam_reports > 0)
                                        <li>
                                            <a href="#"
                                                @click.prevent="
                                                    isOpen = false
                                                    Livewire.emit('setMarkAsNotSpamComment', {{ $comment->id }})
                                                "
                                                class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">
                                                {{ __('global.Not Spam') }}
                                            </a>
                                        </li>
                                    @endif
                                @endadmin


                            </ul>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div><!-- end comment container -->
