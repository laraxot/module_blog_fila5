<?php

declare(strict_types=1);

namespace Modules\Blog\Providers\Filament;

use Filament\Panel;
<<<<<<< HEAD
use LaraZeus\SpatieTranslatable\SpatieTranslatablePlugin;
=======
// use LaraZeus\SpatieTranslatable\SpatieTranslatablePlugin;
>>>>>>> laraxot/dev
use Modules\Xot\Providers\Filament\XotBasePanelProvider;

class AdminPanelProvider extends XotBasePanelProvider
{
    protected string $module = 'Blog';

    public function panel(Panel $panel): Panel
    {
        $panel->plugins([
            // FilamentPeekPlugin::make(),
<<<<<<< HEAD
            // Le risorse Article/Category usano Translatable (LocaleSwitcher): senza il plugin
            // "Plugin [spatie-translatable] is not registered for panel [blog::admin]".
            SpatieTranslatablePlugin::make()->defaultLocales(['it', 'en']),
=======
            // SpatieTranslatablePlugin::make(), // Temporarily disabled until lara-zeus package is working
>>>>>>> laraxot/dev
        ]);

        return parent::panel($panel);
    }
}
