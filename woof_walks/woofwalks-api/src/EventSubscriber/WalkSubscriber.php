<?php

namespace App\EventSubscriber;

use App\Entity\Walk;
use App\Entity\Chat;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PostPersistEventArgs; // Utilisez la bonne classe ici
use Doctrine\ORM\Events;

class WalkSubscriber implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [Events::postPersist];
    }

    public function postPersist(PostPersistEventArgs $args): void // Changer le type ici
    {
        $entity = $args->getObject();

        if (!$entity instanceof Walk) {
            return;
        }

        $entityManager = $args->getObjectManager(); // Utilisez getObjectManager() ici

        // Créer un Chat et l'associer au Walk
        $chat = new Chat();
        $chat->setWalk($entity);

        $entityManager->persist($chat);
        $entityManager->flush();
    }
}
