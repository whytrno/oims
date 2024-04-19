{{-- <x-emptyPage title="Dashboard" description="Selamat datang di dashboard" /> --}}
<div class="grid grid-cols-6 gap-5 w-full">
    <div
        class="col-span-2 p-4 rounded-lg border border-dashed shadow-sm space-y-2 flex flex-col justify-between bg-green-100">
        <h1 class="font-semibold">Total Karyawan</h1>
        <h1 class="text-2xl font-bold">{{ $karyawan }} Karyawan</h1>
    </div>
    <div
        class="col-span-2 p-4 rounded-lg border border-dashed shadow-sm space-y-2 flex flex-col justify-between bg-blue-100">
        <h1 class="font-semibold">Karyawan yang akan berangkat 7 hari dari sekarang</h1>
        <h1 class="text-2xl font-bold">{{ $karyawanYangAkanBerangkat }} Karyawan</h1>
    </div>
    <div
        class="col-span-2 p-4 rounded-lg border border-dashed shadow-sm space-y-2 flex flex-col justify-between bg-red-100">
        <h1 class="font-semibold">Karyawan yang akan berangkat 7 hari dari sekarang</h1>
        <h1 class="text-2xl font-bold">{{ $karyawanYangAkanKembali }} Karyawan</h1>
    </div>
    <div class="col-span-3 p-4 rounded-lg border border-dashed shadow-sm space-y-2">
        <h1 class="font-semibold">Penempatan</h1>
        <p class="text-xs text-gray-500">*Penempatan terbaru</p>
        @livewire('DashboardCards.UserSiteLocationTable')
        <x-button type="button" color="primary" class="mb-2" width="full">Tambah Penempatan</x-button>
    </div>
    <div class="col-span-3 p-4 rounded-lg border border-dashed shadow-sm">
        <h1 class="font-semibold">Penempatan</h1>
        <p class="text-xs text-gray-500">*Pemberangkatan dan kepulangan 7 hari dari sekarang</p>
        @livewire('DashboardCards.PemberangkatankembaliTable')
    </div>
</div>
