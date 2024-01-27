<?php declare(strict_types=1);

namespace Clemento\Domain\Article\Entities;

enum ArticleType
{

	case Regular;
	case About;
	case Projects;

}
