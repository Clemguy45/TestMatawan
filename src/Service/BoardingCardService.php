<?php
namespace App\Service;

use App\Entity\BoardingCard;

class BoardingCardService
{
    /**
     * Private method to sort boarding cards by departure date and time
     * @param array $boardingCards
     * @return array
     */
    public function sort(array $boardingCards): array
    {
        usort($boardingCards, function($a, $b) {
            return $a->getDateDepart() <=> $b->getDateDepart();
        });

        return $boardingCards;
    }
}