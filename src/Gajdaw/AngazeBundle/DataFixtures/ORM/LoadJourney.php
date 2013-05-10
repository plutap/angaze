<?php

namespace Gajdaw\AngazeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\AngazeBundle\Entity\Journey;
use Symfony\Component\Yaml\Yaml;

class LoadJourney implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'Data/journey.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
            $journey = new Journey();
            $journey->setName($item['name']);
            $manager->persist($journey);
        }
        $manager->flush();

    }
}
