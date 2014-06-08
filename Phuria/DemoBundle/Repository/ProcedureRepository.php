<?php
namespace Phuria\DemoBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProcedureRepository extends EntityRepository
{
    public function findNameLike($name)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
           ->add('select', 'p')
           ->add('from', 'PhuriaDemoBundle:Procedure p')
           ->add('where', $qb->expr()->like('p.name', $qb->expr()->literal($name . '%')));
        return $qb->getQuery()->execute();
    }
    
    public function findIn($ids)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
           ->add('select', 'p')
           ->add('from', 'PhuriaDemoBundle:Procedure p')
           ->add('where', $qb->expr()->in('p.id', $ids));
        return $qb->getQuery()->execute();
    }
}

?>
