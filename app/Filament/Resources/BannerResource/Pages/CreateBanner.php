<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\BannerResource\Pages;

<<<<<<< HEAD
<<<<<<< .merge_file_lvWDBN
=======
use Modules\Blog\Filament\Resources\BannerResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateBanner extends XotBaseCreateRecord
=======
>>>>>>> .merge_file_8Mx18X
use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\BannerResource;

class CreateBanner extends CreateRecord
<<<<<<< .merge_file_lvWDBN
=======
use Modules\Blog\Filament\Resources\BannerResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateBanner extends XotBaseCreateRecord
=======
>>>>>>> .merge_file_8Mx18X
>>>>>>> laraxot/dev
{
    protected static string $resource = BannerResource::class;
}
