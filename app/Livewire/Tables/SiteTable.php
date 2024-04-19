<?php

namespace App\Livewire\Tables;

use App\Models\SiteLocation;
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
use Illuminate\View\View;
use Masmerise\Toaster\Toaster;

final class SiteTable extends PowerGridComponent
{
    use WithExport;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

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
        return SiteLocation::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('name');
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function actionsFromView($data): View
    {
        return view('components.tableAction', [
            'data' => $data,
            'delete' => true
        ]);
    }

    public function destroy($id)
    {
        try {
            $data = SiteLocation::findOrFail($id);
            $data->delete();

            Toaster::success('Delete successfully');
        } catch (\Throwable $th) {
            dd($th);
            Toaster::error('Delete failed');
        }
    }
}
