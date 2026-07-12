<?php

declare(strict_types=1);

namespace Modules\Blog\Providers;

use Modules\Xot\Providers\XotBaseRouteServiceProvider;

/**
 * @SuppressWarnings("PHPMD.CamelCasePropertyName")
 */
class RouteServiceProvider extends XotBaseRouteServiceProvider
{
    public string $name = 'Blog';

    /**
     * The module namespace to assume when generating URLs to actions.
     */
    protected string $moduleNamespace = 'Modules\Blog\Http\Controllers';

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public function boot(): void
    {
        parent::boot();
    }

    public function register(): void
    {
        parent::register();
    }
}
