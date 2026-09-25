<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\BannerResource\Pages;

<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Blog\Filament\Resources\BannerResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateBanner extends XotBaseCreateRecord
=======
=======
>>>>>>> b591d4e (Lint)
use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\BannerResource;

class CreateBanner extends CreateRecord
<<<<<<< HEAD
>>>>>>> laraxot/dev
=======
>>>>>>> b591d4e (Lint)
{
    protected static string $resource = BannerResource::class;
}
