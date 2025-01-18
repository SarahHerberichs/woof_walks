<?php

namespace App\Controller;

use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class WalkPhotoUploadController
{
    public function __invoke(Request $request, $data, EntityManagerInterface $entityManager)
    {
        $photoFile = $request->files->get('photoFile');
        if (!$photoFile) {
            throw new BadRequestHttpException('"photoFile" is required.');
        }

        $photo = new Photo();
        $photo->setFilePath('/media/' . $photoFile->getClientOriginalName());

        $photoFile->move('public/media', $photoFile->getClientOriginalName());

        $data->setPhoto($photo);

        $entityManager->persist($photo);
        $entityManager->flush();

        return $data;
    }
}
