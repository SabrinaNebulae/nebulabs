<div
x-data
@click="const clicked =$event.target
        const target = clicked.tagName.toLowerCase()
        const ignores = ['button', 'svg', 'path', 'a']
        if(!ignores.includes(target)){
        $event.target.closest('.idea-container').querySelector('.idea-link').click()
        }"

class="idea-container hover:shadow-card bg-white dark:bg-slate-700 dark:text-white rounded-xl flex transition duration-150 ease-in cursor-pointer">
<div class="hidden md:block border-r border-gray-100 dark:border-slate-500 px-5 py-8">
    <div class="text-center">
        <div class="font-semibold text-2xl @if ($hasVoted) text-blue @endif">{{ $votesCount }}</div>
        <div class="text-gray-500">{{ __('global.vote') }}@if($votesCount > 1)s @endif</div>
    </div>
    <div class="mt-8">
        @if($hasVoted)
        <button
            wire:click.prevent="vote"
            class="w-20 bg-blue text-white font-bold hover:bg-blue-hover text-xxs uppercase rounded-xl px-4 py-3 transition duration-150 ease-in">
            {{ __('global.Voted') }}</button>
        @else
        <button
            wire:click.prevent="vote"
            class="w-20 bg-gray-200 font-bold dark:text-gray-800 border border-gray-200 hover:border-gray-400 text-xxs uppercase rounded-xl px-4 py-3 transition duration-150 ease-in">
            {{ __('global.I vote') }}</button>
        @endif
        
    </div>
</div>
<div class="w-full flex-1 flex flex-col md:flex-row px-2 py-6">
    <div class="flex-none md:mx-4 mx-2">
        <a href="#">
            <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
        </a>
    </div>
    <div class="w-full flex flex-col justify-between md:mx-4 mx-2">
        <h4 class="text-xl font-semibold mt-2 md:mt-0"><a href="{{ route('idea.show', $idea) }}" class="idea-link hover:underline">{{ $idea->title }}</a></h4>
        <div class="text-gray-600 dark:text-white mt-3 line-clamp-3">
            @admin
                @if ($idea->spam_reports > 0)
                    <div class="text-red mb-2">{{ __('global.Spam Reports:') }} {{ $idea->spam_reports }}</div>
                @endif
            @endadmin
           {{ $idea->description }}
        </div>
        <div class="flex flex-col md:flex-row  md:items-center justify-between mt-6">
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
                <div class="text-gray-900 dark:text-white ">{{ $idea->comments_count }} {{ __('global.comment') }}@if($idea->comments_count > 1)s @endif</div>
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
            </div>
            <div class="md:hidden flex items-center mt-4 md:mt-0">
                <div class="bg-gray-100 text-center dark:bg-slate-600 dark:text-white rounded-xl h-10 px-4 pt-2 pr-8">
                    <div class="text-sm font-bold leading-none @if ($hasVoted) text-blue @endif">{{ $votesCount }}</div>
                    <div class="text-gray-500 dark:text-white">{{ __('global.vote') }}@if($votesCount > 1)s @endif</div>
                </div>
                @if($hasVoted)
                <button
                    wire:click.prevent="vote"
                    class="w-20 bg-blue text-white font-bold hover:bg-blue-hover text-xxs uppercase rounded-xl px-4 py-3 transition duration-150 ease-in -mx-5">
                    {{ __('global.Voted') }}</button>
                @else
                <button
                    wire:click.prevent="vote"
                    class="w-20 bg-gray-200 dark:text-gray-800 font-bold hover:bg-gray-400 text-xxs uppercase rounded-xl px-4 py-3 transition duration-150 ease-in -mx-5">
                    {{ __('global.I vote') }}</button>
                @endif
            </div>
        </div>
    </div>
</div>
</div><!-- end idea container -->