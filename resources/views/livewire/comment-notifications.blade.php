<div 
    wire:poll="getNotificationCount" 
    x-data="{ isOpen: false }"
    class="relative mt-2 mr-2 sm:flex sm:items-center sm:mr-4" 
>
    <button @click=
        "isOpen = !isOpen
        if (isOpen) {
            Livewire.emit('getNotifications')
        }
    ">
        <div>
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 dark:text-white text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            
            @if ($notificationCount)
                <div class="absolute rounded-full bg-red text-white text-xxs w-8 h-8 flex justify-center items-center -top-2 -right-2.5 px-2.5 py-2.5 text-xxs h-4 w-4">
                    {{ $notificationCount }}
                </div>
            @endif
        </div>
    </button>
    <ul
        class="absolute w-76 md:w-96 text-left text-gray-700 text-sm bg-white dark:bg-slate-700 dark:text-white shadow-dialog rounded-xl sm:max-h-70 max-h-128 overflow-y-auto z-10 md:-right-28 md:-right-12 top-8 -right-12"
        {{-- style="right: -46px" --}}
        x-cloak
        x-show.transition.origin.top="isOpen"
        @click.away="isOpen = false"
        @keydown.escape.window="isOpen = false"
    >
        @if ($notifications->isNotEmpty() && !$isLoading )
        
            @foreach ($notifications as $notification)
                @if ($notification->type === 'App\Notifications\CommentAdded')
                    <li>
                        <a
                            href="{{ route('idea.show', $notification->data['idea_slug']) }}"
                            @click.prevent="
                                isOpen = false
                            "
                            wire:click.prevent="markAsRead('{{ $notification->id }}')"
                            class="flex hover:bg-gray-100 dark:hover:bg-slate-600 transition duration-150 ease-in px-5 py-3"
                        >
                            <img src="{{ $notification->data['user_avatar'] }}" class="rounded-xl w-10 h-10" alt="avatar">
                            <div class="ml-4">
                                <div class="line-clamp-6">
                                    <span class="font-semibold">{{ $notification->data['user_name'] }}</span> {{ __('global.commented on')}}
                                    <span class="font-semibold">{{ $notification->data['idea_title'] }}</span>:
                                    <span>"{{ $notification->data['comment_body'] }}"</span>
                                </div>
                                <div class="text-xs text-gray-500 mt-2">{{ $notification->created_at->diffForHumans() }}</div>
                            </div>
                        </a>
                    </li>
                @elseif ($notification->type === 'App\Notifications\IdeaStatusUpdated')
                    <li>
                        <a
                            href="{{ route('idea.show', $notification->data['idea_slug']) }}"
                            @click.prevent="
                                isOpen = false
                            "
                            wire:click.prevent="markAsRead('{{ $notification->id }}')"
                            class="flex hover:bg-gray-100 transition duration-150 ease-in px-5 py-3"
                        >
                            <img src="{{ $notification->data['user_avatar'] }}" class="rounded-xl w-10 h-10" alt="avatar">
                            <div class="ml-4">
                                <div class="line-clamp-6">
                                    <span class="font-semibold">{{ $notification->data['user_name'] }}</span> {{ __('global.changed status for the idea')}} <span class="font-bold">{{ $notification->data['idea_title'] }}</span>
                                     {{__('global.on')}} <span class="font-bold">"
                                        @if (App::isLocale('en'))
                                            {{ $notification->data['idea_status'] }}
                                        @elseif (App::isLocale('fr'))
                                            {{ $notification->data['idea_status_fr'] }}
                                        @endif
                                    "</span>
                                     </span> {{ __('global.with this comment:')}} <span>"{{ $notification->data['comment_body'] }}"</span>
                                </div>
                                <div class="text-xs text-gray-500 mt-2">{{ $notification->created_at->diffForHumans() }}</div>
                            </div>
                        </a>
                    </li>
                @endif
            @endforeach  
        <li class="border-t border-gray-300 text-center">
            <button
                wire:click="markAllAsRead"
                @click="isOpen = false"
                class="w-full block font-semibold hover:bg-gray-100 dark:hover:bg-slate-500 dark:hover:text-slate-700 transition duration-150 ease-in px-5 py-4"
            >
                {{ __('global.Mark all as read') }}
            </button>
        </li>
        @elseif ($isLoading)
        @foreach (range(1,3) as $item)
            <li class="flex items-center transition duration-150 ease-in px-5 py-3 animate-pulse">
                <div class="bg-gray-200 rounded-xl w-10 h-10"></div>
                <div class="flex-1 ml-4 space-y-2">
                    <div class="bg-gray-200 w-full rounded h-2"></div>
                    <div class="bg-gray-200 w-full rounded h-2"></div>
                    <div class="bg-gray-200 w-1/2 rounded h-2"></div>
                </div>
            </li>
        @endforeach
            
        @else
            <li class="text-center font-normal text-sm py-6 px-6">
                {{ __('global.No new notifications.') }}
            </li> 
        @endif  
    </ul>
</div>