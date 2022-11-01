<div>
    <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6 mt-8">
        <div class="w-full md:w-1/3">
            <select wire:model="category" name="category" id="category" class="bg-white dark:bg-slate-700 text-base dark:text-gray-500 w-full rounded-xl border-none px-4 py-2">
                <option value="All">{{ __('global.All Categories') }}</option>
                @foreach ($categories as $category)
                <option value="{{ $category->name }}">
                    @if (App::isLocale('en'))
                        {{ $category->name }}
                    @elseif (App::isLocale('fr'))
                        {{ $category->name_fr }}
                    @endif
                </option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <select wire:model="filter" name="other_filters" id="other_filters" class="bg-white dark:bg-slate-700 dark:text-gray-500 w-full rounded-xl border-none px-4 py-2">
                <option value="No Filter">{{ __('global.No Filter') }}</option>
                <option value="Top Voted">{{ __('global.Top Voted') }}</option>
                <option value="My Ideas">{{ __('global.My Ideas') }}</option>
                @admin
                    <option value="Spam Ideas">{{ __('global.Spam Ideas') }}</option>
                    <option value="Spam Comments">{{ __('global.Spam Comments') }}</option>
                @endadmin
            </select>
        </div>
        <div class="w-full md:w-1/3 relative">
            <input wire:model="search" type="search" placeholder="{{ __('global.Find an idea') }}"
                class="w-full rounded-xl bg-white dark:bg-slate-700 border-none px-4 py-2 pl-8 placeholder-text-gray-900 dark:placeholder-text-gray-500">

            <div class="absolute top-3 flex h-hull ml-2">
                <svg class="w-4 text-gray-700 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
        </div>
    </div><!-- end filters -->

    <div class="text-gray-500 dark:text-white my-5 mx-auto text-center">
        {{__('global.There\'s actually' )}} {{$ideas->total()}} {{__('global.idea(s) to debate!')}}
    </div>

    <div class="ideas-container space-y-6 my-6">
        @forelse($ideas as $idea)
            <livewire:idea-index 
                :key="$idea->id"
                :idea="$idea" 
                :votesCount="$idea->votes_count"
            />
        @empty
            <div class="text-center font-normal text-xl">{{ __('global.Sorry, no ideas were found ...') }}</div>  
        @endforelse
    </div><!-- end ideas container -->
    <div class="my-8">
        {{ $ideas->links() }}
    </div>

</div>
