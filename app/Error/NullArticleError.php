<?php

declare(strict_types=1);

namespace Modules\Blog\Error;

use DomainException;

class NullArticleError extends DomainException
{
    public function __construct(string $articleId)
    {
        parent::__construct("The article <fg=yellow>{$articleId}</> is null");
    }
}
