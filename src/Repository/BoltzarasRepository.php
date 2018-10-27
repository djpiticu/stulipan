<?php
// src/Repository/BoltzarasRepository.php
// az adatbázisból kiolvasás funkciókat a repository-ban tároljuk

namespace App\Repository;

use App\Entity\Boltzaras;
//use Doctrine\ORM\EntityRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class BoltzarasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Boltzaras::class);
    }

    /**
     * @param $kassza
	 * @return \Doctrine\ORM\Query
     */
    public function findAllGreaterThanKassza($kassza)
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('p')
            ->where('p.kassza > :k')
//            ->andWhere('p.kassza > :k')
            ->setParameter('k', $kassza)
            //->orderBy('p.kassza', 'ASC')
            ->getQuery();

        return $qb;
	}

    /**
     * @param $start
     * @param $end
     * @return \Doctrine\ORM\Query
     */
	public function findAllBetweenDates($start, $end)
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.idopont >= :start')
            ->andWhere('p.idopont <= :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->orderBy('p.idopont', 'DESC')
            ->getQuery();

        return $qb;
    }
	
    /**
     * @return \Doctrine\ORM\Query
     */	
    public function findAllQueryBuilder()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.idopont', 'DESC');
//		return $this->createQueryBuilder('b')
//            ->addSelect('b.*')
//            ->setParameter('user', $userId)
//            ->getQuery();
	}


}