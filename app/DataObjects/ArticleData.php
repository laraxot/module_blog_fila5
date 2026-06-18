<?php

declare(strict_types=1);

namespace Modules\Blog\DataObjects;

use Illuminate\Support\Carbon;
use Modules\Blog\Enums\ArticleStatus;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class ArticleData extends Data
{
    public function __construct(
        #[WithCast(DateTimeInterfaceCast::class)]
        public readonly ?Carbon $betEndDate = null,
        #[WithCast(DateTimeInterfaceCast::class)]
        public readonly ?Carbon $eventStartDate = null,
        #[WithCast(DateTimeInterfaceCast::class)]
        public readonly ?Carbon $eventEndDate = null,

        /** @var array<mixed> */
        public readonly array $category = [],
        public readonly string $title = '',
        public readonly string $slug = '',
        public readonly ArticleStatus $status = ArticleStatus::DRAFT,
        public readonly string $statusDisplay = '',
        public readonly bool $isWagerable = false,
        public readonly float $brierScore = 0.0,
        public readonly float $brierScorePlayMoney = 0.0,
        public readonly float $brierScoreRealMoney = 0.0,
        public readonly int $wagersCount = 0,
        public readonly int $wagersCountCanonical = 0,
        public readonly int $wagersCountTotal = 0,

        /** @var array<mixed> */
        public readonly array $wagers = [],
        public readonly float $volumePlayMoney = 0.0,
        public readonly float $volumeRealMoney = 0.0,

        /** @var array<mixed> */
        public readonly array $outcomes = [],
        public readonly ?string $thumbnail2x = null,
    ) {
    }

    /**
     * Create from array with type casting.
     *
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            betEndDate: isset($data['bet_end_date']) && (is_string($data['bet_end_date']) || $data['bet_end_date'] instanceof \DateTimeInterface) ? Carbon::parse($data['bet_end_date']) : null,
            eventStartDate: isset($data['event_start_date']) && (is_string($data['event_start_date']) || $data['event_start_date'] instanceof \DateTimeInterface) ? Carbon::parse($data['event_start_date']) : null,
            eventEndDate: isset($data['event_end_date']) && (is_string($data['event_end_date']) || $data['event_end_date'] instanceof \DateTimeInterface) ? Carbon::parse($data['event_end_date']) : null,
            category: is_array($data['category'] ?? null) ? (array) $data['category'] : [],
            title: is_string($data['title'] ?? null) ? $data['title'] : '',
            slug: is_string($data['slug'] ?? null) ? $data['slug'] : '',
            status: ArticleStatus::fromString(is_string($data['status'] ?? null) ? $data['status'] : 'draft'),
            statusDisplay: is_string($data['status_display'] ?? null) ? $data['status_display'] : '',
            isWagerable: (bool) ($data['is_wagerable'] ?? false),
            brierScore: is_numeric($data['brier_score'] ?? null) ? (float) $data['brier_score'] : 0.0,
            brierScorePlayMoney: is_numeric($data['brier_score_play_money'] ?? null) ? (float) $data['brier_score_play_money'] : 0.0,
            brierScoreRealMoney: is_numeric($data['brier_score_real_money'] ?? null) ? (float) $data['brier_score_real_money'] : 0.0,
            wagersCount: is_numeric($data['wagers_count'] ?? null) ? (int) $data['wagers_count'] : 0,
            wagersCountCanonical: is_numeric($data['wagers_count_canonical'] ?? null) ? (int) $data['wagers_count_canonical'] : 0,
            wagersCountTotal: is_numeric($data['wagers_count_total'] ?? null) ? (int) $data['wagers_count_total'] : 0,
            wagers: is_array($data['wagers'] ?? null) ? (array) $data['wagers'] : [],
            volumePlayMoney: is_numeric($data['volume_play_money'] ?? null) ? (float) $data['volume_play_money'] : 0.0,
            volumeRealMoney: is_numeric($data['volume_real_money'] ?? null) ? (float) $data['volume_real_money'] : 0.0,
            outcomes: is_array($data['outcomes'] ?? null) ? (array) $data['outcomes'] : [],
            thumbnail2x: is_string($data['thumbnail_2x'] ?? null) ? $data['thumbnail_2x'] : null,
        );
    }
}
