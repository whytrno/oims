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

final class UserSiteLocationCountTable extends PowerGridComponent
{
    use WithExport;

    public string $primaryKey = 'user_site_locations.id';
    public string $sortField = 'site_locations.name';

    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return UserSiteLocation::query()
            ->select('site_locations.name as nama')
            ->selectRaw('count(user_site_locations.user_id) as user_count')
            ->join('site_locations', 'user_site_locations.site_location_id', '=', 'site_locations.id')
            ->groupBy('site_locations.name');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('nama')
            ->add('user_count');
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title('Nama')
                ->field('nama')
                ->searchable()
                ->sortable(),
            Column::add()
                ->title('Jumlah User')
                ->field('user_count')
                ->searchable()
                ->sortable(),
        ];
    }

    public function relationSearch(): array
    {
        return [
            'siteLocation' => 'name'
        ];
    }
}
