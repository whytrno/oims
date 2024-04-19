<?php

namespace App\Livewire\Tables;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
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

final class UserTable extends PowerGridComponent
{
    use WithExport;

    public string $primaryKey = 'users.id';
    public string $sortField = 'users.id';

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
        return User::query()->join('profiles', 'users.id', '=', 'profiles.user_id');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        $fields = PowerGrid::fields();

        if (auth()->user()->hasRole('admin')) {
            $fields->add('email');
            $fields->add('password', fn (User $model) => Crypt::decryptString($model->password));
            // $fields->add('password');
        }

        $fields->add('foto', function (User $model) {

            return view('components.avatar', [
                'src' => $model->profile->foto,
                'fallback' => $model->profile->nama
            ]);
        });
        $fields->add('nama', fn (User $model) => $model->profile->nama);
        $fields->add('nik', fn (User $model) => $model->profile->nik);
        $fields->add('lokasi_site', function (User $model) {
            $route = route('users.show', $model->id);
            return <<<HTML
            <a href="$route" wire:navigate class="text-sm border-b-2 border-dotted border-gray-300 hover:border-gray-700 transition-all">Lokasi Site</a>
            HTML;
        });

        return $fields;
    }

    public function columns(): array
    {
        $columns = [];

        if (auth()->user()->hasRole('admin')) {
            $columns[] = Column::make('Email', 'email')
                ->sortable()
                ->searchable();
            $columns[] = Column::make('Password', 'password');
        }

        $columns[] = Column::make('Foto', 'foto');
        $columns[] = Column::make('Nama', 'nama')
            ->sortable()
            ->searchable();
        $columns[] = Column::make('NIK', 'nik')
            ->sortable()
            ->searchable();
        $columns[] = Column::make('Lokasi Site', 'lokasi_site');
        $columns[] = Column::action('Action');

        return $columns;
    }

    public function filters(): array
    {
        return [];
    }

    public function actionsFromView($data): View
    {
        $detailRoute = route('users.show', $data->id);

        return view('components.tableAction', [
            'data' => $data,
            'detailRoute' => $detailRoute,
            'detail' => true,
            'delete' => true,
        ]);
    }

    public function destroy($id)
    {
        try {
            $data = User::find($id);
            $data->delete();

            Toaster::success('Delete successfully');
        } catch (\Throwable $th) {
            Toaster::error('Delete failed');
        }
    }
}
