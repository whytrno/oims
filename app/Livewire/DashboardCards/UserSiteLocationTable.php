<?php

namespace App\Livewire\DashboardCards;

use App\Models\UserSiteLocation;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class UserSiteLocationTable extends PowerGridComponent
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
        return UserSiteLocation::query()->orderBy('id', 'desc');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('name', fn (UserSiteLocation $model) => $model->user->profile->nama)
            ->add('site_location', fn (UserSiteLocation $model) => $model->siteLocation->name);
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name'),
            Column::make('Site location', 'site_location'),
        ];
    }
}
