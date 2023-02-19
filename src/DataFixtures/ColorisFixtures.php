<?php

namespace App\DataFixtures;

use App\Entity\Coloris;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ColorisFixtures extends Fixture
{
    const COLORIS = 'coloris.';

    public function load(ObjectManager $manager): void
    {
        $coloris = [
            ['code' => 111, 'libelle' => 'Rouge', 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['code' => 222, 'libelle' => 'Vert', 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['code' => 333, 'libelle' => 'Orange', 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
        ];

        $i = 0;
        foreach($coloris as $couleur){
            $i++;
            $entity = new Coloris();
            $entity->setCode($couleur["code"]);
            $entity->setLibelle($couleur["libelle"]);
            $entity->setCreatedAt($couleur["createdAt"]);
            $entity->setUpdatedAt($couleur["updatedAt"]);
            $manager->persist($entity);

            $this->referenceRepository->addReference(self::COLORIS . $i, $entity);
        }

        $manager->flush();
    }
}
