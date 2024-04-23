<?php

namespace App\Livewire\DashboardCards;

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

final class PemberangkatankembaliTable extends PowerGridComponent
{
    use WithExport;

    public string $primaryKey = 'user_site_locations.id';
    public string $sortField = 'user_site_locations.id';

    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount()
                ->showPerPage(5, [5, 10, 15, 20, 25]),
        ];
    }

    public function datasource(): Builder
    {
        return UserSiteLocation::query()
            ->select('user_site_locations.id as id', 'profiles.nama as name', 'site_locations.name as site_location', 'tgl_keberangkatan', 'tgl_kembali')
            ->join('users', 'users.id', '=', 'user_site_locations.user_id')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->join('site_locations', 'site_locations.id', '=', 'user_site_locations.site_location_id')
            ->where(function ($query) {
                $query->where('tgl_keberangkatan', '>=', Carbon::now())
                    ->where('tgl_keberangkatan', '<=', Carbon::now()->addDays(7))
                    ->orWhere('tgl_kembali', '>=', Carbon::now())
                    ->where('tgl_kembali', '<=', Carbon::now()->addDays(7));
            });
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
            ->add('name')
            ->add('site_location')
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
                if (Carbon::parse($model->tgl_kembali)->diffInDays(Carbon::now()) > 0) {
                    $tgl_kembali = Carbon::parse($model->tgl_kembali)->format('d F Y');
                    return $tgl_kembali;
                } else {
                    $tgl_kembali = Carbon::parse($model->tgl_kembali)->format('d F Y');
                    $day_remaining = round(Carbon::parse($model->tgl_kembali)->diffInDays(Carbon::now()));
                    $day_remaining = abs($day_remaining);

                    return $tgl_kembali . ' (' . abs($day_remaining) . ' hari yang lagi)';
                }
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name'),
            Column::make('Site location', 'site_location'),
            Column::make('Tgl keberangkatan', 'tgl_keberangkatan_formatted', 'tgl_keberangkatan')
                ->sortable(),
            Column::make('Tgl kembali', 'tgl_kembali_formatted', 'tgl_kembali')
                ->sortable(),
        ];
    }

    // public function filters(): array
    // {
    //     return [
    //         Filter::inputText('tgl_keberangkatan_formatted', 'user_site_locations.tgl_keberangkatan'),
    //         Filter::inputText('tgl_kembali_formatted', 'user_site_locations.tgl_kembali'),
    //     ];
    // }

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
                    $checkKeberangkatan = Carbon::parse($row->tgl_kembali)->diffInDays(Carbon::now());
                    $checkKeberangkatan = abs($checkKeberangkatan);
                    $checkKembali = Carbon::parse($row->tgl_keberangkatan)->diffInDays(Carbon::now());
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
