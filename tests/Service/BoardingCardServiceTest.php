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
}
