<?php

namespace App\Repository;

use App\Entity\ApiResponse;
use DateMalformedStringException;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApiResponse>
 */
class ApiResponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApiResponse::class);
    }

    public function create(ApiResponse $apiResponse): ApiResponse
    {
        $em = $this->getEntityManager();
        $em->persist($apiResponse);
        $em->flush();
        return $apiResponse;
    }

    /**
     * @throws DateMalformedStringException
     */
    public function findNearByDateAndCityName(string $cityName): ?ApiResponse
    {
        $qb = $this->createQueryBuilder('w');
        return $this->createQueryBuilder('a')
            ->andWhere('a.cityName = :cityName')
            ->andWhere($qb->expr()->gte('a.datetime', ':dateTime'))
            ->setParameter('cityName', $cityName)
            ->setParameter('dateTime', (new DateTime())->modify('-1 hour'))
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
