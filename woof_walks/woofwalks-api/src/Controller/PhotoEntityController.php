<?php
namespace App\Controller;

use App\Entity\Walk;
use App\Entity\Photo;
use App\Entity\PhotoEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PhotoEntityController extends AbstractController
{
    #[Route('/api/photo_entity', name: 'api_photo_entity', methods: ['POST'])]
    public function createPhotoEntity(Request $request, EntityManagerInterface $entityManager): Response
    {

        // Décoder le contenu JSON de la requête
        $data = json_decode($request->getContent(), true);

        // Vérifier si le JSON a bien été décodé
        if ($data === null) {
            return new Response('Erreur de décodage JSON', Response::HTTP_BAD_REQUEST);
        }

        // Log des données récupérées dans Symfony (à vérifier dans le log ou debug)
        dump($data); // Permet de voir les données dans le debug de Symfony

        // Vérifier si les IDs de la photo et de la walk sont présents
        if (!isset($data['photoId']) || !isset($data['walkId'])) {
            return new Response("Les IDs de la photo et de la walk sont requis.", Response::HTTP_BAD_REQUEST);
        }

        // Récupérer les entités Photo et Walk à partir des IDs
        $photo = $entityManager->getRepository(Photo::class)->find($data['photoId']);
        $walk = $entityManager->getRepository(Walk::class)->find($data['walkId']);

        // Vérifier si les entités existent
        if (!$photo || !$walk) {
            return new Response("Photo ou Walk non trouvée.", Response::HTTP_NOT_FOUND);
        }

        // Créer l'entité PhotoEntity pour lier la photo et la walk
        $photoEntity = new PhotoEntity();
        $photoEntity->setPhoto($photo);
        $photoEntity->setEntityClass('Walk');
        $photoEntity->setEntity($walk);
        //Nécessaire?
        $photoEntity->setName('Nom de la photo'); 

     
        $entityManager->persist($photoEntity);
        $entityManager->flush();

        //Retour données json
        $responseData = json_encode([
            'message' => 'PhotoEntity créée et liée avec succès.',
            'photoEntityId' => $photoEntity->getId(),
        ], JSON_PRETTY_PRINT);

        return new Response(
            $responseData,  // Données JSON encodées à retourner
            Response::HTTP_OK,  // Statut HTTP 200 OK
            ['Content-Type' => 'application/json']
        );
    }
}
  