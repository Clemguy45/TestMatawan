<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BoardingCardControllerTest extends WebTestCase
{
    public function testSortBoardingCardsList()
    {
        $client = static::createClient();

        // Créer des cartes d'embarquement de test
        $boardingCards = [
            [
                'typeTransport' => 'Train',
                'dateDepart' => '2024-03-27 08:00:00',
                'destination' => 'Barcelona',
                'lieuDepart' => 'Madrid Station',
                'porte' => null,
                'siege' => 'Seat 45B',
                'embarcation' => 'TGV123'
            ],
            [
                'typeTransport' => 'Bus',
                'dateDepart' => '2024-03-27 12:00:00',
                'destination' => 'Gerona',
                'lieuDepart' => 'Barcelona Bus Terminal',
                'porte' => null,
                'siege' => null,
                'embarcation' => 'Bus123'
            ],
            [
                'typeTransport' => 'Flight',
                'dateDepart' => '2024-03-27 14:00:00',
                'destination' => 'Stockholm',
                'lieuDepart' => 'Girona Airport',
                'porte' => 'Gate 45B',
                'siege' => 'Seat 3A',
                'embarcation' => 'SK455'
            ]
        ];

        // Afficher le tableau non trié
        echo "Tableau non trié : \n";
        var_dump($boardingCards);

        // Transformez les cartes en JSON pour les envoyer en tant que données de requête POST
        $jsonData = json_encode($boardingCards);

        // Envoyer une requête POST au contrôleur avec les données de cartes d'embarquement
        $client->request('POST', '/api/boarding-card/sort', [], [], [], $jsonData);

        // Vérifier si la réponse est réussie (code HTTP 200)
        $this->assertSame(200, $client->getResponse()->getStatusCode());

        // Vérifier si la réponse contient des données JSON
        $this->assertJson($client->getResponse()->getContent());

        // Convertir les données JSON en tableau
        $sortedBoardingCards = json_decode($client->getResponse()->getContent(), true);

        // Afficher le tableau trié
        echo "Tableau trié : \n";
        var_dump($sortedBoardingCards);

        // Vérifier si les cartes sont triées correctement
        $expectedOrder = ['Barcelona', 'Gerona', 'Stockholm'];
        $actualOrder = [];
        foreach ($sortedBoardingCards as $card) {
            $actualOrder[] = $card['destination'];
        }

        $this->assertEquals($expectedOrder, $actualOrder);
    }
}