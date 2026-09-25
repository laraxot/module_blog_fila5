<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ProfileResource\Pages;

<<<<<<< HEAD
<<<<<<< HEAD
=======
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
>>>>>>> laraxot/dev
=======
>>>>>>> b591d4e (Lint)
use Filament\Tables\Columns\Column;
use Modules\Blog\Filament\Resources\ProfileResource;
use Modules\User\Filament\Resources\BaseProfileResource\Pages\ListProfiles as UserListProfiles;

class ListProfiles extends UserListProfiles
{
    protected static string $resource = ProfileResource::class;

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b591d4e (Lint)
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
<<<<<<< HEAD
=======
    /**
     * @return array<string, Column>
     */
    #[\Override]
>>>>>>> laraxot/dev
=======
>>>>>>> b591d4e (Lint)
    public function getTableColumns(): array
    {
        return parent::getTableColumns();
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Sovrascrive la visibilità per rispettare la signature della classe base.
     */
=======
     * @return array<int|string, Action|ActionGroup>
     */
    #[\Override]
>>>>>>> laraxot/dev
=======
     * Sovrascrive la visibilità per rispettare la signature della classe base.
     */
>>>>>>> b591d4e (Lint)
    public function getTableActions(): array
    {
        return parent::getTableActions();
    }
}
