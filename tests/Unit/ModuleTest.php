<?php
namespace Modules\Blog\Tests\Unit;

use Modules\Blog\Tests\TestCase;
use Modules\Blog\Models\ArticleCategory;

it('has main model class', function () {
    expect(class_exists(ArticleCategory::class))->toBeTrue();
});
