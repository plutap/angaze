<?php

namespace Gajdaw\AngazeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\AngazeBundle\Entity\Course;
use Symfony\Component\Yaml\Yaml;

class Load09Course implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'Data/course.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {

            $CourseType = $manager
                ->getRepository('GajdawAngazeBundle:CourseType')
                ->findOneByName($item['typ']);
            if (!$CourseType) {
                throw new \RuntimeException('Course blad:' . $item['name']);
            }

            $course = new Course();
            $course->setName($item['name']);
            $course->setCourseType($CourseType);
            $manager->persist($course);
        }
        $manager->flush();

    }
}
