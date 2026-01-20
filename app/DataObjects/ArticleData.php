<?php

declare(strict_types=1);

namespace Modules\Blog\DataObjects;

use DateTimeInterface;
use Illuminate\Support\Carbon;
use Modules\Blog\Enums\ArticleStatus;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class ArticleData extends Data
{
    public function __construct(
        #[WithCast(DateTimeInterfaceCast::class)]
        public readonly ?Carbon $bet_end_date = null,

        #[WithCast(DateTimeInterfaceCast::class)]
        public readonly ?Carbon $event_start_date = null,

        #[WithCast(DateTimeInterfaceCast::class)]
        public readonly ?Carbon $event_end_date = null,

        /** @var array<mixed> */
        public readonly array $category = [],

        public readonly string $title = '',
        public readonly string $slug = '',
        public readonly ArticleStatus $status = ArticleStatus::DRAFT,
        public readonly string $status_display = '',
        public readonly bool $is_wagerable = false,
        public readonly float $brier_score = 0.0,
        public readonly float $brier_score_play_money = 0.0,
        public readonly float $brier_score_real_money = 0.0,
        public readonly int $wagers_count = 0,
        public readonly int $wagers_count_canonical = 0,
        public readonly int $wagers_count_total = 0,

        /** @var array<mixed> */
        public readonly array $wagers = [],

        public readonly float $volume_play_money = 0.0,
        public readonly float $volume_real_money = 0.0,

        /** @var array<mixed> */
        public readonly array $outcomes = [],

        public readonly ?string $thumbnail_2x = null,
    ) {}

    /**
     * Create from array with type casting.
     *
     * @param  array<string,mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            bet_end_date: (isset($data['bet_end_date']) && (is_string($data['bet_end_date']) || $data['bet_end_date'] instanceof DateTimeInterface)) ? Carbon::parse($data['bet_end_date']) : null,
            event_start_date: (isset($data['event_start_date']) && (is_string($data['event_start_date']) || $data['event_start_date'] instanceof DateTimeInterface)) ? Carbon::parse($data['event_start_date']) : null,
            event_end_date: (isset($data['event_end_date']) && (is_string($data['event_end_date']) || $data['event_end_date'] instanceof DateTimeInterface)) ? Carbon::parse($data['event_end_date']) : null,
            category: is_array($data['category'] ?? null) ? (array) $data['category'] : [],
            title: is_string($data['title'] ?? null) ? $data['title'] : '',
            slug: is_string($data['slug'] ?? null) ? $data['slug'] : '',
            status: ArticleStatus::fromString(is_string($data['status'] ?? null) ? $data['status'] : 'draft'),
            status_display: is_string($data['status_display'] ?? null) ? $data['status_display'] : '',
            is_wagerable: (bool) ($data['is_wagerable'] ?? false),
            brier_score: is_numeric($data['brier_score'] ?? null) ? (float) $data['brier_score'] : 0.0,
            brier_score_play_money: is_numeric($data['brier_score_play_money'] ?? null) ? (float) $data['brier_score_play_money'] : 0.0,
            brier_score_real_money: is_numeric($data['brier_score_real_money'] ?? null) ? (float) $data['brier_score_real_money'] : 0.0,
            wagers_count: is_numeric($data['wagers_count'] ?? null) ? (int) $data['wagers_count'] : 0,
            wagers_count_canonical: is_numeric($data['wagers_count_canonical'] ?? null) ? (int) $data['wagers_count_canonical'] : 0,
            wagers_count_total: is_numeric($data['wagers_count_total'] ?? null) ? (int) $data['wagers_count_total'] : 0,
            wagers: is_array($data['wagers'] ?? null) ? (array) $data['wagers'] : [],
            volume_play_money: is_numeric($data['volume_play_money'] ?? null) ? (float) $data['volume_play_money'] : 0.0,
            volume_real_money: is_numeric($data['volume_real_money'] ?? null) ? (float) $data['volume_real_money'] : 0.0,
            outcomes: is_array($data['outcomes'] ?? null) ? (array) $data['outcomes'] : [],
            thumbnail_2x: is_string($data['thumbnail_2x'] ?? null) ? $data['thumbnail_2x'] : null,
        );
    }
}
