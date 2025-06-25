<?php


namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findOrCreateFromGoogle(string $googleId, string $email, ?string $name): User
    {
        $user = $this->findOneBy(['googleId' => $googleId]);
        if (!$user) {
            $user = new User();
            $user->setGoogleId($googleId);
            $user->setEmail($email);
            $user->setName($name);
$this->getEntityManager()->persist($user);
       } else {
            $user->setName($name);
        }

$this->getEntityManager()->flush(); 
        return $user;
    }
}