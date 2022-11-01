<nav class="hidden md:flex items-center justify-between text-xs text-gray-400">
    <ul class="flex justify-around uppercase font-bold border-b-3 dark:border-none pb-3 ml-3 space-x-10">
        <li>
                <a 
                wire:click.prevent="setStatus('All')" 
                href="{{ route('idea.index', ['status' => 'All']) }}" 
                class="border-b-4 pb-3 hover:border-blue 
                @if ($status === 'All') border-blue text-gray-900 dark:text-white @endif
                ">
                        {{ __('global.All Ideas') }} ({{ $statusCount['all_statuses'] }})
                </a>
        </li>
        {{-- <li><a wire:click.prevent="setStatus('Considering')" href="{{ route('idea.index', ['status' => 'Considering']) }}"
                class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if ($status === 'Considering') border-blue text-gray-900 dark:text-white @endif">
                {{ __('global.Considering') }}
                 ({{ $statusCount['considering'] }})</a></li>
        <li><a wire:click.prevent="setStatus('In Progress')" href="{{ route('idea.index', ['status' => 'In Progress']) }}" 
                class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if ($status === 'In Progress') border-blue text-gray-900 dark:text-white @endif">
                {{ __('global.In progress') }}
                 ({{ $statusCount['in_progress'] }})</a></li>
        <li><a wire:click.prevent="setStatus('Implemented')" href="{{ route('idea.index', ['status' => 'Implemented']) }}"
                class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if ($status === 'Implemented') border-blue text-gray-900 dark:text-white @endif">
                {{ __('global.Implemented') }}
                 ({{ $statusCount['implemented'] }})</a></li>
        <li><a wire:click.prevent="setStatus('Closed')" href="{{ route('idea.index', ['status' => 'Closed']) }}"
                class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if ($status === 'Closed') border-blue text-gray-900 dark:text-white @endif">
                {{ __('global.Closed') }}
                 ({{ $statusCount['closed'] }})</a></li> --}}

        @foreach ( $statuses as $currentStatus)
        <li>
                <a
                wire:click.prevent="setStatus('{{ $currentStatus->name }}')" href="{{ route('idea.index', ['status' => $currentStatus->name]) }}"
                class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue 
                @if ($status === $currentStatus->name) border-blue text-gray-900 dark:text-white @endif
                ">
                @if (App::isLocale('en'))
                        {{ $currentStatus->name }}
                @elseif(App::isLocale('fr'))
                         {{ $currentStatus->name_fr }}
                @endif
                ({{ $statusCount[strtolower(preg_replace("/(?<!^)[A-Z]/",  "_$0", preg_replace("/\s+/", "", $currentStatus->name)))] }})
                </a> 
        </li>
        @endforeach        
    </ul>
</nav>
