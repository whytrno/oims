@extends('layouts.dashboard')

@section('dashboard-content')
    <div>
        <form action="{{route('sites.store', $id)}}" method="POST">
            @csrf
            <div class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-10">
                    <x-inputs.provinceSelect name="provinsi"/>
                    <x-inputs.kabupatenSelect name="kabupaten"/>
                </div>

                <x-button title="Submit" type="submit"/>
            </div>
        </form>
    </div>

    @if(!$data->isEmpty())
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
                        {{--                        <form action="{{route('sites.store', $id)}}" method="POST" class="w-1/3">--}}
                        {{--                            @csrf--}}
                        {{--                            <div class="space-y-5">--}}
                        {{--                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-10">--}}
                        {{--                                    <x-inputs.provinceSelect name="provinsi"/>--}}
                        {{--                                    <x-inputs.kabupatenSelect name="kabupaten"/>--}}
                        {{--                                </div>--}}

                        {{--                                <x-button title="Submit" type="submit" width="min"/>--}}
                        {{--                            </div>--}}
                        {{--                        </form>--}}
                        {{--                        <x-button title="Edit" type="submit" width="min"/>--}}
                        {{--                        <x-button title="Delete" type="submit" width="min" color="red-600"/>--}}
                    </li>
                @endforeach
            </ol>
        </div>
    @else
        <x-emptyPage title="No data available" description="There is no data available at the moment."/>
    @endif
@endsection
