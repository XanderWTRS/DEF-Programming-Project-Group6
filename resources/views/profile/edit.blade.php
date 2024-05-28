use Carbon\Carbon;
<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900">Reserved items</h2>
                <ul>
                @foreach($reservationsWithProducts as $reservation)
                    <li class="reservation-list" style="border-bottom: 1px solid #cccc;
                    padding: 8px;">{{ $reservation->title }} <br>
                        @if(($reservation->category) !== '')
                            Category: {{$reservation->category}} <br>
                        @endif
                        @if(($reservation->beschrijving) !== '')
                            Beschrijving: {{ $reservation->beschrijving }} <br>               
                        @endif
                        Datum: {{ $reservation->date }} tot {{ Carbon\Carbon::parse($reservation->date)->addDays(4)->format("y-m-d") }}<br>
                    </li>
                    <br>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
