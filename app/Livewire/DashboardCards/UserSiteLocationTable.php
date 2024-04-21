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
            ->join('users', 'users.id', '=', 'user_site_locations.user_id')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->join('site_locations', 'site_locations.id', '=', 'user_site_locations.site_location_id');
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
            ->add('site_location', fn (UserSiteLocation $model) => $model->siteLocation->name);
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name', 'profiles.nama')
                ->sortable()
                ->searchable(),
            Column::make('Site location', 'site_location', 'site_locations.name')
                ->sortable()
                ->searchable(),
        ];
    }
}
