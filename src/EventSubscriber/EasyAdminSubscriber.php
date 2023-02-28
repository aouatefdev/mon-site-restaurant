<?php

# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\EventSubscriber;

use App\Entity\Users;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class EasyAdminSubscriber implements EventSubscriberInterface
{
     private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setUsers'],
        ];
    }

    public function setUsers(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Users)) {
            return;
        }
       
        $entity->setPassword($this->hasher->HashPassword($entity, $entity->getPassword())); 
        // $entity->setRoles(['ROLE_CLIENT']); 
    }        
}
