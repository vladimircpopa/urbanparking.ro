<?php
/**
 * Created by PhpStorm.
 * User: Winnetou
 * Date: 2017-09-23
 * Time: 00:24
 */

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * @author Samuel Chiriluta <samuel.chiriluta@orange.com>
 */
abstract class AbstractEntityService {

    use ContainerAwareTrait;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var \AppBundle\Repository\ProjectRepository
     */
    protected $repository;

    /**
     * @var \AppBundle\Entity\User
     */
    protected $user;
    protected $appConfig;

    protected function __construct(ContainerInterface $service_container)
    {
        $this->setContainer($service_container);
        $this->setEntityManager();
        $this->setRepository();
        $this->setUser();
//        $this->setAppConfig();
    }

    private function setAppConfig()
    {
        $this->appConfig = $this->container->getParameter('app');
    }

    private function setEntityManager()
    {
        $this->entityManager = $this->container->get('doctrine')->getManager();
    }

    protected function setRepository()
    {
        $this->repository = $this->entityManager->getRepository(static::ENTITY_PATH);
    }

    private function setUser()
    {
        $user = null;

        if ($token = $this->container->get('security.token_storage')->getToken())
        {
            $user = $token->getUser();
        }

        $this->user = $user;
    }

    /**
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

}
