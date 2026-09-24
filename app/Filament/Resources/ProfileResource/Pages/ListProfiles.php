<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ProfileResource\Pages;

<<<<<<< HEAD
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
=======
>>>>>>> laraxot/dev
use Filament\Tables\Columns\Column;
use Modules\Blog\Filament\Resources\ProfileResource;
use Modules\User\Filament\Resources\BaseProfileResource\Pages\ListProfiles as UserListProfiles;

class ListProfiles extends UserListProfiles
{
    protected static string $resource = ProfileResource::class;

<<<<<<< HEAD
    /**
     * @return array<string, Column>
     */
    #[\Override]
=======
    // protected function getHeaderActions(): array
    // {
    //    return [
    //        Actions\CreateAction::make(),
    //    ];
    // }
    /**
     * Get table columns.
     *
     * @return array<string, Column>
     */
>>>>>>> laraxot/dev
    public function getTableColumns(): array
    {
        return parent::getTableColumns();
    }

    /**
<<<<<<< HEAD
     * @return array<int|string, Action|ActionGroup>
     */
    #[\Override]
=======
     * Sovrascrive la visibilità per rispettare la signature della classe base.
     */
>>>>>>> laraxot/dev
    public function getTableActions(): array
    {
        return parent::getTableActions();
    }
}
