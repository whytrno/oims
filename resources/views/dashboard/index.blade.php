{{-- <x-emptyPage title="Dashboard" description="Selamat datang di dashboard" /> --}}
<div class="grid grid-cols-6 gap-5 w-full">
    <x-card class="lg:col-span-2 bg-green-100">
        <x-slot:title>
            Total Karyawan
        </x-slot:title>

        <h1 class="text-2xl font-bold">{{ $karyawan }} Karyawan</h1>
    </x-card>
    <x-card class="lg:col-span-2 bg-red-100">
        <x-slot:title>
            Karyawan yang akan berangkat 7 hari dari sekarang
        </x-slot:title>

        <h1 class="text-2xl font-bold">{{ $karyawanYangAkanBerangkat }} Karyawan</h1>
    </x-card>
    <x-card class="lg:col-span-2 bg-blue-100">
        <x-slot:title>
            Karyawan yang akan kembali 7 hari dari sekarang
        </x-slot:title>

        <h1 class="text-2xl font-bold">{{ $karyawanYangAkanKembali }} Karyawan</h1>
    </x-card>

    <x-card>
        <x-slot:title>
            Penempatan
        </x-slot:title>
        <x-slot:description>
            Penempatan terbaru
        </x-slot:description>

        @livewire('DashboardCards.UserSiteLocationTable')

        <x-slot:footer>
            <x-button type="buttonLink" :href="route('users.sites')" width="full">Lihat Selengkapnya</x-button>
        </x-slot:footer>
    </x-card>

    <x-card>
        <x-slot:title>
            Penempatan
        </x-slot:title>
        <x-slot:description>
            Pemberangkatan dan kepulangan 7 hari dari sekarang
        </x-slot:description>

        @livewire('DashboardCards.PemberangkatankembaliTable')
    </x-card>
</div>
