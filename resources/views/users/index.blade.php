@extends('layouts.dashboard')

@section('dashboard-content')
    <table id="example" class="overflow-auto">
        <thead>
            <tr>
                <th>No</th>
                @if (Auth::user()->role_id === 1)
                    <th>Email</th>
                    <th>Password</th>
                @endif
                <th>Foto</th>
                <th>Nama</th>
                <th>Nik</th>
                <th>Lokasi Site</th>
                @if (Auth::user()->role_id === 1)
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @if (Auth::user()->role_id === 1)
                        <td>{{ $d->email }}</td>
                        <td>{{ $d->password }}</td>
                    @endif
                    <td>
                        <span class="relative flex shrink-0 overflow-hidden rounded-full size-14">
                            @if (is_null($d->profile->foto))
                                @php
                                    $namaExplode = explode(' ', $d->profile->nama);
                                    $fallback = $namaExplode[0][0];
                                @endphp
                                <div
                                    class="h-full w-full rounded-full flex items-center justify-center bg-gray-200 text-gray-600 font-semibold">
                                    {{ $fallback }}
                                </div>
                            @else
                                <img class="aspect-square size-14 rounded-full" alt="Foto" src="{{ $d->profile->foto }}">
                            @endif
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('users.detail', $d->id) }}" class="border-b border-dotted hover:border-b-black">
                            {{ $d->profile->nama }}
                        </a>
                    </td>
                    <td>{{ $d->profile->nik }}</td>
                    <td>
                        <a href="{{ route('sites', $d->id) }}" class="border-b border-dotted hover:border-b-black">
                            Lokasi Site
                        </a>
                    </td>

                    @if (Auth::user()->role_id === 1)
                        <td>
                            <div class="grid grid-cols-1 md:grid-cols-2 items-center h-full">
                                <a href="{{ route('users.detail', $d->id) }}"
                                    class="font-medium text-sm hover:underline underline-offset-4">Edit</a>
                                <a href="{{ route('users.delete', $d->id) }}"
                                    class="font-medium text-sm hover:underline underline-offset-4 text-red-600">Delete</a>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                @if (Auth::user()->role_id === 1)
                    <th>Email</th>
                    <th>Password</th>
                @endif
                <th>Foto</th>
                <th>Name</th>
                <th>Nik</th>
                <th>Lokasi Site</th>
                @if (Auth::user()->role_id === 1)
                    <th>Aksi</th>
                @endif
            </tr>
        </tfoot>
    </table>
@endsection

@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush
