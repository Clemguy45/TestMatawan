<?php
namespace App\test\Service;

use App\Entity\BoardingCard;
use App\Service\BoardingCardService;
use PHPUnit\Framework\TestCase;

class BoardingCardServiceTest extends TestCase
{
    public function testSort()
    {
        // Create boarding cards with different departure times
        $boardingCard1 = new BoardingCard();
        $boardingCard1->setDateDepart(new \DateTime('2024-03-28 10:00:00'));

        $boardingCard2 = new BoardingCard();
        $boardingCard2->setDateDepart(new \DateTime('2024-03-28 12:00:00'));

        $boardingCard3 = new BoardingCard();
        $boardingCard3->setDateDepart(new \DateTime('2024-03-28 09:00:00'));

        $unsortedBoardingCards = [$boardingCard1, $boardingCard2, $boardingCard3];

        // Define the expected order of sorted boarding cards based on departure time
        $expectedSortedBoardingCards = [$boardingCard3, $boardingCard1, $boardingCard2];

        // Create an instance of the boarding card service
        $boardingCardSorter = new BoardingCardService();
        
        // Sort the unsorted boarding cards
        $sortedBoardingCards = $boardingCardSorter->sort($unsortedBoardingCards);

        // Check if the sorted boarding cards match the expected order
        $this->assertEquals($expectedSortedBoardingCards, $sortedBoardingCards);
    }

    public function testConvertToDataArray()
    {
        // Create fake boarding cards
        $boardingCard1 = new BoardingCard();
        $boardingCard1->setTypeTransport('Train');
        $boardingCard1->setLieuDepart('Paris');
        $boardingCard1->setDestination('London');
        $boardingCard1->setEmbarcation('TGV');
        $boardingCard1->setDateDepart(new \DateTime('2024-04-01 10:00:00'));
        $boardingCard1->setPorte('A');
        $boardingCard1->setSiege('12A');

        $boardingCard2 = new BoardingCard();
        $boardingCard2->setTypeTransport('Flight');
        $boardingCard2->setLieuDepart('London');
        $boardingCard2->setDestination('New York');
        $boardingCard2->setEmbarcation('BA123');
        $boardingCard2->setDateDepart(new \DateTime('2024-04-02 08:00:00'));
        $boardingCard2->setPorte('B');
        $boardingCard2->setSiege('24F');

        $boardingCard3 = new BoardingCard();
        $boardingCard3->setTypeTransport('Bus');
        $boardingCard3->setLieuDepart('New York');
        $boardingCard3->setDestination('Los Angeles');
        $boardingCard3->setEmbarcation('Greyhound');
        $boardingCard3->setDateDepart(new \DateTime('2024-04-03 12:00:00'));

        // Create an array of unsorted boarding cards
        $unsortedBoardingCards = [$boardingCard1, $boardingCard2, $boardingCard3];

        // Create a BoardingCardService instance
        $boardingCardService = new BoardingCardService();

        // Call convertToDataArray method with unsorted boarding cards
        $sortedBoardingCardsData = $boardingCardService->convertToDataArray($unsortedBoardingCards);

        // Define expected data
        $expectedData = [
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
                'dateDepart' => '2024-04-03 12:00:00',
                'porte' => null,
                'siege' => null
            ]
        ];

        // Check if the returned data matches the expected data
        $this->assertEquals($expectedData, $sortedBoardingCardsData);
    }
}
