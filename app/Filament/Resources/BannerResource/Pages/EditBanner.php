<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\BannerResource\Pages;

use Filament\Actions\DeleteAction;
<<<<<<< HEAD
<<<<<<< .merge_file_Dsl2ra
=======
use Modules\Blog\Filament\Resources\BannerResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditBanner extends XotBaseEditRecord
=======
>>>>>>> .merge_file_tBiqlf
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\BannerResource;

class EditBanner extends EditRecord
<<<<<<< .merge_file_Dsl2ra
=======
use Modules\Blog\Filament\Resources\BannerResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditBanner extends XotBaseEditRecord
=======
>>>>>>> .merge_file_tBiqlf
>>>>>>> laraxot/dev
{
    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
<<<<<<< HEAD
<<<<<<< .merge_file_Dsl2ra
            DeleteAction::make(),
=======
            'delete' => DeleteAction::make(),
=======
            'delete' => DeleteAction::make(),
=======
            DeleteAction::make(),
>>>>>>> .merge_file_tBiqlf
>>>>>>> laraxot/dev
        ];
    }
}
