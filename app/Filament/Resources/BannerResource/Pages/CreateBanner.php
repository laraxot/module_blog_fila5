<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\BannerResource\Pages;

<<<<<<< HEAD
use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\BannerResource;

class CreateBanner extends CreateRecord
=======
use Modules\Blog\Filament\Resources\BannerResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateBanner extends XotBaseCreateRecord
>>>>>>> laraxot/dev
{
    protected static string $resource = BannerResource::class;
}
