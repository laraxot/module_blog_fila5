<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Modules\Blog\Database\Factories\ArticleFactory;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;
use Modules\Comment\Database\Factories\CommentFactory;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        // Categorie per la demo
        $categories = [
            ['name' => 'Servizi', 'description' => 'Servizi comunali'],
            ['name' => 'Cultura', 'description' => 'Eventi culturali'],
            ['name' => 'Ambiente', 'description' => 'Ambiente e sostenibilità'],
            ['name' => 'Eventi', 'description' => 'Eventi e iniziative'],
        ];
        foreach ($categories as $cat) {
            $id = (string) Str::uuid();
            Category::firstOrCreate(
                ['id' => $id],
                ['name' => $cat['name'], 'description' => $cat['description'], 'icon' => '', 'is_active' => 1, 'sort_order' => 0]
            );
        }
        // Articoli realistici — demo per investitore (post + eventi)
        $items = [
            [
                'title' => 'Nuova piazza pedonale in centro storico',
                'content_type' => 'post',
                'slug' => 'nuova-piazza-pedonale-centro-storico',
                'excerpt' => 'Il Comune ha approvato il progetto di riqualificazione della piazza centrale con aree pedonali, panchine e illuminazione sostenibile.',
                'content' => "<h2>Il progetto</h2><p>La piazza centrale sarà riqualificata con un nuovo pavimento in pietra locale, aree pedonali estese e panchine realizzate con materiali riciclati. L'intervento prevede anche una nuova illuminazione LED a basso consumo.</p><p>Il cantiere inizierà a marzo 2026 e si concluderà entro la fine dell'anno.</p>",
                'is_featured' => true,
                'show_on_homepage' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Festa della Cultura 2026 — programma completo',
                'content_type' => 'event',
                'slug' => 'festa-cultura-2026',
                'excerpt' => 'Dal 15 al 18 maggio, eventi culturali, mostre, concerti e laboratori per tutte le età in piazza e nei luoghi d\'interesse.',
                'content' => "<h2>Programma</h2><p>Venerdì 15 maggio: inaugurazione con concerto della banda comunale. Sabato 16: mostre d'arte contemporanea. Domenica 17: laboratori per bambini. Lunedì 18: conferenza sul patrimonio locale.</p>",
                'is_featured' => true,
                'show_on_homepage' => true,
                'published_at' => now()->subDays(5),
                'event_start_date' => now()->addDays(30)->format('Y-m-d'),
                'event_end_date' => now()->addDays(33)->format('Y-m-d'),
            ],
            [
                'title' => 'Restauro della fontana monumentale del XVII secolo',
                'content_type' => 'post',
                'slug' => 'restauro-fontana-monumentale',
                'excerpt' => 'Sono iniziati i lavori di restauro della fontana del XVII secolo dopo un attento studio archeologico.',
                'content' => '<h2>Il restauro</h2><p>La fontana monumentale, simbolo del territorio, verrà restaurata con tecniche tradizionali. Il progetto è stato approvato dalla Soprintendenza.</p>',
                'is_featured' => false,
                'show_on_homepage' => false,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Mercato contadino del sabato — apertura estiva',
                'content_type' => 'event',
                'slug' => 'mercato-contadino-sabato-estate',
                'excerpt' => 'Ogni sabato mattina i produttori locali propongono prodotti freschi, formaggi, miele e pane artigianale.',
                'content' => '<h2>Quando</h2><p>Dal primo maggio al 30 settembre, ogni sabato dalle 8:00 alle 13:00 in piazza del mercato.</p>',
                'is_featured' => false,
                'show_on_homepage' => false,
                'published_at' => now()->subDays(3),
                'event_start_date' => now()->addDays(7)->format('Y-m-d'),
            ],
            [
                'title' => 'Nuovi servizi digitali per i cittadini',
                'content_type' => 'post',
                'slug' => 'nuovi-servizi-digitali-cittadini',
                'excerpt' => 'È stato aggiornato il portale comunale per accedere ai servizi in modo semplice, sicuro e accessibile (WCAG 2.1 AA).',
                'content' => '<h2>Servizi aggiornati</h2><p>Il portale ora include la richiesta di permessi, la segnalazione problemi, il pagamento TARI e la prenotazione appuntamenti.</p>',
                'is_featured' => true,
                'show_on_homepage' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Concerto all\'aperto — Orchestra Comunale',
                'content_type' => 'event',
                'slug' => 'concerto-orchestra-comunale',
                'excerpt' => 'Una serata speciale con l\'Orchestra Comunale in un programma dedicato ai classici della musica italiana.',
                'content' => '<h2>Programma</h2><p>Brani di Verdi, Puccini e musiche tradizionali. Ingresso libero su prenotazione.</p>',
                'is_featured' => false,
                'show_on_homepage' => false,
                'published_at' => now()->subDays(1),
                'event_start_date' => now()->addDays(14)->format('Y-m-d'),
            ],
            [
                'title' => 'Gli uffici comunali chiudono per festività',
                'content_type' => 'post',
                'slug' => 'uffici-comunali-chiudono-festivita',
                'excerpt' => 'Informazioni su orari e chiusure per le festività nazionali e locali del mese.',
                'content' => '<h2>Orari</h2><p>Gli uffici resteranno chiusi dal 25 al 27 aprile. I servizi digitali restano attivi 24/7.</p>',
                'is_featured' => false,
                'show_on_homepage' => false,
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'Corsi di educazione ambientale per le scuole',
                'content_type' => 'post',
                'slug' => 'corsi-educazione-ambientale-scuole',
                'excerpt' => 'Il Comune offre percorsi didattici gratuiti sulle energie rinnovabili, la raccolta differenziata e la biodiversità.',
                'content' => '<h2>Per le scuole</h2><p>Destinatari: classi della scuola primaria e secondaria. Prenotazione tramite il portale.</p>',
                'is_featured' => false,
                'show_on_homepage' => false,
                'published_at' => now()->subDays(6),
            ],
        ];

        $created = 0;
        foreach ($items as $item) {
            $article = ArticleFactory::new()->createOne([
                'title' => $item['title'],
                'slug' => $item['slug'],
                'content_type' => $item['content_type'],
                'excerpt' => $item['excerpt'],
                'content' => $item['content'],
                'is_featured' => $item['is_featured'],
                'show_on_homepage' => $item['show_on_homepage'],
                'published_at' => $item['published_at'],
                'event_start_date' => $item['event_start_date'] ?? null,
                'event_end_date' => $item['event_end_date'] ?? null,
            ]);

            // Immagine principale se disponibile (simulato con URL placeholder reale)
            $article->addMediaFromString('<svg xmlns="http://www.w3.org/2000/svg" width="800" height="400"><rect width="800" height="400" fill="#0ea5e9"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="sans-serif" font-size="24" fill="white">'.addslashes($item['title']).'</text></svg>')
                ->usingName($item['slug'].'.svg')
                ->toMediaCollection('main_image');

            $created++;
        }

        // Commenti realistici (3 per articolo in evidenza)
        $featuredIds = Article::where('is_featured', true)->pluck('id')->all();
        $comments = [
            'Ottima iniziativa, finalmente un segnale concreto per il centro storico.',
            'Parteciperemo alla Festa della Cultura con la nostra famiglia.',
            'Speriamo che i lavori della fontana rispettino i tempi previsti.',
            'I servizi digitali sono molto utili, grazie alla trasparenza.',
            'Il mercato contadino è un punto di riferimento per la città.',
        ];
        foreach ($featuredIds as $index => $id) {
            if (isset($comments[$index])) {
                CommentFactory::new()->create([
                    'comment' => $comments[$index],
                    'article_id' => $id,
                    'author_id' => null,
                    'created_at' => now()->subHours($index * 2),
                ]);
            }
        }

        if ($this->command instanceof Command) {
            $this->command->info("DemoContentSeeder: $created articoli creati con immagini, categorie, commenti e contenuto HTML realistico.");
        }
    }
}
