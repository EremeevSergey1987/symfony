<?php

namespace App\Twig;

use Carbon\Carbon;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AgoExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('ago', [$this, 'getDiff']),
        ];
    }

    public function getDiff($value)
    {
        //dd((new Carbon($comments[0]['createdAt']))->locale('ru')->diffForHumans());
        return Carbon::make($value)->locale('ru')->diffForHumans();
    }
}
