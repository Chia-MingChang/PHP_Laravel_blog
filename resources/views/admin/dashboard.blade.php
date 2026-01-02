<x-app-layout>
    <x-slot name="header">
        @if(Auth::check() && Auth::user()->usertype == 'admin')
            Admin Dashboard
        @else
            User Dashboard
        @endif
    </x-slot>

    @section('content')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{__("You're logged in as Admin!")}}
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
