<?php declare(strict_types=1);

/**
 * @var string $article_page
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
                        <a href="/article/<?= $article_metadata['id'] ?>"
                           hx-get="/article/<?= $article_metadata['id'] ?>"
                           hx-target="#main-article" hx-push-url="true">
							<?= $article_metadata['title'] ?>
                        </a>
                    </li>
				<?php endforeach; ?>
            </ul>
		<?php endif; ?>
    </aside>
	<?= $article_page ?>
</div>
