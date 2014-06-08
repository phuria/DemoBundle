<?php
namespace Phuria\DemoBundle\Repository;

use Doctrine\ORM\EntityRepository;

class DoctorRepository extends EntityRepository
{
    public function findIn($ids)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
           ->add('select', 'd')
           ->add('from', 'PhuriaDemoBundle:Doctor d')
           ->add('where', $qb->expr()->in('d.id', $ids));
        return $qb->getQuery()->execute();
    }
}

?>
