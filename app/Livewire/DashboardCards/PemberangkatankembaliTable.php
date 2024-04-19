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
            ->where('tgl_keberangkatan', '<', Carbon::now())
            ->where('tgl_kembali', '>', Carbon::now())
            ->orderBy('id', 'desc');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('name', fn (UserSiteLocation $model) => $model->user->profile->nama)
            ->add('site_location', fn (UserSiteLocation $model) => $model->siteLocation->name)
            ->add('tgl_keberangkatan_formatted', fn (UserSiteLocation $model) => Carbon::parse($model->tgl_keberangkatan)->format('d F Y'))
            ->add('tgl_kembali_formatted', fn (UserSiteLocation $model) => Carbon::parse($model->tgl_kembali)->format('d F Y'));
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

    public function actionRules($row): array
    {
        return [
            Rule::rows()
                ->when(function ($row) {
                    return Carbon::parse($row->tgl_keberangkatan)->diffInDays(Carbon::now()) <= 7;
                })
                ->setAttribute('class', 'bg-blue-200 hover:bg-blue-400'),
            Rule::rows()
                ->when(function ($row) {
                    return Carbon::parse($row->tgl_kembali)->diffInDays(Carbon::now()) >= -7;
                })
                ->setAttribute('class', 'bg-red-200 hover:bg-red-400'),
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
