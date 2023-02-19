<?php

namespace App\DataFixtures;

use App\Entity\Modele;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ModeleFixture extends Fixture
{
    const  MODELE = "modele.";

    public function load(ObjectManager $manager): void
    {
        $modeles = [
          ['code' => 111, 'libelle' => 'Tee-shirt Royer', 'prix' => "15", 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
          ['code' => 222, 'libelle' => 'Short', 'prix' => "25", 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
          ['code' => 333, 'libelle' => 'Casquette', 'prix' => "10", 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
          ['code' => 444, 'libelle' => 'Pantalon', 'prix' => "32", 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
        ];

        $i = 0;
        foreach($modeles as $modele){
            $i++;
            $entity = new Modele();
            $entity->setCode($modele["code"]);
            $entity->setLibelle($modele["libelle"]);
            $entity->setPrix($modele["prix"]);
            $entity->setCreatedAt($modele["createdAt"]);
            $entity->setUpdatedAt($modele["updatedAt"]);
            $manager->persist($entity);

            $this->addReference(self::MODELE . $i, $entity);
        }

        $manager->flush();
    }
}
