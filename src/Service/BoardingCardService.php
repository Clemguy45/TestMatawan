<?php
namespace App\Service;

use App\Entity\BoardingCard;

class BoardingCardService
{
    /**
     * Méthode privée pour trier les cartes d'embarquement par date et heure de départ
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