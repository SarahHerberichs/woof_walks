<?php

// namespace App\Controller;

// use App\Entity\Walk;
// use App\Repository\WalkRepository;
// use App\Repository\PhotoEntityRepository;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
// use Psr\Log\LoggerInterface;
// class WalkController extends AbstractController
// {

//     #[Route('/api/walks_with_photos', name: 'api_walks', methods: ['GET'])]

//     public function getWalksWithPhotos(WalkRepository $walkRepository, PhotoEntityRepository $photoEntityRepository,LoggerInterface $logger): Response
//     {


//         // Récupérer toutes les walks
//         $walks = $walkRepository->findAll();
//         $walksWithPhotos = [];

//         foreach ($walks as $walk) {
//             // Récupérer la photo associée à chaque walk par l'ID de la walk
//             $photoEntity = $photoEntityRepository->findByWalkId($walk->getId());
//             $logger->info('PhotoEntity for Walk ID ' . $walk->getId(), ['photoEntity' => $photoEntity]);
//             // Si une photo est associée à la walk, récupérer son chemin
//             if ($photoEntity) {
//                 $photo = $photoEntity->getPhoto(); // PhotoEntity -> Photo (la relation entre les deux)
//                 $photoPath = $photo->getContentUrl(); // ou autre méthode pour récupérer le chemin de la photo

//                 // Ajouter la photo à l'objet walk
//                 $walkData = [
//                     'id' => $walk->getId(),
//                     'title' => $walk->getTitle(),
//                     'description' => $walk->getDescription(),
//                     'date' => $walk->getDate()->format('Y-m-d'),
//                     'time' => $walk->getTime()->format('H:i'),
//                     'max_participants' => $walk->getMaxParticipants(),
//                     'photo' => [
//                         'id' => $photo->getId(),
//                         'path' => $photoPath,
//                     ],
//                 ];
//             } else {
//                 // Si aucune photo n'est associée
//                 $walkData = [
//                     'id' => $walk->getId(),
//                     'title' => $walk->getTitle(),
//                     'description' => $walk->getDescription(),
//                     'date' => $walk->getDate()->format('Y-m-d'),
//                     'time' => $walk->getTime()->format('H:i'),
//                     'max_participants' => $walk->getMaxParticipants(),
//                     'photo' => null, // Aucun photo associée
//                 ];
//             }

//             // Ajouter à la liste des walks avec photos
//             $walksWithPhotos[] = $walkData;
//         }

//         // Retourner les données des walks avec photo dans la réponse
//         return $this->json($walksWithPhotos);
//     }

    // namespace App\Controller;

    // use App\Entity\Walk;
    // use App\Entity\Photo;
    // use App\Repository\WalkRepository;
    // use App\Repository\PhotoRepository;
    // use Doctrine\ORM\EntityManagerInterface;
    // use Symfony\Component\HttpFoundation\Request;
    // use Symfony\Component\HttpFoundation\JsonResponse;
    // use Symfony\Component\Routing\Annotation\Route;
    // use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    // use Symfony\Component\HttpFoundation\File\Exception\FileException;
    // use Symfony\Component\HttpFoundation\File\UploadedFile;
    namespace App\Controller;

    use App\Entity\Walk;
    use App\Entity\Photo;
    use App\Repository\PhotoRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\Routing\Annotation\Route;
    use ApiPlatform\Core\Annotation\ApiResource;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    
    class WalkController extends AbstractController
    {
        #[Route('/api/walks', name: 'create_walk', methods: ['POST'])]
        public function createWalk(Request $request, EntityManagerInterface $em, PhotoRepository $photoRepository): JsonResponse
        {
            $data = json_decode($request->getContent(), true);
        
            if (
                empty($data['title']) || 
                empty($data['description']) || 
                empty($data['date']) || 
                empty($data['time']) || 
                empty($data['photo'])
            ) {
                return new JsonResponse(['error' => 'Missing required fields'], 400);
            }
        
            $photo = $photoRepository->find($data['photo']);
            if (!$photo) {
                return new JsonResponse(['error' => 'Photo not found'], 404);
            }
        
            $walk = new Walk(); // Supposez que `Walk` est une entité
            $walk->setTitle($data['title']);
            $walk->setDescription($data['description']);
            $walk->setDate(new \DateTime($data['date']));
            $walk->setTime(new \DateTime($data['time']));
            $walk->setPhoto($photo);
            $walk->setMaxParticipants($data['max_participants'] ?? null);
        
            $em->persist($walk);
            $em->flush();
        
            return new JsonResponse(['message' => 'Walk created successfully'], 201);
        }
        
    }        
   
    // }        
    // #[Route('/api/walks_with_photos', name: 'api_walks', methods: ['GET'])]

    // public function getWalksWithPhoto(EntityManagerInterface $entityManager): JsonResponse
    // {
    //     // Récupérer toutes les promenades
    //     $walks = $entityManager->getRepository(Walk::class)->findAll();

    //     // Tableau pour stocker les données formatées
    //     $formattedWalks = [];

    //     foreach ($walks as $walk) {
    //         // Récupérer la photo associée à la promenade
    //         $photo = $walk->getPhoto(); // Assurez-vous que la relation est correctement définie

    //         // Récupérer le chemin de la photo (assurez-vous que vous avez configuré le chemin correctement)
    //         $photoPath = $photo ? $photo->getPath() : null;

    //         // Formater les données de la promenade
    //         $walkData = [
    //             'id' => $walk->getId(),
    //             'title' => $walk->getTitle(),
    //             'description' => $walk->getDescription(),
    //             'date' => $walk->getDate()->format('Y-m-d'),
    //             'time' => $walk->getTime()->format('H:i'),
    //             'max_participants' => $walk->getMaxParticipants(),
    //             'photo' => $photo ? [
    //                 'id' => $photo->getId(),
    //                 'path' => $photoPath,
    //             ] : null,  // Ajoutez la photo si elle existe
    //         ];

    //         $formattedWalks[] = $walkData;
    //     }

    //     // Retourner les données formatées en JSON
    //     return new JsonResponse($formattedWalks);
    // }


    
    //     #[Route('/api/photo_entity', name: 'link_photo_walk', methods: ['POST'])]
    //     public function linkPhotoToWalk(Request $request, WalkRepository $walkRepo, PhotoRepository $photoRepo, EntityManagerInterface $em): JsonResponse
    //     {
    //         $data = json_decode($request->getContent(), true);
    
    //         $walkId = $data['walkId'];
    //         $photoId = $data['photoId'];
    
    //         $walk = $walkRepo->find($walkId);
    //         $photo = $photoRepo->find($photoId);
    //         $walk->setPhoto($photo);
    //         if (!$walk || !$photo) {
    //             return new JsonResponse(['message' => 'Walk or Photo not found'], JsonResponse::HTTP_NOT_FOUND);
    //         }
    
    //         // Création de la relation entre Walk et Photo (associative entity ou logique à implémenter ici)
    //         // Exemple : $walk->setPhoto($photo);
    
    //         // Sauvegarde de la relation
    //         $em->persist($walk);
    //         $em->flush();
    
    //         return new JsonResponse(['message' => 'Walk and photo linked successfully'], JsonResponse::HTTP_OK);
    //     }
    // }
    
// }
