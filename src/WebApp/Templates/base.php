<?php declare(strict_types=1);

/**
 * @var string $body
 */

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Clemento</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Clemento, Clemente, Developer">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://unpkg.com/htmx.org@1.9.10"
            integrity="sha384-D1Kt99CQMDuVetoL1lrYwg5t+9QdHe7NLX/SoJYkXDFfX37iInKRy5xLSi8nO7UC"
            crossorigin="anonymous"></script>
</head>

<body class="font-jetBrains bg-zinc-100">
<header class="flex flex-col items-center m-4">
    <h1 class="text-5xl md:text-7xl font-bold">Clemento</h1>
    <nav>
        <ul class="flex flex-row text-md mt-2">
            <li class="px-3 hover:scale-[1.15] transition duration-150 ease-in-out"><a href="/" hx-get="/"
                                                                                       hx-target="main"
                                                                                       hx-push-url="true">Home</a>
            </li>
            <li class="px-3 hover:scale-[1.15] transition duration-150 ease-in-out"><a href="#">Projects</a></li>
            <li class="px-3 hover:scale-[1.15] transition duration-150 ease-in-out"><a href="/" hx-get="/about"
                                                                                       hx-target="main"
                                                                                       hx-push-url="true">About me</a>
            </li>
            <li class="px-3 hover:scale-[1.15] transition duration-150 ease-in-out"><a href="#">Contact</a></li>
        </ul>
    </nav>
    <hr class="h-px w-3/4 my-3 bg-zinc-500 border-0"/>
</header>
<main>
	<?= $body ?>
</main>
<footer>
    <p>&copy; 2024 &bull; Bruno Clemente</p>
</footer>
</body>
</html>
