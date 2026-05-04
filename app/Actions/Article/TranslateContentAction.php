<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Modules\Blog\Models\Article;
use Modules\Xot\Actions\GetModelByModelTypeAction;
use Modules\Xot\Actions\GetModelClassByModelTypeAction;

use function Safe\json_encode;

use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class TranslateContentAction
{
    use QueueableAction;

    /**
     * Esegue la traduzione dei contenuti di un articolo.
     *
     * @param list<string>        $locales
     * @param array<string,mixed> $data
     * @param class-string        $class
     */
    public function execute(string $model_class, string $article_id, array $locales, array $data, string $class): void
    {
        // dddx([app(GetModelClassByModelTypeAction::class)->execute($model_class), Article::class]);
        // dddx(app($class));
        $model = app(GetModelByModelTypeAction::class)->execute($model_class, $article_id);
        Assert::isInstanceOf($model, $class, '['.__LINE__.']['.__FILE__.']');
        /** @var Article $model */

        /** @var array $model_contents */
        $model_contents = $model->toArray();
        Assert::isArray($model_contents, '['.__LINE__.']['.__FILE__.']');

        if ($data['content_blocks'] ?? false) {
            /** @var array $model_content */
            $model_content = $model_contents['content_blocks'];

            // per ora do per scontato che la traduzione italiana esista
            foreach ($locales as $locale) {
                if (! isset($model_content[$locale])) {
                    $model_content[$locale] = $model_content['it'] ?? '';
                }
            }
            $model->content_blocks = json_encode($model_content, JSON_THROW_ON_ERROR);
        }

        if ($data['sidebar_blocks'] ?? false) {
            /** @var array $model_content */
            $model_content = $model_contents['sidebar_blocks'];

            // per ora do per scontato che la traduzione italiana esista
            foreach ($locales as $locale) {
                if (! isset($model_content[$locale])) {
                    $model_content[$locale] = $model_content['it'] ?? [];
                }
            }
            $model->sidebar_blocks = $model_content;
        }

        if ($data['footer_blocks'] ?? false) {
            /** @var array $model_content */
            $model_content = $model_contents['footer_blocks'];

            // per ora do per scontato che la traduzione italiana esista
            foreach ($locales as $locale) {
                if (! isset($model_content[$locale])) {
                    $model_content[$locale] = $model_content['it'] ?? [];
                }
            }
            $model->footer_blocks = $model_content;
        }

        $model->update();
    }
}
