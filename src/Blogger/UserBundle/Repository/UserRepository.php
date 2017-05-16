<?php

namespace Blogger\UserBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Description of UserRepository
 *
 * @author Админ
 */
class UserRepository extends EntityRepository implements UserLoaderInterface {
    
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
