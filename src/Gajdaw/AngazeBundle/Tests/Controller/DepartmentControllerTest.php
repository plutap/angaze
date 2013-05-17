<?php

namespace Gajdaw\AngazeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DepartmentControllerTest extends WebTestCase
{

    public function testUrlIndex()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/department/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /department/");

        // Check data in the show view
        $this->assertEquals(1, $crawler->filter('td:contains("Szydełkowania")')->count(), 'Missing element td:contains("Szydełkowania")');
        $this->assertEquals(1, $crawler->filter('td:contains("Prędkości pojazdów")')->count(), 'Missing element td:contains("Prędkości pojazdów")');
        $this->assertEquals(1, $crawler->filter('td:contains("Ubijania masła")')->count(), 'Missing element td:contains("Ubijania masła")');
    }

    /*
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'gajdaw_angazebundle_departmenttype[field_name]'  => 'Test',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();



        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Edit')->form(array(
            'gajdaw_angazebundle_departmenttype[field_name]'  => 'Foo',
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