<?php

namespace Gajdaw\AngazeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\AngazeBundle\Entity\Employee;
use Symfony\Component\Yaml\Yaml;

class LoadEmployee implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'Data/employee.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {

            $Position = $manager
                ->getRepository('GajdawAngazeBundle:Position')
                ->findOneByName($item['stanowisko']);
            if (!$Position) {
                throw new \RuntimeException('Position blad:' . $item['surname']);
            }

            $Room = $manager
                ->getRepository('GajdawAngazeBundle:Room')
                ->findOneByName($item['pokoj']);
            if (!$Room) {
                throw new \RuntimeException('Room blad:' . $item['surname']);
            }

            $employee = new Employee();
            $employee->setName($item['name']);
            $employee->setSurname($item['surname']);
            $manager->persist($employee);
        }
        $manager->flush();

    }
}
