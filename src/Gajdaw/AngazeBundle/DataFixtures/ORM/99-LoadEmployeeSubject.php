<?php

namespace Gajdaw\AngazeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\AngazeBundle\Entity\EmployeeSubject;
use Symfony\Component\Yaml\Yaml;

class LoadEmployeeSubject implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'Data/employeesubject.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
            $employeesubject = new EmployeeSubject();
            $employeesubject->setName($item['name']);
            $manager->persist($employeesubject);
        }
        $manager->flush();

    }
}
