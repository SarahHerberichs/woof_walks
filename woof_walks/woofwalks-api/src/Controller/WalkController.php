<?php

namespace App\Controller;

use App\Entity\Walk;
use App\Repository\WalkRepository;
use App\Repository\PhotoEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
class WalkController extends AbstractController
{

    #[Route('/api/walks_with_photos', name: 'api_walks', methods: ['GET'])]

    public function getWalksWithPhotos(WalkRepository $walkRepository, PhotoEntityRepository $photoEntityRepository,LoggerInterface $logger): Response
    {


        // Récupérer toutes les walks
        $walks = $walkRepository->findAll();
        $walksWithPhotos = [];

        foreach ($walks as $walk) {
            // Récupérer la photo associée à chaque walk par l'ID de la walk
            $photoEntity = $photoEntityRepository->findByWalkId($walk->getId());
            $logger->info('PhotoEntity for Walk ID ' . $walk->getId(), ['photoEntity' => $photoEntity]);
            // Si une photo est associée à la walk, récupérer son chemin
            if ($photoEntity) {
                $photo = $photoEntity->getPhoto(); // PhotoEntity -> Photo (la relation entre les deux)
                $photoPath = $photo->getContentUrl(); // ou autre méthode pour récupérer le chemin de la photo

                // Ajouter la photo à l'objet walk
                $walkData = [
                    'id' => $walk->getId(),
                    'title' => $walk->getTitle(),
                    'description' => $walk->getDescription(),
                    'date' => $walk->getDate()->format('Y-m-d'),
                    'time' => $walk->getTime()->format('H:i'),
                    'max_participants' => $walk->getMaxParticipants(),
                    'photo' => [
                        'id' => $photo->getId(),
                        'path' => $photoPath,
                    ],
                ];
            } else {
                // Si aucune photo n'est associée
                $walkData = [
                    'id' => $walk->getId(),
                    'title' => $walk->getTitle(),
                    'description' => $walk->getDescription(),
                    'date' => $walk->getDate()->format('Y-m-d'),
                    'time' => $walk->getTime()->format('H:i'),
                    'max_participants' => $walk->getMaxParticipants(),
                    'photo' => null, // Aucun photo associée
                ];
            }

            // Ajouter à la liste des walks avec photos
            $walksWithPhotos[] = $walkData;
        }

        // Retourner les données des walks avec photo dans la réponse
        return $this->json($walksWithPhotos);
    }
}
