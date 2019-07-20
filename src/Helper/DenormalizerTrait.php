<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 21/07/2019
 * Time: 01:37
 */

namespace App\Helper;



use Symfony\Component\DependencyInjection\ContainerInterface;

trait DenormalizerTrait
{
    /** @var ContainerInterface */
    protected $container;

    public function __construct(ContainerInterface $container )
    {
        $this->container = $container;
    }

    /**
     * @param $data
     * @param $class
     * @return bool|null|object
     *
     */
    public function getEntity($data, $class)
    {
        $entity = false;
        if (array_key_exists('id', $data)) {
            $entity = $this->getEntityManager()->getRepository($class)->find($data['id']);
        }
        if (!$entity) {
            $entity = new $class();
        }
        return $entity;
    }

    /**
     * @return \Doctrine\ORM\EntityManager|mixed
     */
    protected function getEntityManager()
    {
        return $this->container->get('doctrine.orm.entity_manager');
    }

    /**
     * @return mixed|\Symfony\Component\Serializer\Serializer
     */
    protected function getSerializer()
    {
        return $this->container->get('serializer');
    }
}