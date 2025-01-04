<?php

// src/DataFixtures/AppFixtures.php
// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Photo;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $photo = new Photo();
        $photo->setTitle('Test Photo');
        $manager->persist($photo);
        $manager->flush();
    
    }
}
