<?php

namespace Main\DefaultBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TestRepository extends EntityRepository
{
    /*
     * For update dictionaryScore score
     * return int
     *
     */
    public function getAvgScore($a)
    {
        $sql = 'SELECT (sum(t.score*t.nbQuestion)/sum(t.nbQuestion)) as avg FROM Test t WHERE t.dictionary_id = :did and t.user_id = :uid';
        $a = $this->getEntityManager()->getConnection()->executeQuery($sql, $a)->fetchAll();
        return $a[0]['avg'];
    }
}