<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ArticleResource\Schemas;

use Filament\Schemas\Components\Component as SchemaComponent;
use Modules\Xot\Filament\Resources\Schemas\XotBaseResourceForm;

class ArticleForm extends XotBaseResourceForm
{
    /**
     * @return array<int|string, SchemaComponent>
     */
<<<<<<< HEAD
<<<<<<< .merge_file_CNHw6W
    public static function getFormSchema(): array
=======
    public function getFormSchema(): array
=======
    public function getFormSchema(): array
=======
    public static function getFormSchema(): array
>>>>>>> .merge_file_Awz7si
>>>>>>> laraxot/dev
    {
        return ArticleFormSchema::build();
    }
}
