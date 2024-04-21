<?php

namespace App\Livewire\Tables;

use App\Models\UserSiteLocation;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use Illuminate\View\View;
use Masmerise\Toaster\Toaster;

final class UserSiteLocationTable extends PowerGridComponent
{
    use WithExport;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public string $primaryKey = 'user_site_locations.id';
    public string $sortField = 'user_site_locations.id';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        $now = now();
        $sevenDaysBefore = $now->subDays(7);
        $eightDaysAfter = $now->addDays(8);

        return UserSiteLocation::query()
            ->select('user_site_locations.id as id', 'users.id as user_id', 'profiles.nama as name', 'site_locations.id as site_location_id', 'site_locations.name as site_location', 'tgl_keberangkatan', 'tgl_kembali')
            ->join('users', 'users.id', '=', 'user_site_locations.user_id')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->join('site_locations', 'site_locations.id', '=', 'user_site_locations.site_location_id');
        //     ->orderByRaw("CASE
        //     WHEN tgl_keberangkatan BETWEEN '$sevenDaysBefore' AND '$eightDaysAfter' THEN 0
        //     WHEN tgl_kembali BETWEEN '$sevenDaysBefore' AND '$eightDaysAfter' THEN 1
        //     WHEN tgl_keberangkatan IS NOT NULL AND tgl_keberangkatan < '$sevenDaysBefore' THEN 2
        //     WHEN tgl_kembali IS NOT NULL AND tgl_kembali > '$eightDaysAfter' THEN 3
        //     ELSE 4
        // END ASC,
        // CASE
        //     WHEN tgl_keberangkatan IS NOT NULL THEN tgl_keberangkatan
        //     ELSE tgl_kembali
        // END ASC");
    }

    public function relationSearch(): array
    {
        return [
            'user' => [
                'profile' => 'nama'
            ],
            'siteLocation' => 'name'
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('name', fn (UserSiteLocation $model) => $model->user->profile->nama)
            ->add('site_location', fn (UserSiteLocation $model) => $model->siteLocation->name)
            ->add('tgl_keberangkatan_formatted', function (UserSiteLocation $model) {
                if (Carbon::parse($model->tgl_keberangkatan)->diffInDays(Carbon::now()) > 0) {
                    $tgl_keberangkatan = Carbon::parse($model->tgl_keberangkatan)->format('d F Y');
                    return $tgl_keberangkatan;
                } else {
                    $tgl_keberangkatan = Carbon::parse($model->tgl_keberangkatan)->format('d F Y');
                    $day_remaining = round(Carbon::parse($model->tgl_keberangkatan)->diffInDays(Carbon::now()));
                    $day_remaining = abs($day_remaining);

                    return $tgl_keberangkatan . ' (' . abs($day_remaining) . ' hari yang lagi)';
                }
            })
            ->add('tgl_kembali_formatted', function (UserSiteLocation $model) {
                $tgl_kembali = Carbon::parse($model->tgl_kembali)->format('d F Y');
                $day_remaining = round(Carbon::parse($model->tgl_kembali)->diffInDays(Carbon::now()));

                if ($day_remaining > -7) {
                    return $tgl_kembali . ' (' . abs($day_remaining) . ' hari lagi)';
                }

                return $tgl_kembali;
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Site location', 'site_location')
                ->sortable()
                ->searchable(),
            Column::make('Tgl keberangkatan', 'tgl_keberangkatan_formatted', 'tgl_keberangkatan')
                ->sortable(),

            Column::make('Tgl kembali', 'tgl_kembali_formatted', 'tgl_kembali')
                ->sortable(),

            Column::action('Action'),
        ];
    }


    public function actionsFromView($data): View
    {
        $detailRoute = route('users.sites.detail', $data->id);

        return view('components.tableAction', [
            'data' => $data,
            'detailRoute' => $detailRoute,
            'detail' => true,
            'edit' => 'userSiteLocation',
            'delete' => true,
        ]);
    }



    public function destroy($id)
    {
        try {
            UserSiteLocation::findOrFail($id)->delete();
            Toaster::success('Data berhasil dihapus');
        } catch (\Throwable $th) {
            dd($th);
            Toaster::error('Data gagal dihapus');
        }
    }

    public function actionRules($row): array
    {
        return [
            Rule::rows()
                ->when(function ($row) {
                    $checkKeberangkatan = Carbon::parse($row->tgl_keberangkatan)->diffInDays(Carbon::now());
                    $checkKeberangkatan = abs($checkKeberangkatan);
                    $checkKembali = Carbon::parse($row->tgl_kembali)->diffInDays(Carbon::now());
                    $checkKembali = abs($checkKembali);

                    if ($checkKeberangkatan < 7 && $checkKembali < 7) {
                        if ($checkKeberangkatan < $checkKembali) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        if ($checkKeberangkatan < $checkKembali) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                })
                ->setAttribute('class', 'bg-red-200 hover:bg-red-400'),
            Rule::rows()
                ->when(function ($row) {
                    $checkKeberangkatan = Carbon::parse($row->tgl_keberangkatan)->diffInDays(Carbon::now());
                    $checkKeberangkatan = abs($checkKeberangkatan);
                    $checkKembali = Carbon::parse($row->tgl_kembali)->diffInDays(Carbon::now());
                    $checkKembali = abs($checkKembali);

                    if ($checkKeberangkatan < 7 && $checkKembali < 7) {
                        if ($checkKeberangkatan > $checkKembali) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                })
                ->setAttribute('class', 'bg-blue-200 hover:bg-blue-400'),
            Rule::rows()
                ->when(function ($row) {
                    $checkKeberangkatan = Carbon::parse($row->tgl_keberangkatan)->diffInDays(Carbon::now()) >= 7;
                    $checkKembali = Carbon::parse($row->tgl_kembali)->diffInDays(Carbon::now()) <= -7;

                    return $checkKeberangkatan && $checkKembali;
                })
                ->setAttribute('class', 'bg-gray-200 hover:bg-gray-400'),
        ];
    }
}
