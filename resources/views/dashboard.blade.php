<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4 text-white">Calendari de Reserves</h3>
                    <div class="grid grid-cols-7 gap-4">

                        <div class="col-span-1 text-center font-bold text-white">Diumenge</div>
                        <div class="col-span-1 text-center font-bold text-white">Dilluns</div>
                        <div class="col-span-1 text-center font-bold text-white">Dimarts</div>
                        <div class="col-span-1 text-center font-bold text-white">Dimecres</div>
                        <div class="col-span-1 text-center font-bold text-white">Dijous</div>
                        <div class="col-span-1 text-center font-bold text-white">Divendres</div>
                        <div class="col-span-1 text-center font-bold text-white">Dissabte</div>


                        @foreach($days as $day)
                        <div class="border p-4 bg-white rounded-lg">
                            <div class="font-bold text-center">{{ $day->format('d') }}</div>
                            <div class="text-sm">
                                @foreach($reservas as $reserva)
                                @if(Carbon\Carbon::parse($reserva->reservation_date)->isSameDay($day))
                                <div class="bg-orange-500 text-white p-1 rounded mt-1">
                                    Client: {{ $reserva->client->name ?? 'Client' }}
                                    Servei: {{ $reserva->service->name ?? 'Service' }}
                                    Hora: {{$reserva->reservation_time}}
                                    Treballador: {{$reserva->user->name}}
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="GET" action="{{ route('client.add') }}">
                    <x-primary-button type="submit">Crear Client</x-primary-button>
                </form>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="GET" action="{{ route('reservation.create') }}">
                    <x-primary-button type="submit">Afegir reserva</x-primary-button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>