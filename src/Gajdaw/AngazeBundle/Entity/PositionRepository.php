<?php

namespace Gajdaw\AngazeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PositionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PositionRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }
}
