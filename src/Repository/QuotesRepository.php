<?php

namespace App\Repository;

use App\Entity\Quotes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quotes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quotes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quotes[]    findAll()
 * @method Quotes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuotesRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Quotes::class);
    }

    public function hourlyPairQuotesForPeriod(string $pair, array $period) {

        $conn = $this->getEntityManager()->getConnection();

        $sql = "select symbol,
                        DATE_FORMAT(price_last_updated, '%Y-%m-%d %H') as hr,
                        1/min(btc_price) as min_price,
                        1/avg(btc_price) as avg_price,
                        1/max(btc_price) as max_price
                from quotes
                    where symbol = :symbol
                            and price_last_updated between :start and :end
                group by hr, symbol
                order by hr ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'symbol' => explode('-', $pair)[1],
            'start' => $period['start']->format('Y-m-d H:i:s'),
            'end' => $period['end']->format('Y-m-d H:i:s')
        ]);

        return $stmt->fetchAllAssociative();
    }

    // /**
    //  * @return Quotes[] Returns an array of Quotes objects
    //  */
    /*
      public function findByExampleField($value)
      {
      return $this->createQueryBuilder('q')
      ->andWhere('q.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('q.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult()
      ;
      }
     */

    /*
      public function findOneBySomeField($value): ?Quotes
      {
      return $this->createQueryBuilder('q')
      ->andWhere('q.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
