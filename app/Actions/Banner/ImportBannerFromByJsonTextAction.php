<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Banner;

use Carbon\Carbon;
<<<<<<< HEAD
use Carbon\CarbonInterface;
=======
>>>>>>> laraxot/dev
use Modules\Blog\Models\Banner;
use Modules\Blog\Models\Category;

use function Safe\json_decode;

use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class ImportBannerFromByJsonTextAction
{
    use QueueableAction;

<<<<<<< HEAD
    public function execute(string $jsonText): void
    {
        Assert::isArray($json = json_decode($jsonText, true), '['.__LINE__.']['.__FILE__.']');

        foreach ($json as $item) {
            if (! is_array($item)) {
                continue;
            }

            $this->importBanner($item);
        }
    }

    /**
     * @param array<mixed> $item
     */
    private function importBanner(array $item): void
    {
        $category = $this->upsertCategory($item);
        $banner = $this->upsertBanner($item, $category);
        $this->attachBannerMedia($banner, $item);
    }

    /**
     * @param array<mixed> $item
     */
    private function upsertCategory(array $item): Category
    {
        /** @var array<mixed> $categoryDict */
        $categoryDict = $item['category_dict'] ?? [];

        $categoryData = [
            'title' => $categoryDict['title'] ?? '',
            'slug' => $categoryDict['slug'] ?? '',
        ];
        $categoryWhere = ['slug' => $categoryData['slug']];

        /** @var Category $category */
        $category = Category::firstOrCreate($categoryWhere, $categoryData);

        return $category;
    }

    /**
     * @param array<mixed> $item
     */
    private function upsertBanner(array $item, Category $category): Banner
    {
        $bannerWhere = [
            'title' => $item['title'] ?? null,
            'action_text' => $item['action_text'] ?? null,
        ];
        $bannerData = [
            'title' => $item['title'] ?? null,
            'description' => $item['short_description'] ?? null,
            'action_text' => $item['action_text'] ?? null,
            'link' => $item['link'] ?? null,
            'start_date' => $this->parseOptionalDate($item['start_date'] ?? ''),
            'end_date' => $this->parseOptionalDate($item['end_date'] ?? null),
            'hot_topic' => $item['hot_topic'] ?? null,
            'open_markets_count' => $item['open_markets_count'] ?? null,
            'landing_banner' => $item['landing_banner'] ?? null,
            'category_id' => $category->id,
        ];

        /** @var Banner $banner */
        $banner = Banner::firstOrCreate($bannerWhere, $bannerData);

        return $banner;
    }

    /**
     * @param array<mixed> $item
     */
    private function attachBannerMedia(Banner $banner, array $item): void
    {
        if (! isset($item['desktop_thumbnail']) || ! is_string($item['desktop_thumbnail'])) {
            return;
        }

        $banner->addMediaFromUrl($item['desktop_thumbnail'])
            ->toMediaCollection('banner');
    }

    private function parseOptionalDate(mixed $value): CarbonInterface|string|null
    {
        if (null === $value) {
            return null;
        }

        if (! \is_string($value) || mb_strlen($value) <= 3) {
            return \is_string($value) ? $value : null;
        }

        return Carbon::parse($value);
    }
=======
    public function execute(string $json_text): void
    {
        Assert::isArray($json = json_decode($json_text, true), '['.__LINE__.']['.__FILE__.']');

        foreach ($json as $j) {
            $start_date = (is_array($j) ? $j['start_date'] : null) ?? '';
            if (\is_string($start_date) && mb_strlen($start_date) > 3) {
                $start_date = Carbon::parse($start_date);
            }
            $end_date = (is_array($j) ? $j['end_date'] : null);
            if (\is_string($end_date) && mb_strlen($end_date) > 3) {
                $end_date = Carbon::parse($end_date);
            }

            $cd = (is_array($j) ? $j['category_dict'] : null) ?? [];

            $category_data = [
                'title' => (is_array($cd) ? $cd['title'] : null) ?? '',
                'slug' => (is_array($cd) ? $cd['slug'] : null) ?? '',
                // "in_leaderboard"=> $cd['in_leaderboard'],
                // "icon"=>$cd['icon'],
            ];
            $category_where = ['slug' => $category_data['slug']];
            $category = Category::firstOrCreate($category_where, $category_data);

            $banner_where = [
                'title' => (is_array($j) ? $j['title'] : null),
                'action_text' => (is_array($j) ? $j['action_text'] : null),
            ];
            $banner_data = [
                'title' => (is_array($j) ? $j['title'] : null),
                'description' => (is_array($j) ? $j['short_description'] : null),
                'action_text' => (is_array($j) ? $j['action_text'] : null),
                'link' => (is_array($j) ? $j['link'] : null),
                'start_date' => $start_date,
                'end_date' => $end_date,
                'hot_topic' => (is_array($j) ? $j['hot_topic'] : null),
                'open_markets_count' => (is_array($j) ? $j['open_markets_count'] : null),
                'landing_banner' => (is_array($j) ? $j['landing_banner'] : null),
                'category_id' => $category->id,
            ];

            $banner = Banner::firstOrCreate($banner_where, $banner_data);

            // Add media only if desktop_thumbnail exists and is valid
            if (is_array($j) && isset($j['desktop_thumbnail']) && is_string($j['desktop_thumbnail'])) {
                $banner->addMediaFromUrl($j['desktop_thumbnail'])
                    ->toMediaCollection('banner');
            }

            // $banner->addMediaFromUrl($j['desktop_thumbnail']);
        }
    }
>>>>>>> laraxot/dev
}
