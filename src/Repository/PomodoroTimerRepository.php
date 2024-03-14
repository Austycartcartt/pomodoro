<?php

namespace App\Repository;

use App\Entity\PomodoroTimer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PomodoroTimer>
 *
 * @method PomodoroTimer|null find($id, $lockMode = null, $lockVersion = null)
 * @method PomodoroTimer|null findOneBy(array $criteria, array $orderBy = null)
 * @method PomodoroTimer[]    findAll()
 * @method PomodoroTimer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PomodoroTimerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PomodoroTimer::class);
    }
}
