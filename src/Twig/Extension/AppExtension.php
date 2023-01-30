<?php

namespace App\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('itemOrder', [$this, 'getItemOrder'])
        ];
    }

    public function getItemOrder(int $order, int $itemId, array $existingQuestions): int
    {
        $defaultOrder = array_search($itemId, $existingQuestions);

        return $defaultOrder ? $defaultOrder : $order;
    }
}
