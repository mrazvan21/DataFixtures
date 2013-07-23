<?php
namespace DataFixtures\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class DataFixtures
{
    private $entityManager;
    private $tool;
    private $entities = array();

    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->tool = new \Doctrine\ORM\Tools\SchemaTool($this->entityManager);
        return $this;
    }

    public function addEntity($entityName)
    {
        $entityNameSpace = 'Provider\Entity\\'.$entityName;
        $this->entities[] = $this->entityManager->getClassMetadata($entityNameSpace);
    }

    public function dropTables()
    {
        if (empty($this->entities)) {
            return false;
        }
        $this->tool->dropSchema($this->entities);
        return true;
    }

    public function updateTables()
    {
        if (empty($this->entities)) {
            return false;
        }
        $this->tool->updateSchema($this->entities);
        return true;
    }

    public function addContent($object)
    {
        if (!is_object($object)) {
            return false;
        }

        $this->entityManager->persist($object);
        $this->entityManager->flush();

        return true;
    }
}
