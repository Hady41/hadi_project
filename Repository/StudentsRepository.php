<?php

namespace App\Repository;

use App\Entity\Students;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use http\Env\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @method Students|null find($id, $lockMode = null, $lockVersion = null)
 * @method Students|null findOneBy(array $criteria, array $orderBy = null)

 * @method Students[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentsRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Students::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Students $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    #[Route('/findAllstudent/{id}',name:'findAllstudent')]
    public function findAllstudent(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM  students s
            ORDER BY s.$id ASC
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['student :' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    #[Route('/findAll',name: 'findAll' )]
    public function findAll(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u
            FROM App\Entity\Students p
           
            ORDER by id ASC'
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Students $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Students[] Returns an array of Students objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Students
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
