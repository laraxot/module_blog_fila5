<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Blog\Database\Factories\ArticleFactory;
use Modules\Comment\Database\Factories\CommentFactory;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        // Articoli realistici per il blog (post e eventi)
        ArticleFactory::new()
            ->count(5)
            ->sequence(
                ['title' => 'Nuova piazza pedonale in centro storico', 'content_type' => 'post', 'content' => 'Il Comune ha approvato il progetto di riqualificazione della piazza centrale con aree pedonali e panchine.'],
                ['title' => 'Evento: Festa della Cultura 2026', 'content_type' => 'event', 'content' => 'Dal 15 al 18 maggio, eventi culturali, mostre e concerti in piazza.'],
                ['title' => 'Restauro della fontana monumentale', 'content_type' => 'post', 'content' => 'Sono iniziati i lavori di restauro della fontana del XVII secolo.'],
                ['title' => 'Mercato contadino del sabato', 'content_type' => 'event', 'content' => 'Ogni sabato mattina i produttori locali propongono prodotti freschi.'],
                ['title' => 'Nuovi servizi digitali per i cittadini', 'content_type' => 'post', 'content' => 'È stato aggiornato il portale per accedere ai servizi comunali in modo semplice e sicuro.'],
            )
            ->create();

        // Commenti realistici sui post
        CommentFactory::new()
            ->count(3)
            ->sequence(
                ['comment' => 'Ottima notizia, aspettavamo da anni!', 'author_id' => null],
                ['comment' => 'Spero che i lavori finiscano in tempo per l\'estate.', 'author_id' => null],
                ['comment' => 'Grazie per l\'informazione, parteciperemo alla festa.', 'author_id' => null],
            )
            ->create();
    }
}
