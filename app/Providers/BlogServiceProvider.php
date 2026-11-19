<?php

declare(strict_types=1);

namespace Modules\Blog\Providers;

<<<<<<< HEAD
use Modules\Blog\Actions\Article\ListPublishedArticlePathsAction;
use Modules\Seo\Contracts\SitemapPathsContract;
use Modules\Xot\Providers\XotBaseServiceProvider;

/**
 * @SuppressWarnings("PHPMD.CamelCasePropertyName")
 */
=======
use Modules\Xot\Providers\XotBaseServiceProvider;

>>>>>>> laraxot/dev
class BlogServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'Blog';

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public function boot(): void
    {
        parent::boot();
    }

    public function register(): void
    {
        parent::register();
<<<<<<< HEAD

        // Post ed eventi pubblicati entrano nella sitemap di Seo senza che Seo conosca Blog (DCP-273).
        $this->app->tag([ListPublishedArticlePathsAction::class], SitemapPathsContract::TAG);
=======
>>>>>>> laraxot/dev
    }
}
