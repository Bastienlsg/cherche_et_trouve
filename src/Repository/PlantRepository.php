<?php

namespace App\Repository;
use App\Entity\User;
use App\Entity\Find;
use App\Entity\Plant;
use App\Repository\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Plant>
 *
 * @method Plant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plant[]    findAll()
 * @method Plant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plant::class);
    }

    public function save(Plant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Plant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function Game($count,$OnlyNotFind=false,User $user=null):array{
        $plantsToReturn=[];
        if ($OnlyNotFind==false){
            $plants=$this->findBy(['display'=>'1']);
            for ($i=0;$i<$count;$i++){
                $plantsToReturn[]=array_splice($plants,random_int(0,count($plants)-1),1)[0];
            }
        }elseif ($user!=null){
        $userid=$user->getId();
        $rawSql="select * from plant where level<=".strval($user->getExp()+1)." and id not in(SELECT plant_id FROM find where user_id=:user_id) order by RAND() limit ".strval($count).";";
        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
            $plants_array=$stmt->executeQuery([":user_id"=>$userid])->fetchAllAssociative();
            $plantsToReturn = [];
            foreach ($plants_array as $array) {
                $plant=$this->find($array["id"]);
                //$plant = Plant::fromArray($array);
                $plantsToReturn[] = $plant;
            }
    }
    return $plantsToReturn;
}
//    /**
//     * @return Plant[] Returns an array of Plant objects
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

//    public function findOneBySomeField($value): ?Plant
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
