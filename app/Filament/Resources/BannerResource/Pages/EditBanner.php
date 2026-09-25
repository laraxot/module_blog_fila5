<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\BannerResource\Pages;

use Filament\Actions\DeleteAction;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_Dsl2ra
=======
use Modules\Blog\Filament\Resources\BannerResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditBanner extends XotBaseEditRecord
=======
>>>>>>> .merge_file_tBiqlf
=======
>>>>>>> laraxot/dev
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\BannerResource;

class EditBanner extends EditRecord
<<<<<<< HEAD
<<<<<<< .merge_file_Dsl2ra
=======
use Modules\Blog\Filament\Resources\BannerResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditBanner extends XotBaseEditRecord
=======
>>>>>>> .merge_file_tBiqlf
>>>>>>> laraxot/dev
=======
>>>>>>> laraxot/dev
{
    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
<<<<<<< HEAD
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
=======
            DeleteAction::make(),
>>>>>>> laraxot/dev
        ];
    }
}
