<?php

declare(strict_types=1);

namespace Modules\Blog\Enums;

enum ArticleStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
    case PENDING = 'pending';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Bozza',
            self::PUBLISHED => 'Pubblicato',
            self::ARCHIVED => 'Archiviato',
            self::PENDING => 'In attesa',
        };
    }

    public static function fromString(string $value): self
    {
        return match ($value) {
            'draft' => self::DRAFT,
            'published' => self::PUBLISHED,
            'archived' => self::ARCHIVED,
            'pending' => self::PENDING,
            default => throw new \InvalidArgumentException("Invalid status: {$value}"),
        };
    }
}
