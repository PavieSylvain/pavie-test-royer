<?php

namespace App\DataFixtures;

use App\Entity\Taille;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TailleFixture extends Fixture
{
    public const  TAILLE = "taille.";

    public function load(ObjectManager $manager): void
    {
        $tailles = [
            ['libelle' => 'S', 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['libelle' => 'M', 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['libelle' => 'L', 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
        ];

        $i = 0;
        foreach ($tailles as $taille) {
            $i++;
            $entity = new Taille();
            $entity->setLibelle($taille["libelle"]);
            $entity->setCreatedAt($taille["createdAt"]);
            $entity->setUpdatedAt($taille["updatedAt"]);
            $manager->persist($entity);

            $this->referenceRepository->addReference(self::TAILLE . $i, $entity);
        }

        $manager->flush();
    }
}
