<?php

namespace App\Livewire;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Garage;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class GarageTable extends DataTableComponent
{
    protected $model = Garage::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setFilterLayoutSlideDown();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Марка автомобиля", "car.name")
                ->searchable()
                ->sortable(),
            Column::make("Номер автомобиля", "car_number")
                ->searchable()
                ->sortable(),
            Column::make("Филиал", "branch.name")
                ->searchable()
                ->sortable(),
            Column::make("Дата", "created_at")
                ->searchable()
                ->sortable()
                ->format(fn($value) => $value->format('Y-m-d H:i:s')),
        ];
    }
    public function filters(): array
    {
        return [
            DateRangeFilter::make('Date range')
            ->config([
                'allowInput' => true,   // Allow manual input of dates
                'altFormat' => 'F j, Y', // Date format that will be displayed once selected
                'ariaDateFormat' => 'F j, Y', // An aria-friendly date format
                'dateFormat' => 'Y-m-d', // Date format that will be received by the filter
                // 'earliestDate' => '2020-01-01', // The earliest acceptable date
                // 'latestDate' => '2023-08-01', // The latest acceptable date
                'placeholder' => 'Enter Date Range', // A placeholder value
                'locale' => 'en',
            ])
            ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate']) // The values that will be displayed for the Min/Max Date Values
            ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
                $builder
                    ->whereDate('garage.created_at', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('garage.created_at', '<=', $dateRange['maxDate']); // maxDate is the end date selected
            }),

            SelectFilter::make('Branch')
                ->options([
                    '' => 'All',
                    // Branch::query()
                    //     ->orderBy('id')
                    //     ->get()
                    //     ->groupBy('name')
                    //     ->map(fn ($branch) => $branch->pluck('name', 'id')->filter())
                    //     ->toArray(),
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('branch.type', $value);
                }),
        ];
    }
}
