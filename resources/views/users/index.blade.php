@extends('layouts.dashboard')

@section('page-title-actions')
    <div class="flex gap-2">
        <a href="{{ route('users.export') }}"
            class="inline-flex items-center justify-center whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground shadow hover:bg-primary/90 rounded-md px-3 text-xs h-7 gap-1">
            <iconify-icon icon="mdi:table-export"></iconify-icon>
            <span class="sr-only sm:not-sr-only sm:whitespace-nowrap">Export</span>
        </a>

        @role('admin')
            <a href="{{ route('users.create') }}"
                class="inline-flex items-center justify-center whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground shadow hover:bg-primary/90 rounded-md px-3 text-xs h-7 gap-1"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-circle-plus h-3.5 w-3.5">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M8 12h8"></path>
                    <path d="M12 8v8"></path>
                </svg>
                <span class="sr-only sm:not-sr-only sm:whitespace-nowrap">Add Data</span>
            </a>
        @endrole
    </div>
@endsection

@section('dashboard-content')
    <table id="example" class="overflow-auto">
        <thead>
            <tr>
                <th>No</th>
                @role('admin')
                    <th>Email</th>
                    <th>Password</th>
                @endrole
                <th>Foto</th>
                <th>Nama</th>
                <th>Nik</th>
                <th>Lokasi Site</th>
                @role('admin')
                    <th>Aksi</th>
                @endrole
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @role('admin')
                        <td>{{ $d->email }}</td>
                        <td>{{ $d->password }}</td>
                    @endrole
                    <td>
                        <span class="relative flex shrink-0 overflow-hidden rounded-full size-14">
                            @if (is_null($d->profile->foto))
                                @php
                                    $fallback = 'U';
                                    if ($d->profile->nama) {
                                        $namaExplode = explode(' ', $d->profile->nama);
                                        $fallback = $namaExplode[0][0];
                                    }
                                @endphp
                                <div
                                    class="h-full w-full rounded-full flex items-center justify-center bg-gray-200 text-gray-600 font-semibold">
                                    {{ ucfirst($fallback) }}
                                </div>
                            @else
                                <img class="aspect-square size-14 rounded-full" alt="Foto"
                                    src="{{ $d->profile->foto }}">
                            @endif
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('users.detail', $d->id) }}"
                            class="border-b border-b-gray-400 border-dotted hover:border-b-black">
                            {{ $d->profile->nama }}
                        </a>
                    </td>
                    <td>{{ $d->profile->nik }}</td>
                    <td>
                        <a href="{{ route('sites', $d->id) }}"
                            class="border-b border-b-gray-400 border-dotted hover:border-b-black">
                            Lokasi Site
                        </a>
                    </td>

                    @role('admin')
                        <td>
                            <div class="grid grid-cols-1 md:grid-cols-2 items-center h-full">
                                <a href="{{ route('users.detail', $d->id) }}"
                                    class="font-medium text-sm border-b border-b-gray-400 border-dotted hover:border-b-black w-min">Edit</a>
                                <a href="{{ route('users.delete', $d->id) }}"
                                    class="font-medium text-sm border-b border-b-gray-400 border-dotted hover:border-b-black w-min text-red-600">Delete</a>
                            </div>
                        </td>
                    @endrole
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                @role('admin')
                    <th>Email</th>
                    <th>Password</th>
                @endrole
                <th>Foto</th>
                <th>Name</th>
                <th>Nik</th>
                <th>Lokasi Site</th>
                @role('admin')
                    <th>Aksi</th>
                @endrole
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
