<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('global.Tasklist') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">{{__('global.Tasks List') }}</div>
                    
                    <div class="flex-auto text-right mt-2">
                        <a href="/task" class="bg-blue hover:bg-blue-hover text-white font-bold py-2 px-4 rounded">{{__('global.Add new Task')}}</a>
                    </div>
                </div>
                <table class="w-full text-md rounded mb-4">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">{{ __('global.Tasks') }}</th>
                        <th class="text-left p-3 px-5">{{ __('global.Actions') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(auth()->user()->tasks as $task)
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                {{$task->description}}
                            </td>
                            <td class="p-3 px-5">
                                
                                <a href="/task/{{$task->id}}" name="edit" class="mr-3 text-sm bg-blue hover:bg-blue-hover text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">{{__('global.Edit')}}</a>
                                <form action="/task/{{$task->id}}" class="inline-block">
                                    <button type="submit" name="delete" formmethod="POST" class="text-sm bg-red hover:bg-red text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">{{__('global.Delete')}}</button>
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
    </x-app-layout>