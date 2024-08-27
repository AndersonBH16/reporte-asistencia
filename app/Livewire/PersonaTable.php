<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Persona;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PersonaTable extends DataTableComponent
{
    protected $model = Persona::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setSingleSortingDisabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->setFilterLayoutSlideDown()
            ->setLoadingPlaceholderBlade('');
        ;
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "idpers")
                ->sortable()
                ->searchable(),
            Column::make("Apellidos", "apellidos")
                ->sortable()
                ->searchable(),
            Column::make("Nombres", "nombres")
                ->sortable()
                ->searchable(),
            Column::make("Cargo", "cargo")
                ->sortable()
                ->searchable(),
            Column::make("Plaza", "plaza")
                ->sortable()
                ->searchable(),
            Column::make("Condición", "usuarios.condicion")
                ->sortable()
                ->searchable(),
            Column::make("Unidad", "usuarios.unidad.unidad")
                ->sortable()
                ->searchable(),
            Column::make("Local", "usuarios.unidad.local.descripcion")
                ->sortable()
                ->searchable(),
        ];
    }

    public function builder(): Builder
    {
        return Persona::query()
            ->with(['usuarios.unidad.local']);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('E-mail Verified', 'email_verified_at')
                ->setFilterPillTitle('Verified')
                ->options([
                    ''    => 'Any',
                    'yes' => 'Yes',
                    'no'  => 'No',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value === 'yes') {
                        $builder->whereNotNull('email_verified_at');
                    } elseif ($value === 'no') {
                        $builder->whereNull('email_verified_at');
                    }
                }),

            DateFilter::make('Verified From')
                ->config([
                    'min' => '2020-01-01',
                    'max' => '2021-12-31',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('email_verified_at', '>=', $value);
                }),

            DateFilter::make('Verified To')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('email_verified_at', '<=', $value);
                }),
        ];
    }
}
