<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ProfileResource\Pages;

<<<<<<< HEAD
<<<<<<< .merge_file_CjcMqs
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
=======
=======
=======
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
>>>>>>> .merge_file_VF0FsT
>>>>>>> laraxot/dev
use Filament\Tables\Columns\Column;
use Modules\Blog\Filament\Resources\ProfileResource;
use Modules\User\Filament\Resources\BaseProfileResource\Pages\ListProfiles as UserListProfiles;

class ListProfiles extends UserListProfiles
{
    protected static string $resource = ProfileResource::class;

<<<<<<< HEAD
<<<<<<< .merge_file_CjcMqs
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
=======
>>>>>>> .merge_file_VF0FsT
    /**
     * @return array<string, Column>
     */
    #[\Override]
<<<<<<< .merge_file_CjcMqs
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
=======
>>>>>>> .merge_file_VF0FsT
>>>>>>> laraxot/dev
    public function getTableColumns(): array
    {
        return parent::getTableColumns();
    }

    /**
<<<<<<< HEAD
<<<<<<< .merge_file_CjcMqs
     * @return array<int|string, Action|ActionGroup>
     */
    #[\Override]
=======
     * Sovrascrive la visibilità per rispettare la signature della classe base.
     */
=======
     * Sovrascrive la visibilità per rispettare la signature della classe base.
     */
=======
     * @return array<int|string, Action|ActionGroup>
     */
    #[\Override]
>>>>>>> .merge_file_VF0FsT
>>>>>>> laraxot/dev
    public function getTableActions(): array
    {
        return parent::getTableActions();
    }
}
