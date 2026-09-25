<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Widgets;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_RI6zZr
use Filament\Widgets\ChartWidget;

class SampleChartWidget extends ChartWidget
=======
use Modules\Xot\Filament\Widgets\XotBaseChartWidget;

class SampleChartWidget extends XotBaseChartWidget
=======
use Modules\Xot\Filament\Widgets\XotBaseChartWidget;

class SampleChartWidget extends XotBaseChartWidget
=======
use Filament\Widgets\ChartWidget;

class SampleChartWidget extends ChartWidget
>>>>>>> .merge_file_BUYx7g
>>>>>>> laraxot/dev
=======
use Modules\Xot\Filament\Widgets\XotBaseChartWidget;

class SampleChartWidget extends XotBaseChartWidget
>>>>>>> laraxot/dev
{
    protected ?string $heading = 'Blog Posts';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
