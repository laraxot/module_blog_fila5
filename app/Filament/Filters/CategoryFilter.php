<?php

declare(strict_types=1);

/**
 * @see https://coderflex.com/blog/create-advanced-filters-with-filament
 */

namespace Modules\Blog\Filament\Filters;

<<<<<<< HEAD
use Modules\Xot\Filament\Tables\Filters\XotBaseSelectFilter;

class CategoryFilter extends XotBaseSelectFilter
=======
use Filament\Tables\Filters\SelectFilter;

class CategoryFilter extends SelectFilter
>>>>>>> laraxot/dev
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->label('Filter By Category');
        $this->placeholder('Select a category to filter');
        $this->relationship('categories', 'title');
    }

    public static function getDefaultName(): ?string
    {
        return 'category';
    }
}
