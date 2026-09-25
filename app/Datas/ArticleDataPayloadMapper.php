<?php

declare(strict_types=1);

namespace Modules\Blog\Datas;

final class ArticleDataPayloadMapper
{
    /**
<<<<<<< HEAD
     * @param array<string, mixed> $payload
=======
     * @param  array<string, mixed>  $payload
>>>>>>> laraxot/dev
     */
    public static function coreFromPayload(array $payload): ArticleDataCore
    {
        return new ArticleDataCore(
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_S2tDh4
            id: (string) ($payload['id'] ?? ''),
            uuid: (string) ($payload['uuid'] ?? ''),
            slug: (string) ($payload['slug'] ?? ''),
=======
            id: self::nullableString($payload, 'id') ?? '',
            uuid: self::nullableString($payload, 'uuid') ?? '',
            slug: self::nullableString($payload, 'slug') ?? '',
=======
            id: self::nullableString($payload, 'id') ?? '',
            uuid: self::nullableString($payload, 'uuid') ?? '',
            slug: self::nullableString($payload, 'slug') ?? '',
=======
            id: (string) ($payload['id'] ?? ''),
            uuid: (string) ($payload['uuid'] ?? ''),
            slug: (string) ($payload['slug'] ?? ''),
>>>>>>> .merge_file_oyeAxZ
>>>>>>> laraxot/dev
=======
            id: self::stringValue($payload, 'id'),
            uuid: self::stringValue($payload, 'uuid'),
            slug: self::stringValue($payload, 'slug'),
>>>>>>> laraxot/dev
            categoryId: self::nullableInt($payload, 'categoryId', 'category_id'),
            status: self::nullableString($payload, 'status'),
            showOnHomepage: (bool) ($payload['showOnHomepage'] ?? $payload['show_on_homepage'] ?? false),
            publishedAt: self::nullableString($payload, 'publishedAt', 'published_at'),
            url: self::nullableString($payload, 'url'),
            closedAt: self::nullableString($payload, 'closedAt', 'closed_at'),
        );
    }

    /**
<<<<<<< HEAD
     * @param array<string, mixed> $payload
=======
     * @param  array<string, mixed>  $payload
>>>>>>> laraxot/dev
     */
    public static function blocksFromPayload(array $payload): ArticleDataBlocks
    {
        return new ArticleDataBlocks(
            contentBlocks: self::nullableArray($payload, 'contentBlocks', 'content_blocks'),
            sidebarBlocks: self::nullableArray($payload, 'sidebarBlocks', 'sidebar_blocks'),
            footerBlocks: self::nullableArray($payload, 'footerBlocks', 'footer_blocks'),
        );
    }

    /**
<<<<<<< HEAD
     * @param array<string, mixed> $payload
     *
=======
     * @param  array<string, mixed>  $payload
>>>>>>> laraxot/dev
     * @return array<int|string, mixed>|string
     */
    public static function titleFromPayload(array $payload): array|string
    {
        $title = $payload['title'] ?? '';

        return is_array($title) || is_string($title) ? $title : '';
    }

    /**
<<<<<<< HEAD
     * @param array<string, mixed> $payload
     */
    private static function nullableInt(array $payload, string $primaryKey, string $fallbackKey): ?int
    {
<<<<<<< HEAD
<<<<<<< .merge_file_S2tDh4
=======
        if (is_int($payload[$primaryKey] ?? null)) {
            return $payload[$primaryKey];
        }

        if (is_int($payload[$fallbackKey] ?? null)) {
            return $payload[$fallbackKey];
=======
>>>>>>> .merge_file_oyeAxZ
        if (isset($payload[$primaryKey])) {
            return (int) $payload[$primaryKey];
        }

        if (isset($payload[$fallbackKey])) {
            return (int) $payload[$fallbackKey];
<<<<<<< .merge_file_S2tDh4
=======
        if (is_int($payload[$primaryKey] ?? null)) {
            return $payload[$primaryKey];
        }

        if (is_int($payload[$fallbackKey] ?? null)) {
            return $payload[$fallbackKey];
=======
>>>>>>> .merge_file_oyeAxZ
>>>>>>> laraxot/dev
=======
     * @param  array<string, mixed>  $payload
     */
    private static function stringValue(array $payload, string $primaryKey, ?string $fallbackKey = null): string
    {
        $value = $payload[$primaryKey] ?? null;
        if ($value === null && $fallbackKey !== null) {
            $value = $payload[$fallbackKey] ?? null;
        }

        if (is_string($value)) {
            return $value;
        }

        if (is_scalar($value)) {
            return (string) $value;
        }

        return '';
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private static function nullableInt(array $payload, string $primaryKey, string $fallbackKey): ?int
    {
        foreach ([$primaryKey, $fallbackKey] as $key) {
            if (! array_key_exists($key, $payload)) {
                continue;
            }

            $value = self::nullableIntValue($payload[$key]);
            if ($value !== null) {
                return $value;
            }
        }

        return null;
    }

    private static function nullableIntValue(mixed $value): ?int
    {
        if (is_int($value)) {
            return $value;
        }

        if (is_float($value)) {
            return is_finite($value) ? (int) $value : null;
        }

        if (is_string($value) && is_numeric($value)) {
            return (int) $value;
>>>>>>> laraxot/dev
        }

        return null;
    }

    /**
<<<<<<< HEAD
     * @param array<string, mixed> $payload
=======
     * @param  array<string, mixed>  $payload
>>>>>>> laraxot/dev
     */
    private static function nullableString(array $payload, string $primaryKey, ?string $fallbackKey = null): ?string
    {
        if (is_string($payload[$primaryKey] ?? null)) {
            return $payload[$primaryKey];
        }

<<<<<<< HEAD
        if (null !== $fallbackKey && is_string($payload[$fallbackKey] ?? null)) {
=======
        if ($fallbackKey !== null && is_string($payload[$fallbackKey] ?? null)) {
>>>>>>> laraxot/dev
            return $payload[$fallbackKey];
        }

        return null;
    }

    /**
<<<<<<< HEAD
     * @param array<string, mixed> $payload
     *
=======
     * @param  array<string, mixed>  $payload
>>>>>>> laraxot/dev
     * @return array<int|string, mixed>|null
     */
    private static function nullableArray(array $payload, string $primaryKey, string $fallbackKey): ?array
    {
        if (is_array($payload[$primaryKey] ?? null)) {
            return $payload[$primaryKey];
        }

        if (is_array($payload[$fallbackKey] ?? null)) {
            return $payload[$fallbackKey];
        }

        return null;
    }
}
