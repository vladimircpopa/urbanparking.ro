<?php

namespace ApiBundle\Listener;

use Symfony\Component\DependencyInjection\Container;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Samuel Chiriluta <samuel.chiriluta@orange.com>
 */
class JWTCreatedListener {

    /**
     * @var Symfony\Component\DependencyInjection\Container 
     */
    private $container;

    public function __construct(Container $service_container)
    {
        $this->container = $service_container;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $userGroups = [];

        foreach ($user->getGroups() as $group) {
            $userGroups[$group->getId()] = $group->getName();
        }

        $userData = [
            'email' => $user->getEmail(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'groups' => $userGroups,
        ];

        $data = array_merge($data, $userData);

        $event->setData($data);
    }

}
