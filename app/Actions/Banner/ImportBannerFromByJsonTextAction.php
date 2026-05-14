<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Banner;

use Carbon\Carbon;
use Modules\Blog\Models\Banner;
use Modules\Blog\Models\Category;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

use function Safe\json_decode;

class ImportBannerFromByJsonTextAction
{
    use QueueableAction;

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
}
