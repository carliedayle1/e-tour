<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Document</title>
    <link rel="stylesheet" href="{{ asset('css/pdf-styles.css') }}">

</head>
<body>
    <div class="shrink-0 flex justify-center items-center space-x-4">
        <x-application-logo-name class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        <span class="text-gray-900 text-2xl font-bold dark:text-white">E-TOUR</span>
    </div>
    <div class="text-center">
        <h1 class="text-3xl font-bold">{{ $itinerary->name }}</h1>
        <p class="mt-6 text-md">{{ $itinerary->description }}</p>
    </div>

    <div class="flex flex-col justify-center items-center">

         <h3 class="mt-9 mb-4 text-2xl font-bold text-gray-900 dark:text-white">Everyday Activities</h3>
         <ol class="relative border-l border-gray-200 dark:border-gray-700 max-w-4xl mb-12">   
             @foreach($itinerary->dates->sortBy('actual_date') as $date)               
             <li class="mb-10 ml-6">            
                 <span class="absolute flex items-center justify-center w-6 h-6 bg-yellow-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-yellow-900">
                     <svg class="w-2.5 h-2.5 text-yellow-800 dark:text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                         <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                     </svg>
                 </span>
                 <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $date->actual_date }} 
                 @if(!$date->filled)
                 <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 ml-3">Pending</span>
                 @endif
                 </h3>

                 @if($date->filled)
                     <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Total Distance Traveled: {{ $date->total_travel_distance }} KM</time>
                     <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Total Fees: Php {{ $date->total_travel_fees }}</time>

                     @foreach($date->items as $item)
                         <div class="ml-4 text-base font-normal text-gray-800 dark:text-white flex gap-x-2"> 
                             <span>
                                 {{ $item->attraction->title }}
                             </span>
                         </div>
                     @endforeach
                 @endif
             </li>
             @endforeach

         </ol>
     </div>
</body>
</html>