@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="p-2">
        <ol class="relative border-s border-gray-200">
            @foreach ($data as $index => $d)
                <li class="mb-10 ms-6">
                    <span
                        class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white">
                        <iconify-icon icon="mdi:location-check-outline"></iconify-icon>
                    </span>
                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">{{ $d->provinsi }} -
                        {{ $d->kabupaten }}
                        @if ($index === 0)
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded ms-3">
                                Latest
                            </span>
                        @endif
                    </h3>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-400">Released on
                        {{ $d->created_at->format('d F Y') }}
                    </time>
                </li>
            @endforeach
        </ol>
    </div>
@endsection
