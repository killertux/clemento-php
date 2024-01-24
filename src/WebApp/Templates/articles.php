<?php declare(strict_types=1);

/**
 * @var string $title
 * @var string $author
 * @var string $created_at
 * @var string $updated_at
 * @var string $body
 * @var array $articles_metadata
 */
?>
<div class="flex flex-col-reverse items-stretch justify-stretch w-10/12 mt-5 lg:flex-row">
    <aside class="lg:w-1/4">
        <h1 class="text-xl font-bold text-left">List of Articles</h1>
        <ul class="list-disc p-4">
			<?php foreach ($articles_metadata as $article_metadata) : ?>
                <li class="transition duration-100 ease-in-out hover:underline hover:scale-105">
                    <a href="/article/<?= $article_metadata['id'] ?>"
                       hx-get="/article/<?= $article_metadata['id'] ?>"
                       hx-target="#body-main"
                       hx-push-url="true"> <?= $article_metadata['title'] ?></a>
                </li>
			<?php endforeach; ?>
        </ul>
    </aside>
    <article class="w-3/4 mb-6">
        <header>
            <h1 class="text-3xl font-bold text-left"><?= $title ?></h1>
            <div class="py-2 text-left text-sm text-zinc-500">
                <div>
                    Created at
                    <time datetime="<?= $created_at ?>" pubdate="pubdate">
						<?= $created_at ?>
                    </time>
                </div>
                <div>
                    Updated at
                    <time datetime="<?= $updated_at ?>"><?= $updated_at ?></time>
                </div>
                <address>
                    By <?= $author ?>
                </address>
            </div>
        </header>
        <main class="mt-6 article">
            My article body with a lot of stuff
        </main>
    </article>
</div>
