<?php

namespace Gajdaw\AngazeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmployeeControllerTest extends WebTestCase
{
    public function testUrlIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/employee/');
       // $this->assertEquals(1, $crawler->filter('td:contains("Janek")')->count(), 'Missing element td:contains("Janek")');
       // $this->assertEquals(1, $crawler->filter('td:contains("Anna")')->count(), 'Missing element td:contains("Anna")');
       // $this->assertEquals(1, $crawler->filter('td:contains("Marek")')->count(), 'Missing element td:contains("Marek")');

        //rekordy sparsowane ze strony WWW
        //do tablicy $rekordy
        $rekordy = array();
        $crawler = $crawler->filter('table.records_list > tbody > tr > td:nth-child(2)');
        foreach ($crawler as $domElement) {
            $rekordy[] = $domElement->nodeValue;
        }

        //wyniki, które znamy
        //na podstawie pliku yaml
        $expected = array(
            'Janek',
            'Anna',
            'Marek',
        );
        $this->assertEquals($expected, $rekordy, 'Rekordy: employee');

    }

    /*
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/employee/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /employee/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'gajdaw_angazebundle_employeetype[field_name]'  => 'Test',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Edit')->form(array(
            'gajdaw_angazebundle_employeetype[field_name]'  => 'Foo',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }

    */
}