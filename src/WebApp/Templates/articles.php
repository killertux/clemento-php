<?php declare(strict_types=1);

/**
 * @var array $article
 * @var array $articles_metadata
 */
?>
<div class="flex flex-col-reverse items-stretch justify-stretch w-10/12 mt-5 lg:flex-row">
    <aside class="lg:w-1/4">
        <h1 class="text-xl font-bold text-left">List of Articles</h1>
        <?php if (empty($articles_metadata)): ?>
            <p class="text-lg mt-2">No articles found</p>
        <?php else: ?>
            <ul class="list-disc p-4">
                <?php foreach ($articles_metadata as $article_metadata): ?>
                    <li class="transition duration-100 ease-in-out hover:underline hover:scale-105">
                        <a href="/article/<?= $article_metadata['id'] ?>" hx-get="/article/<?= $article_metadata['id'] ?>"
                            hx-target="#body-main" hx-push-url="true">
                            <?= $article_metadata['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </aside>
    <article class="w-3/4 mb-6">
        <?php if (empty($article)): ?>
            <p class="text-lg mt-2">No article found!</p>
        <?php else: ?>
            <header>
                <h1 class="text-3xl font-bold text-left">
                    <?= $article['title'] ?>
                </h1>
                <div class="py-2 text-left text-sm text-zinc-500">
                    <div>
                        Created at
                        <time datetime="<?= $article['created_at'] ?>" pubdate="pubdate">
                            <?= $article['created_at'] ?>
                        </time>
                    </div>
                    <div>
                        Updated at
                        <time datetime="<?= $article['updated_at'] ?>">
                            <?= $article['updated_at'] ?>
                        </time>
                    </div>
                    <address>
                        By
                        <?= $article['author'] ?>
                    </address>
                </div>
            </header>
            <main class="mt-6 article">
                <?= $article['body'] ?>
            </main>
        <?php endif; ?>
    </article>
</div>