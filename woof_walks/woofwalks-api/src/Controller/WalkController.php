<?php



    namespace App\Controller;
    use App\Entity\User;
    use App\Entity\Ad;
    use App\Entity\Walk;
    use App\Repository\PhotoRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    
    class WalkController extends AbstractController
    {
        // #[Route('/api/walks', name: 'create_walk', methods: ['POST'])]
        // public function createWalk(Request $request, EntityManagerInterface $em, PhotoRepository $photoRepository): JsonResponse
        // {
        //     $data = json_decode($request->getContent(), true);
        
        //     if (
        //         empty($data['title']) || 
        //         empty($data['description']) || 
        //         empty($data['date']) || 
        //         empty($data['time']) || 
        //         empty($data['photo'])
        //     ) {
        //         return new JsonResponse(['error' => 'Missing required fields'], 400);
        //     }
        
        //     $photo = $photoRepository->find($data['photo']);
        //     if (!$photo) {
        //         return new JsonResponse(['error' => 'Photo not found'], 404);
        //     }
        
        //         // Création de l'entité Ad
        //     $ad = new Ad();
        //     dump($ad);
        //     $ad->setTitle($data['title']);
        //     $ad->setDescription($data['description']);
        //     $ad->setCreatedAt(new \DateTime()); // Assure-toi que ces champs existent dans Ad
        //     $ad->setUpdatedAt(new \DateTime()); // Assure-toi que ces champs existent dans Ad
        //     $ad->setPhoto($photo); // Association de la photo à l'annonce
        //     // Persister l'entité Ad et Walk
        //     $em->persist($ad);  // Persiste l'annonce
        //     $em->flush();  // Enregistre en base de données
        //     // Création de l'entité Walk
        //     $walk = new Walk();
        //     $walk->setAd($ad); // Liaison de l'annonce à la marche
        //     $walk->setDate(new \DateTime($data['date']));
        //     $walk->setTime(new \DateTime($data['time']));
        //     $walk->setMaxParticipants($data['max_participants'] ?? null);

        //     // Persister l'entité Ad et Walk
        //     $em->persist($walk); // Persiste la marche
        //     $em->flush();  // Enregistre en base de données
        
        //     return new JsonResponse(['message' => 'Walk created successfully'], 201);
        // }
        #[Route('/api/walkscustom', name: 'create_walk', methods: ['POST'])]
        public function createWalk(Request $request, EntityManagerInterface $em, PhotoRepository $photoRepository): JsonResponse
        {
            $data = json_decode($request->getContent(), true);
            $creator = $em->getRepository(User::class)->find(1); // Utiliser un ID existant ou créez un utilisateur temporaire
            // Vérification des champs obligatoires
            if (
                empty($data['title']) || 
                empty($data['description']) || 
                empty($data['date']) || 
                empty($data['time']) || 
                empty($data['photo'])
            ) {
                return new JsonResponse(['error' => 'Missing required fields'], 400);
            }
        
            // Récupérer la photo associée à l'ID
            $photo = $photoRepository->find($data['photo']);
            if (!$photo) {
                return new JsonResponse(['error' => 'Photo not found'], 404);
            }
        
            // Vérifier si l'Ad avec l'ID 20 existe déjà
     
    
                // Si l'Ad n'existe pas, en créer un nouveau
                $ad = new Ad();
                $ad->setTitle($data['title']);
                $ad->setDescription($data['description']);
                $ad->setCreatedAt(new \DateTime());
                $ad->setUpdatedAt(new \DateTime());
                $ad->setPhoto($photo);  // Associer la photo à l'Ad
                $ad->setType('walk');
                $ad->setCreator($creator);

            // Créer la promenade
            $walk = new Walk();
        
            $walk->setAd($ad);  // Associer l'Ad à la Walk

            $walk->setDate(new \DateTime($data['date']));
            $walk->setTime(new \DateTime($data['time']));
            $walk->setMaxParticipants($data['max_participants'] ?? null);
        
            // Persister la Walk et sauvegarder les entités
            $em->persist($walk);  
            $em->flush();  // Sauvegarde des deux entités dans la base de données
        
            return new JsonResponse(['message' => 'Walk created successfully'], 201);
        }

    }        
  