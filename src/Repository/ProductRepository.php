<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;


use Doctrine\ORM\Query\ResultSetMapping;

use App\Utils\ProductListFilter;


/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Product $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Product $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function getCommentsCountByRating(Product $entity, int $rating)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT COUNT(*) FROM product p
            JOIN comment c ON c.product_id = p.id
            WHERE p.id = :p_id AND c.rating = :rating
        ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['p_id' => $entity->getId(), 'rating' => $rating]);

        return $resultSet->fetchAllAssociative()[0]['COUNT(*)'];
    }

    public function getAllCategories(Product $entity)
    {
        $categories = array();
        $category = $entity->getCategory();
        do {
            array_push($categories, $category);
            $category = $category->getParent();
        } while ($category !== null);


        return array_reverse($categories);
    }



    public function getRecentProductsByCategories(array $categories, $offset = 0, $limit = 1) : array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Product p
            WHERE p.category IN (:cat)
            ORDER BY p.created DESC
            '
        )
            ->setParameter('cat', $categories)
            ->setFirstResult($offset)
            ->setMaxResults($limit);
        // returns an array of Product objects
        return $query->getResult();
    }

    public function getRecentProducts($offset, $limit = 1) : array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Product p
            ORDER BY p.created DESC
            '
        )
            ->setFirstResult($offset)
            ->setMaxResults($limit);
        // returns an array of Product objects
        return $query->getResult();
    }

    private function getRandomProductIdsByCategoryIds(array $category_ids, $limit = 1) : array
    {
        $conn = $this->getEntityManager()->getConnection();
        $cids = implode(',',$category_ids);

        $sql = '
            (SELECT p.id FROM product p
            JOIN category c ON p.category_id = c.id
            WHERE c.id IN (' . $cids . ')
            ORDER BY RAND()) LIMIT ' . $limit;

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        $set = $resultSet->fetchAllAssociative();
        $product_ids = array();

        foreach($set as $id)
        {
            array_push($product_ids, $id['id']);
        }
        return $product_ids;
    }

    public function getRandomProductsByCategoryIds(array $category_ids, $limit = 1) : array
    {
        $product_ids = $this->getRandomProductIdsByCategoryIds($category_ids, $limit);

        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Product p
            WHERE p.id IN (:ids)
            '
        )
            ->setParameter('ids', $product_ids);

        return $query->getResult();
    }

    public function getRandomProducts($limit = 1) : array
    {
        $entityManager = $this->getEntityManager();

        $conn = $entityManager->getConnection();

        $sql = '(SELECT p.id FROM product p ORDER BY RAND()) LIMIT ' . $limit;
        $stmt = $conn->prepare($sql);

        $resultSet = $stmt->executeQuery();
        $set = $resultSet->fetchAllAssociative();

        $product_ids = array();

        foreach($set as $id)
        {
            array_push($product_ids, $id['id']);
        }

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Product p
            WHERE p.id IN (:ids)
            '
        )
            ->setParameter('ids', $product_ids);

        return $query->getResult();

    }

    public function getProductsByCategories(array $categories, $offset = 0 ,$limit = 1, array $options = [])
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQueryBuilder('p')
            ->select('p')
            ->from('App\Entity\Product', 'p')
            ->where('p.category IN (:cat)')
            ->setParameter('cat', $categories)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $this->applyFilters($query, $options);
        // $this->applyFilters($query, [
        //     'order' => 'High price',
        //     'priceMin' => '300',
        //     'priceMax' => '200000',
        // ]);

        // returns an array of Product objects
        return $query->getQuery()->getResult();
    }

    public function getAllByCategories(array $categories, $offset = 0 ,$limit = 1, array $options = [])
    {
        $entityManager = $this->getEntityManager();
        $builder = $entityManager->createQueryBuilder('p')
            ->select('p')
            ->from('App\Entity\Product', 'p')
            ->where('p.category IN (:cat)')
            ->setParameter('cat', $categories)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        ProductListFilter::applyFilters($builder, $options);

        // returns an array of Product objects
        return $builder->getQuery()->getResult();
    }

    public function getAll(int $offset, int $limit, array $options = [])
    {
        $entityManager = $this->getEntityManager();

        $builder = $this->createQueryBuilder('p')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        ProductListFilter::applyFilters($builder, $options);

        return $builder->getQuery()->getResult();
    }

    public function getCountOfAllProducts(array $options)
    {
        $builder = $this->createQueryBuilder('p')
            ->select('count(p.id)');

        ProductListFilter::applyFilters($builder, $options);

        return $builder->getQuery()->getSingleScalarResult();
    }

    public function getCountOfProductsByCategoryIds(array $ids, array $options)
    {
        $builder = $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->where('p.category IN (:ids)')
            ->setParameter('ids', $ids);

        ProductListFilter::applyFilters($builder, $options);

        return $builder->getQuery()->getSingleScalarResult();
    }


    public function getAvgRating(Product $product)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT AVG(c.rating) FROM App\Entity\Comment c
            WHERE c.product = (:product)'
        )
            ->setParameter('product', $product);

        return $query->getSingleScalarResult();
    }


    public function search($query, $offset, $limit, $options)
    {
        $builder = $this->createQueryBuilder('p')
            ->where('p.name LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        ProductListFilter::applyFilters($builder, $options);

        return $builder->getQuery()->getResult();
    }

    public function searchCount($query, $options)
    {
        $builder = $this->createQueryBuilder('p')
            ->select('count(p)')
            ->where('p.name LIKE :query')
            ->setParameter('query', '%' . $query . '%');

        ProductListFilter::applyFilters($builder, $options);

        return $builder->getQuery()->getSingleScalarResult();
    }

    public function searchByCategoryIds($query, $ids ,$offset, $limit, $options)
    {
        $builder = $this->createQueryBuilder('p')
            ->where('p.name LIKE :query')
            ->andWhere('p.category IN (:ids)')
            ->setParameter('query', '%' . $query . '%')
            ->setParameter('ids', $ids)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        ProductListFilter::applyFilters($builder, $options);

        return $builder->getQuery()->getResult();
    }

    public function searchCountByCategoryIds($query, $ids, $options)
    {
        $builder = $this->createQueryBuilder('p')
            ->select('count(p)')
            ->where('p.name LIKE :query')
            ->andWhere('p.category IN (:ids)')
            ->setParameter('query', '%' . $query . '%')
            ->setParameter('ids', $ids);

        ProductListFilter::applyFilters($builder, $options);

        return $builder->getQuery()->getSingleScalarResult();
    }
}
