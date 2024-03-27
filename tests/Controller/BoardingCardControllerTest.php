<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Controller\BoardingCardController;
use App\Entity\BoardingCard;
use App\Service\BoardingCardService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class BoardingCardControllerTest extends WebTestCase
{
    public function testSortBoardingCardsList()
    {
        // Créez un mock pour le service BoardingCardService
        $boardingCardServiceMock = $this->createMock(BoardingCardService::class);
        
        // Créez une instance de votre contrôleur en injectant le mock du service
        $controller = new BoardingCardController($boardingCardServiceMock);
        
        // Créez une requête avec des données JSON
        $requestData = [
            [
                'typeTransport' => 'Train',
                'lieuDepart' => 'Paris',
                'destination' => 'London',
                'embarcation' => 'TGV',
                'dateDepart' => '2024-04-01 10:00:00',
                'porte' => 'A',
                'siege' => '12A'
            ],
            [
                'typeTransport' => 'Flight',
                'lieuDepart' => 'London',
                'destination' => 'New York',
                'embarcation' => 'BA123',
                'dateDepart' => '2024-04-02 08:00:00',
                'porte' => 'B',
                'siege' => '24F'
            ],
            [
                'typeTransport' => 'Bus',
                'lieuDepart' => 'New York',
                'destination' => 'Los Angeles',
                'embarcation' => 'Greyhound',
                'dateDepart' => '2024-04-03 12:00:00'
            ]
        ];
        $request = new Request([], [], [], [], [], [], json_encode($requestData));
        
        // Appelez la méthode à tester sur le contrôleur avec la demande
        $response = $controller->sortBordingCard($request);
        
        // Vérifiez que la réponse est une JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}