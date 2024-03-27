<?php

namespace App\Controller;

use App\Entity\BoardingCard;
use App\Service\BoardingCardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class BoardingCardController extends AbstractController
{
    private BoardingCardService $boardingCardService;

    public function __construct(BoardingCardService $boardingCardService)
    {
        $this->boardingCardService = $boardingCardService;
    }

    #[Route('/api/boarding-card/sort', name: 'app_boarding_card', methods: ['POST'])]
    public function sortBordingCard(Request $request): JsonResponse
    {
        // Nos données récupérées au format JSON envoyé par la requête
        $data = json_decode($request->getContent(), true);

        // notre fonction de trie basée sur la date de départ
        $sortedBoardingCards = $this->boardingCardService->sort($data);

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
        return new JsonResponse($sortedBoardingCardsData);
    }
}
