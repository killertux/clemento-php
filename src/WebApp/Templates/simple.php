<?php declare(strict_types=1);
/** @var ?string $body */
?>

<main class="mt-6 article">
	<?php if ($body === null) : ?>
        <p>Nothing to see here!!</p>
	<?php else: ?>
		<?= $body; ?>
	<?php endif; ?>
</main>
