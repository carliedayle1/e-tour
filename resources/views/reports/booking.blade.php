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
        <h1 class="text-3xl font-bold">{{ $booking->travelPackage->title }}</h1>
        <p class="mt-3 text-md">{{ $booking->travelPackage->description }}</p>
    </div>

    <div class="flex flex-col justify-center items-center mt-9">
            <h3  class="font-bold text-lg">Booked by: <span>{{ $booking->user->name }}</span></h3>
            <h3  class="font-bold text-lg">Scheduled Date: <span>{{ $booking->timeslot->date }}</span></h3>
            <h3 class="font-bold text-lg">Duration : <span>{{ $booking->timeslot->hours_days }}</span></h3>
            <h3  class="font-bold text-lg">Fee: <span>Php {{ $booking->travelPackageType->fee }}</span></h3>
    </div>

    <div class="mt-9">
        <h2 class="font-bold text-xl mb-6">Destinations</h2>
        <div class="">

  
        @foreach($booking->travelPackage->locations as $location)
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="{{ asset('/storage/'. $location->image) }}" alt="{{ $location->name }}" />
            </a>
            <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $location->name }}</h5>
                
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $location->description }}</p>
               
            </div>
        </div>
        @endforeach
        </div>
    </div>

   




</body>
</html>