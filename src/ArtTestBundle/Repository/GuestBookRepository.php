<?php

namespace ArtTestBundle\Repository;

use Doctrine\ORM\EntityRepository;

class GuestBookRepository extends EntityRepository
{
    public function removeRows($count)
    {
        $em = $this->getEntityManager();
        $rows = $em->createQuery('SELECT t FROM ArtTestBundle:GuestBook t')
            ->setMaxResults($count)
            ->setFirstResult(0)
            ->getResult();

        foreach ($rows as $row) {
            $em->remove($row);
        }

        $em->flush();
    }
}
