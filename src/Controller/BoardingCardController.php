<?php

namespace App\Controller;

use App\Entity\BoardingCard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class BoardingCardController extends AbstractController
{
    #[Route('/api/boarding-card/sort', name: 'app_boarding_card', methods: ['POST'])]
    public function sortBordingCard(Request $request): JsonResponse
    {
        // Nos données récupérées au format JSON envoyé par la requête
        $data = json_decode($request->getContent(), true);

        //Notre tableau de carte de transport non triée et vide
        $boardingCards = [];

        //intégration des données dans le tableau vide
        foreach ($data as $cardData){
            $boardingCard = new BoardingCard();
            $boardingCard->setTypeTransport($cardData['typeTransport']);
            $boardingCard->setLieuDepart($cardData['lieuDepart']);
            $boardingCard->setDestination($cardData['destination']);
            $boardingCard->setEmbarcation($cardData['embarcation']);
            $boardingCard->setDateDepart(new \DateTime($cardData['dateDepart']));
            $boardingCard->setPorte($cardData['porte'] ?? null);
            $boardingCard->setSiege($cardData['siege'] ?? null);

            $boardingCards[] = $boardingCard; // Ajouter la carte au tableau
        }

        // notre fonction de trie basée sur la date de départ
        $sortedBoardingCards = $this->sortBoardingCardsList($boardingCards);

        // Convertion des données triées vers une version JSON
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

        // Retourner la liste triée de cartes d'embarquement sous forme de réponse JSON
        return $this->json($sortedBoardingCardsData);
    }

    /**
     * Méthode privée pour trier les cartes d'embarquement par date et heure de départ
     * @param array $boardingCards
     * @return array
     */
    private function sortBoardingCardsList(array $boardingCards): array
    {
        usort($boardingCards, function($a, $b) {
            return $a->getDateDepart() <=> $b->getDateDepart();
        });

        return $boardingCards;
    }
}
