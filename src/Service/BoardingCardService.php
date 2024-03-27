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

    /**
     * Convert sorted boarding cards to an array of data
     * @param array $sortedBoardingCards
     * @return array
     */
    public function convertToDataArray(array $sortedBoardingCards): array
    {
        $sortedBoardingCardsData = [];
        foreach ($sortedBoardingCards as $sortedBoardingCard) {
            $sortedBoardingCardsData[] = [
                'typeTransport' => $sortedBoardingCard->getTypeTransport(),
                'lieuDepart' => $sortedBoardingCard->getLieuDepart(),
                'destination' => $sortedBoardingCard->getDestination(),
                'embarcation' => $sortedBoardingCard->getEmbarcation(),
                'dateDepart' => $sortedBoardingCard->getDateDepart()->format('Y-m-d H:i:s'),
                'porte' => $sortedBoardingCard->getPorte(),
                'siege' => $sortedBoardingCard->getSiege()
            ];
        }
        
        return $sortedBoardingCardsData;
    }
}