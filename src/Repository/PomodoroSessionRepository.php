<?php

namespace App\Repository;

use App\Entity\PomodoroSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PomodoroSession>
 *
 * @method PomodoroSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method PomodoroSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method PomodoroSession[]    findAll()
 * @method PomodoroSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PomodoroSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PomodoroSession::class);
    }
}
