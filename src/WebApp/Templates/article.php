<?php declare(strict_types=1);

/**
 * @var array $article
 * */
?>

<article class="w-3/4 mb-6" id="main-article">
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
