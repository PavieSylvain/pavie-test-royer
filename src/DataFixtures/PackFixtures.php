<?php

namespace App\DataFixtures;

use App\Entity\Pack;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PackFixtures extends Fixture
{
    public const  PACK = "pack.";

    public function load(ObjectManager $manager): void
    {
        $packs = [
            ['EAN' => '1112223334001', 'libelle' => 'Pack été orange S X10',  'prix' => 350, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => '1112223334002', 'libelle' => 'Pack été orange M X10',  'prix' => 350, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => '1112223334003', 'libelle' => 'Pack été orange L X10',  'prix' => 350, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],

            ['EAN' => '111222333404', 'libelle' => 'Pack pantalon orange vert rouge SML X10',  'prix' => 2500, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],

            ['EAN' => '1112223334005', 'libelle' => 'Pack été orange S X50',  'prix' => 1500, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => '1112223334006', 'libelle' => 'Pack été orange M X50',  'prix' => 1500, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => '1112223334007', 'libelle' => 'Pack été orange L X50',  'prix' => 1500, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],

        ];

        $i = 0;
        foreach ($packs as $pack) {
            $i++;
            $entity = new Pack();
            $entity->setEAN($pack["EAN"]);
            $entity->setLibelle($pack["libelle"]);
            $entity->setPrix($pack["prix"]);
            $entity->setCreatedAt($pack["createdAt"]);
            $entity->setUpdatedAt($pack["updatedAt"]);
            $manager->persist($entity);

            $this->referenceRepository->addReference(self::PACK . $i, $entity);
        }

        $manager->flush();
    }
}
