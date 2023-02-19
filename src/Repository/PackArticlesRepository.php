<?php

namespace App\Repository;

use App\Entity\PackArticles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PackArticles>
 *
 * @method PackArticles|null find($id, $lockMode = null, $lockVersion = null)
 * @method PackArticles|null findOneBy(array $criteria, array $orderBy = null)
 * @method PackArticles[]    findAll()
 * @method PackArticles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PackArticles::class);
    }

    public function save(PackArticles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PackArticles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function findByArticleByQuantite($article, $quantite): ?array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.article = :article')
            ->andWhere(':quantity>=p.quantity')
            ->setParameter('article', $article->getId())
            ->setParameter('quantity', $quantite)
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return PackArticles[] Returns an array of PackArticles objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }


}
