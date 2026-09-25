<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\BannerResource\Pages;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_lvWDBN
=======
use Modules\Blog\Filament\Resources\BannerResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateBanner extends XotBaseCreateRecord
=======
>>>>>>> .merge_file_8Mx18X
=======
>>>>>>> laraxot/dev
use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\BannerResource;

class CreateBanner extends CreateRecord
<<<<<<< HEAD
<<<<<<< .merge_file_lvWDBN
=======
use Modules\Blog\Filament\Resources\BannerResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateBanner extends XotBaseCreateRecord
=======
>>>>>>> .merge_file_8Mx18X
>>>>>>> laraxot/dev
=======
>>>>>>> laraxot/dev
{
    protected static string $resource = BannerResource::class;
}
