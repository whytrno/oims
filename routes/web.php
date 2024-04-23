<?php

use App\Http\Middleware\RoleMiddleware;
use App\Livewire\Pages\DashboardPage;
use App\Livewire\Pages\SiteLocationPage;
use App\Livewire\Pages\UserSiteLocationDetailPage;
use App\Livewire\Pages\UserSiteLocationPage;
use App\Livewire\Pages\UserPage;
use App\Models\Profile;
use App\Models\SiteLocation;
use App\Models\User;
use App\Models\UserSiteLocation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('import-data', function () {
    $data = [
        [
            "email" => "Misandi@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Misandi",
            "nik" => "1234567891011",
            "lokasi_site" => "ERPL"
        ],
        [
            "email" => "M. Reza Palevi@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "M. Reza Palevi",
            "nik" => "1234567891012",
            "lokasi_site" => "ERAM"
        ],
        [
            "email" => "Wahyu Saputra@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Wahyu Saputra",
            "nik" => "1234567891013",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Hartina@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Hartina",
            "nik" => "1234567891014",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Dhiah Ayu Dwi Lestari@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Dhiah Ayu Dwi Lestari",
            "nik" => "1234567891016",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Sarah Juliana Dovi@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Sarah Juliana Dovi",
            "nik" => "1234567891017",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Dimas Yulianto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Dimas Yulianto",
            "nik" => "1234567891018",
            "lokasi_site" => "PWKI"
        ],
        [
            "email" => "Muhammad Fadilah@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Muhammad Fadilah",
            "nik" => "1234567891019",
            "lokasi_site" => "ERPP"
        ],
        [
            "email" => "Alexander Bobby Haryo Prakoso@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Alexander Bobby Haryo Prakoso",
            "nik" => "1234567891020",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Raditya Angga Kusuma@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Raditya Angga Kusuma",
            "nik" => "1234567891021",
            "lokasi_site" => "PWKP"
        ],
        [
            "email" => "Hot Mazmuloh Situmorang@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Hot Mazmuloh Situmorang",
            "nik" => "1234567891022",
            "lokasi_site" => "ERAM"
        ],
        [
            "email" => "Yuni Ari@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Yuni Ari",
            "nik" => "1234567891023",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Farhan Rama Kurniawan @orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Farhan Rama Kurniawan",
            "nik" => "1234567891024",
            "lokasi_site" => "ERPM"
        ],
        [
            "email" => "Erfani@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Erfani",
            "nik" => "1234567891025",
            "lokasi_site" => "ERPM"
        ],
        [
            "email" => "Suprianto (Totok)@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Suprianto (Totok)",
            "nik" => "1234567891026",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Zulfikri Hakim Akbar@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Zulfikri Hakim Akbar",
            "nik" => "1234567891027",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Ahmadin Dinovapianur@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Ahmadin Dinovapianur",
            "nik" => "1234567891028",
            "lokasi_site" => "ERAM"
        ],
        [
            "email" => "Vian Rosyadi N@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Vian Rosyadi N",
            "nik" => "1234567891029",
            "lokasi_site" => "ERAM"
        ],
        [
            "email" => "Ardi Isdar@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Ardi Isdar",
            "nik" => "1234567891030",
            "lokasi_site" => "PWKI"
        ],
        [
            "email" => "Agistian Suhendan@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Agistian Suhendan",
            "nik" => "1234567891031",
            "lokasi_site" => "PWKI"
        ],
        [
            "email" => "Rahmad J Eka Nawa Songo Songo@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Rahmad J Eka Nawa Songo Songo",
            "nik" => "1234567891032",
            "lokasi_site" => "ERPP"
        ],
        [
            "email" => "Sumarlin@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Sumarlin",
            "nik" => "1234567891033",
            "lokasi_site" => "ERAM"
        ],
        [
            "email" => "Rohito Napitu@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Rohito Napitu",
            "nik" => "1234567891034",
            "lokasi_site" => "ERAM"
        ],
        [
            "email" => "Dessy Natasha Sianturi@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Dessy Natasha Sianturi",
            "nik" => "1234567891035",
            "lokasi_site" => "ERPP"
        ],
        [
            "email" => "Willy@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Willy",
            "nik" => "1234567891036",
            "lokasi_site" => "ERAM"
        ],
        [
            "email" => "Salsabila A@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Salsabila A",
            "nik" => "1234567891037",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Norhidayah@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Norhidayah",
            "nik" => "1234567891038",
            "lokasi_site" => "ERPP"
        ],
        [
            "email" => "M. Algifari @orecon.co.id",
            "password" => "Orecon123",
            "nama" => "M. Algifari",
            "nik" => "1234567891039",
            "lokasi_site" => "ERPM"
        ],
        [
            "email" => "Fakhri Ariq Alauddin Sujana@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Fakhri Ariq Alauddin Sujana",
            "nik" => "1234567891040",
            "lokasi_site" => "ERAM"
        ],
        [
            "email" => "Dicky Aldy Denaldy@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Dicky Aldy Denaldy",
            "nik" => "1234567891041",
            "lokasi_site" => "SIGL"
        ],
        [
            "email" => "Reza Dwiki P@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Reza Dwiki P",
            "nik" => "1234567891042",
            "lokasi_site" => "SIGL"
        ],
        [
            "email" => "Ikhwan Mustofa@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Ikhwan Mustofa",
            "nik" => "1234567891043",
            "lokasi_site" => "PWKI"
        ],
        [
            "email" => "Eko Prasetyo@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Eko Prasetyo",
            "nik" => "1234567891044",
            "lokasi_site" => "PWKI"
        ],
        [
            "email" => "Farhan Izahrul Haq@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Farhan Izahrul Haq",
            "nik" => "1234567891045",
            "lokasi_site" => "SIGL"
        ],
        [
            "email" => "Ridwan Ramadhan@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Ridwan Ramadhan",
            "nik" => "1234567891046",
            "lokasi_site" => "ERPL"
        ],
        [
            "email" => "Nida Alimatul Aqilah@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Nida Alimatul Aqilah",
            "nik" => "1234567891047",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Fella Shofa@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Fella Shofa",
            "nik" => "1234567891049",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Angella Chrisdiar Astri Kusumastuti@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Angella Chrisdiar Astri Kusumastuti",
            "nik" => "1234567891050",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Kurniadi Prasetyo@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Kurniadi Prasetyo",
            "nik" => "1234567891051",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Tim Acc Agung Dkk (...)@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Tim Acc Agung Dkk (...)",
            "nik" => "1234567891052",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Ajat@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Ajat",
            "nik" => "1234567891053",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Diasti Chandra Anggraini@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Diasti Chandra Anggraini",
            "nik" => "1234567891054",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Kiki Kurniawati@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Kiki Kurniawati",
            "nik" => "1234567891055",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Amos Sigalingging @orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Amos Sigalingging",
            "nik" => "1234567891056",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Dava Ariansyah@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Dava Ariansyah",
            "nik" => "1234567891057",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Putri Enjelia@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Putri Enjelia",
            "nik" => "1234567891058",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "A. Astri Putri@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "A. Astri Putri",
            "nik" => "1234567891059",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Yusuf Nurhadi Firdaus@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Yusuf Nurhadi Firdaus",
            "nik" => "1234567891060",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Waryani@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Waryani",
            "nik" => "1234567891062",
            "lokasi_site" => "SKKK"
        ],
        [
            "email" => "Adi Sukamto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Adi Sukamto",
            "nik" => "1234567891063",
            "lokasi_site" => "PWKI"
        ],
        [
            "email" => "Asis@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Asis",
            "nik" => "1234567891064",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Marsid@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Marsid",
            "nik" => "1234567891065",
            "lokasi_site" => "PWKI"
        ],
        [
            "email" => "Vian Nangamue@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Vian Nangamue",
            "nik" => "1234567891066"
        ],
        [
            "email" => "Anton Rahmat Saleh@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Anton Rahmat Saleh",
            "nik" => "1234567891067",
            "lokasi_site" => "PWKI"
        ],
        [
            "email" => "Hermawan Susanto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Hermawan Susanto",
            "nik" => "1234567891068",
            "lokasi_site" => "PWKI"
        ],
        [
            "email" => "Sukirno@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Sukirno",
            "nik" => "1234567891069",
            "lokasi_site" => "PWKI"
        ],
        [
            "email" => "Januar Putranto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Januar Putranto",
            "nik" => "1234567891071",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Heri Mulyana@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Heri Mulyana",
            "nik" => "1234567891072",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Ahmad Syahal@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Ahmad Syahal",
            "nik" => "1234567891073",
            "lokasi_site" => "PWKI"
        ],
        [
            "email" => "Achmad Syarif@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Achmad Syarif",
            "nik" => "1234567891074",
            "lokasi_site" => "PWKI"
        ],
        [
            "email" => "Sonny Arianto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Sonny Arianto",
            "nik" => "1234567891075",
            "lokasi_site" => "ERPP"
        ],
        [
            "email" => "Riyan Fernandes Hutagulung@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Riyan Fernandes Hutagulung",
            "nik" => "1234567891076",
            "lokasi_site" => "ERAM"
        ],
        [
            "email" => "Rinus yonis ari wibowo@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Rinus yonis ari wibowo",
            "nik" => "1234567891077"
        ],
        [
            "email" => "Agus Hermanto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Agus Hermanto",
            "nik" => "1234567891078",
            "lokasi_site" => "ERPP"
        ],
        [
            "email" => "Sutari@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Sutari",
            "nik" => "1234567891079",
            "lokasi_site" => "ERPP"
        ],
        [
            "email" => "Moh Taufiq Kurniawan@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Moh Taufiq Kurniawan",
            "nik" => "1234567891080",
            "lokasi_site" => "ERPP"
        ],
        [
            "email" => "Yusuf Ma'ad@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Yusuf Ma'ad",
            "nik" => "1234567891081",
            "lokasi_site" => "ERPP"
        ],
        [
            "email" => "Edy Santoso@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Edy Santoso",
            "nik" => "1234567891082",
            "lokasi_site" => "ERPM"
        ],
        [
            "email" => "Suharyanto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Suharyanto",
            "nik" => "1234567891083",
            "lokasi_site" => "ERAM"
        ],
        [
            "email" => "Elen Hermawan Kasambau@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Elen Hermawan Kasambau",
            "nik" => "1234567891084",
            "lokasi_site" => "ERAM"
        ],
        [
            "email" => "Desi Rahmat Fadly@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Desi Rahmat Fadly",
            "nik" => "1234567891085",
            "lokasi_site" => "ERPP"
        ],
        [
            "email" => "Devi Saputra@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Devi Saputra",
            "nik" => "1234567891086",
            "lokasi_site" => "ERPL"
        ],
        [
            "email" => "Raihan Arya Kusuma@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Raihan Arya Kusuma",
            "nik" => "1234567891087",
            "lokasi_site" => "ERPL"
        ],
        [
            "email" => "Benny Jawatar Sinaga@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Benny Jawatar Sinaga",
            "nik" => "1234567891088",
            "lokasi_site" => "ERPL"
        ],
        [
            "email" => "Risja @orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Risja",
            "nik" => "1234567891090",
            "lokasi_site" => "BUNTOK"
        ],
        [
            "email" => "MANAGEMENT & SENIOR STAFF@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "MANAGEMENT & SENIOR STAFF",
            "nik" => "1234567891091"
        ],
        [
            "email" => "I Gede Adnyana@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "I Gede Adnyana",
            "nik" => "1234567891092"
        ],
        [
            "email" => "Hermawan@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Hermawan",
            "nik" => "1234567891093"
        ],
        [
            "email" => "Aditya Arya Wicaksono@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Aditya Arya Wicaksono",
            "nik" => "1234567891094",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Maximillian Kolbe Widhi Wijayanto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Maximillian Kolbe Widhi Wijayanto",
            "nik" => "1234567891095",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Ahmad Mahfud@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Ahmad Mahfud",
            "nik" => "1234567891096",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Irwanto Sinaga@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Irwanto Sinaga",
            "nik" => "1234567891097",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Ahmedi Susanto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Ahmedi Susanto",
            "nik" => "1234567891098",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Reza Aprilian@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Reza Aprilian",
            "nik" => "1234567891099",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Tito Adhi Yansyah@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Tito Adhi Yansyah",
            "nik" => "1234567891100",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Fahrul Abdi Wicaksono@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Fahrul Abdi Wicaksono",
            "nik" => "1234567891101",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Eva O. Siregar@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Eva O. Siregar",
            "nik" => "1234567891102",
            "lokasi_site" => "HO"
        ],
        [
            "email" => "Resi Yogi@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Resi Yogi",
            "nik" => "1234567891104"
        ],
        [
            "email" => "Setyawan WP@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Setyawan WP",
            "nik" => "1234567891105"
        ],
        [
            "email" => "Briawan Dwipa@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Briawan Dwipa",
            "nik" => "1234567891106"
        ],
        [
            "email" => "Wahyu Agus Cahyanto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Wahyu Agus Cahyanto",
            "nik" => "1234567891108",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Tri Agus Irianto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Tri Agus Irianto",
            "nik" => "1234567891109",
            "lokasi_site" => "ERPP"
        ],
        [
            "email" => "Kasikun@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Kasikun",
            "nik" => "1234567891110",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Purnomo@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Purnomo",
            "nik" => "1234567891111",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Ruswanto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Ruswanto",
            "nik" => "1234567891112",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Eko Julianda@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Eko Julianda",
            "nik" => "1234567891113",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Supriyadi@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Supriyadi",
            "nik" => "1234567891114",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Gatot S@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Gatot S",
            "nik" => "1234567891115",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Sulaiman@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Sulaiman",
            "nik" => "1234567891116",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Wahono@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Wahono",
            "nik" => "1234567891118",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Riki Yogi Setiawan @orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Riki Yogi Setiawan",
            "nik" => "1234567891119",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Rinto Ashari@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Rinto Ashari",
            "nik" => "1234567891120",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Oka Dwirangga@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Oka Dwirangga",
            "nik" => "1234567891121",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Mulia Siregar@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Mulia Siregar",
            "nik" => "1234567891122",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Uki Setyo P@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Uki Setyo P",
            "nik" => "1234567891123",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Deddy Dores@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Deddy Dores",
            "nik" => "1234567891124",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Agil Pranata@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Agil Pranata",
            "nik" => "1234567891125",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Suhendi Afriyadi@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Suhendi Afriyadi",
            "nik" => "1234567891126",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Sriyono@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Sriyono",
            "nik" => "1234567891127",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Mediono@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Mediono",
            "nik" => "1234567891128",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Yunan Adi Tokan@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Yunan Adi Tokan",
            "nik" => "1234567891129",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Bili Janatim N@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Bili Janatim N",
            "nik" => "1234567891130",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Rio Yosefta Karo-Karo@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Rio Yosefta Karo-Karo",
            "nik" => "1234567891131",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "M. Saleh@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "M. Saleh",
            "nik" => "1234567891132",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Dedek Al Masrum@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Dedek Al Masrum",
            "nik" => "1234567891133"
        ],
        [
            "email" => "Galih Novian Saputra@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Galih Novian Saputra",
            "nik" => "1234567891134",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Agus Jamali@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Agus Jamali",
            "nik" => "1234567891135",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Herman Sawiran@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Herman Sawiran",
            "nik" => "1234567891136",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Dody Irawan@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Dody Irawan",
            "nik" => "1234567891137",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Taryono@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Taryono",
            "nik" => "1234567891138",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Sugeng Harianto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Sugeng Harianto",
            "nik" => "1234567891139",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Ryan Ardiansyah@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Ryan Ardiansyah",
            "nik" => "1234567891140",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Aan Rusmanto@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Aan Rusmanto",
            "nik" => "1234567891141",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Rudi Setiawan@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Rudi Setiawan",
            "nik" => "1234567891142",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Tamrin@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Tamrin",
            "nik" => "1234567891143",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Koko Permadi@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Koko Permadi",
            "nik" => "1234567891144",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Ayik Riyadi@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Ayik Riyadi",
            "nik" => "1234567891145",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Adi Lansyah@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Adi Lansyah",
            "nik" => "1234567891146",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Johan@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Johan",
            "nik" => "1234567891147",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Fahchri Himakmur Rahman@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Fahchri Himakmur Rahman",
            "nik" => "1234567891148",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Junaidi@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Junaidi",
            "nik" => "1234567891149",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Dedi Irawan@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Dedi Irawan",
            "nik" => "1234567891150",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Ferry@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Ferry",
            "nik" => "1234567891151",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Jaya S@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Jaya S",
            "nik" => "1234567891152",
            "lokasi_site" => "OPPS"
        ],
        [
            "email" => "Sandi Permana@orecon.co.id",
            "password" => "Orecon123",
            "nama" => "Sandi Permana",
            "nik" => "1234567891153",
            "lokasi_site" => "OPPS"
        ]
    ];

    foreach ($data as $d) {
        $user = User::create([
            'email' => $d['email'],
            'password' => Crypt::encryptString($d['password'])
        ]);
        $role = Role::where('name', 'user')->first();

        $user->assignRole($role);

        Profile::create([
            'user_id' => $user->id,
            'nama' => $d['nama'],
            'nik' => $d['nik']
        ]);

        if (isset($d['lokasi_site'])) {
            $siteLocation = SiteLocation::where('name', $d['lokasi_site'])->first();
            UserSiteLocation::create([
                'user_id' => $user->id,
                'site_location_id' => $siteLocation->id,
                'tgl_keberangkatan' => Carbon::now(),
                'tgl_kembali' => Carbon::now()
            ]);
        }
    }
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['middleware' => [RoleMiddleware::class . ':admin,manager']], function () {
        Route::get('/', DashboardPage::class)->name('dashboard');
    });

    Route::group(['prefix' => 'karyawan'], function () {
        Route::group(['middleware' => [RoleMiddleware::class . ':admin,manager']], function () {
            Route::get('/', UserPage::class)->name('users');
            Route::get('/{userId}/detail', UserPage::class)->name('users.show');
            Route::get('/{userId}/penempatan', UserSiteLocationDetailPage::class)->name('users.sites.detail');

            Route::group(['prefix' => 'penempatan'], function () {
                Route::get('/', UserSiteLocationPage::class)->name('users.sites');
            });
        });
    });

    Route::group(['prefix' => 'penempatan'], function () {
        Route::group(['middleware' => [RoleMiddleware::class . ':admin']], function () {
            Route::get('/', SiteLocationPage::class)->name('sites');
        });
    });


    Route::get('profile', UserPage::class)->name('profile');
    Route::get('logout', function () {
        try {
            Auth::guard("web")->logout();
            return redirect()->route('login')->success('Logout success');
        } catch (\Exception $e) {
            return redirect()->back()->error($e->getMessage());
        }
    })->name('logout');
});

Route::group(['middleware' => ['guest']], function () {
    include 'child/web/guest.php';
});

// Route::get('create-role', function () {
//     // Role::create([
//     //     'name' => 'user',
//     // ]);

//     $role = Role::where('name', 'user')->first();
//     $user = User::where('email', 'admin@gmail.com')->first();
//     $user->syncRoles($role);
// });

// Route::get('assign-permission', function () {
//     $role = Role::where('name', 'admin')->first();
//     $permission = Permission::where('name', 'user_create')->first();
//     $role->givePermissionTo($permission);
// });

// Route::get('assign-user', function () {
//     $user = \App\Models\User::where('email', 'admin@gmail.com')->first();
//     $role = Role::where('name', 'admin')->first();
//     $user->assignRole($role);
// });
