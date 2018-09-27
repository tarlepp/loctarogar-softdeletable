<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @param array|null $order
     *
     * @return array
     */
    public function findAllOrdered(?array $order): array
    {
        return $this->findBy([], $order);
    }

    /**
     * @param \App\Entity\Book $setName
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Book $setName): void
    {
        $em = $this->getEntityManager();
        $em->persist($setName);
        $em->flush();
    }

    /**
     * @param \App\Entity\Book $book
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Book $book): void
    {
        $em = $this->getEntityManager();
        $em->remove($book);
        $em->flush();
    }
}
