<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gereserveerde items:') }}
        </h2>
    </x-slot>

    <div class="py-12">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <ul>
                @foreach($reservationsWithProducts->unique('title', 'category', 'date') as $reservation)
                    <li class="reservation-list" style="border-bottom: 1px solid #cccc;
                    padding: 8px;">{{ $reservation->title }} <br>
                        @if(($reservation->category) !== '')
                            Category: {{$reservation->category}} <br>
                        @endif
                        @if(($reservation->beschrijving) !== '')
                            Beschrijving: {{ $reservation->beschrijving }} <br>               
                        @endif
                        Datum: {{ $reservation->date }} tot {{ Carbon\Carbon::parse($reservation->date)->addDays(4)->format("y-m-d") }}<br>
                        Inlevering in: {{ floor(Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($reservation->date)->addDays(5))) }} days<br>
                        @if(count($reservationsWithProducts->where('title', $reservation->title)->where('category', $reservation->category)->where('date', $reservation->date)) > 1)
                            Count: {{ count($reservationsWithProducts->where('title', $reservation->title)->where('category', $reservation->category)->where('date', $reservation->date)) }}<br>
                        @endif
                    </li>
                    <form action="{{ route('annuleer', ['id' => $reservation->id]) }}" method="POST" class="annuleer-form">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $reservation->id }}">
                        <button type="submit" class="annuleer-button">Annuleer</button>
                    </form>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
