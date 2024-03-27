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
        // Data retrieved in JSON format sent by the request
        $data = json_decode($request->getContent(), true);

        // Sorting function based on the departure date
        $sortedBoardingCards = $this->boardingCardService->sort($data);

        // Converting sorted data to JSON version
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

        // Return the sorted list of boarding cards as a JSON response
        return new JsonResponse($sortedBoardingCardsData);
    }
}
