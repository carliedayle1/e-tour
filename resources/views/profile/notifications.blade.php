<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @if(auth()->user()->notifications->count() > 0)
                <div class="flex justify-between">
                    <div class="flex space-x-3">
                        <form action="/notifications/read" method="POST">
                            @csrf
                            <button type="submit" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Mark all as read</button>
                        </form>                        
                        <form action="{{ route('delete.notifications') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="'submit'" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete All</button>
                        </form>
                    </div>
                    <a href="{{ route('dashboard') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->notifications()->paginate(10) as $notification)
                            
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a href="{{ $notification->data['url'] }}">
                                        {{ $notification->data['message'] }}
                                        </a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($notification->read_at == null)
                                        <span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Unread</span>
                                        @else 
                                        <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Read</span>
                                        @endif
                                    </td>
                                   
                                </tr>
                           
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 p-4">
                    {{auth()->user()->notifications()->paginate(1)->links()}}
                </div>
                @else
                <div class="block max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">No notifications at the moment..</h5>
                    
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
