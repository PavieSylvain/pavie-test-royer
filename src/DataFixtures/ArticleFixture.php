<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixture extends Fixture implements DependentFixtureInterface
{
    const ARTICLE = 'article.';

    public const TAILLE = "taille.";
    public const COLORIS = "coloris.";
    public const  MODELE = "modele.";

    public function getDependencies(): array
    {
        return [
            TailleFixture::class,
            ColorisFixtures::class,
            ModeleFixture::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $articles = [
            // tee-shirt de 1 a 9
            ['EAN' => 1112223334001, 'modele' => self::MODELE . 1, 'coloris' => self::COLORIS . 1, 'taille' => self::TAILLE . 1, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334002, 'modele' => self::MODELE . 1, 'coloris' => self::COLORIS . 1, 'taille' => self::TAILLE . 2, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334003, 'modele' => self::MODELE . 1, 'coloris' => self::COLORIS . 1, 'taille' => self::TAILLE . 3, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334004, 'modele' => self::MODELE . 1, 'coloris' => self::COLORIS . 2, 'taille' => self::TAILLE . 1, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334005, 'modele' => self::MODELE . 1, 'coloris' => self::COLORIS . 2, 'taille' => self::TAILLE . 2, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334006, 'modele' => self::MODELE . 1, 'coloris' => self::COLORIS . 2, 'taille' => self::TAILLE . 3, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334007, 'modele' => self::MODELE . 1, 'coloris' => self::COLORIS . 3, 'taille' => self::TAILLE . 1, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334008, 'modele' => self::MODELE . 1, 'coloris' => self::COLORIS . 3, 'taille' => self::TAILLE . 2, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334009, 'modele' => self::MODELE . 1, 'coloris' => self::COLORIS . 3, 'taille' => self::TAILLE . 3, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],

            // short de 10 à 18
            ['EAN' => 1112223334010, 'modele' => self::MODELE . 2, 'coloris' => self::COLORIS . 1, 'taille' => self::TAILLE . 1, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334011, 'modele' => self::MODELE . 2, 'coloris' => self::COLORIS . 1, 'taille' => self::TAILLE . 2, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334012, 'modele' => self::MODELE . 2, 'coloris' => self::COLORIS . 1, 'taille' => self::TAILLE . 3, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334013, 'modele' => self::MODELE . 2, 'coloris' => self::COLORIS . 2, 'taille' => self::TAILLE . 1, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334014, 'modele' => self::MODELE . 2, 'coloris' => self::COLORIS . 2, 'taille' => self::TAILLE . 2, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334015, 'modele' => self::MODELE . 2, 'coloris' => self::COLORIS . 2, 'taille' => self::TAILLE . 3, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334016, 'modele' => self::MODELE . 2, 'coloris' => self::COLORIS . 3, 'taille' => self::TAILLE . 1, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334017, 'modele' => self::MODELE . 2, 'coloris' => self::COLORIS . 3, 'taille' => self::TAILLE . 2, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334018, 'modele' => self::MODELE . 2, 'coloris' => self::COLORIS . 3, 'taille' => self::TAILLE . 3, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],

            // casquette de 19 à 27
            ['EAN' => 1112223334019, 'modele' => self::MODELE . 3, 'coloris' => self::COLORIS . 1, 'taille' => self::TAILLE . 1, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334020, 'modele' => self::MODELE . 3, 'coloris' => self::COLORIS . 1, 'taille' => self::TAILLE . 2, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334021, 'modele' => self::MODELE . 3, 'coloris' => self::COLORIS . 1, 'taille' => self::TAILLE . 3, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334022, 'modele' => self::MODELE . 3, 'coloris' => self::COLORIS . 2, 'taille' => self::TAILLE . 1, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334023, 'modele' => self::MODELE . 3, 'coloris' => self::COLORIS . 2, 'taille' => self::TAILLE . 2, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334024, 'modele' => self::MODELE . 3, 'coloris' => self::COLORIS . 2, 'taille' => self::TAILLE . 3, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334025, 'modele' => self::MODELE . 3, 'coloris' => self::COLORIS . 3, 'taille' => self::TAILLE . 1, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334026, 'modele' => self::MODELE . 3, 'coloris' => self::COLORIS . 3, 'taille' => self::TAILLE . 2, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334027, 'modele' => self::MODELE . 3, 'coloris' => self::COLORIS . 3, 'taille' => self::TAILLE . 3, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],

            // Pantalon de 28 à 36
            ['EAN' => 1112223334028, 'modele' => self::MODELE . 4, 'coloris' => self::COLORIS . 1, 'taille' => self::TAILLE . 1, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334029, 'modele' => self::MODELE . 4, 'coloris' => self::COLORIS . 1, 'taille' => self::TAILLE . 2, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334030, 'modele' => self::MODELE . 4, 'coloris' => self::COLORIS . 1, 'taille' => self::TAILLE . 3, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334031, 'modele' => self::MODELE . 4, 'coloris' => self::COLORIS . 2, 'taille' => self::TAILLE . 1, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334032, 'modele' => self::MODELE . 4, 'coloris' => self::COLORIS . 2, 'taille' => self::TAILLE . 2, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334033, 'modele' => self::MODELE . 4, 'coloris' => self::COLORIS . 2, 'taille' => self::TAILLE . 3, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334034, 'modele' => self::MODELE . 4, 'coloris' => self::COLORIS . 3, 'taille' => self::TAILLE . 1, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334035, 'modele' => self::MODELE . 4, 'coloris' => self::COLORIS . 3, 'taille' => self::TAILLE . 2, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
            ['EAN' => 1112223334036, 'modele' => self::MODELE . 4, 'coloris' => self::COLORIS . 3, 'taille' => self::TAILLE . 3, 'createdAt' => new \DateTimeImmutable(), 'updatedAt' => new \DateTimeImmutable()],
        ];

        $i = 0;
        foreach($articles as $article){
            $i++;
            $entity = new Article();
            $entity->setEAN($article["EAN"]);
            $entity->setCreatedAt($article["createdAt"]);
            $entity->setUpdatedAt($article["updatedAt"]);

            $entity->setModele($this->getReference($article["modele"]));
            $entity->setColoris($this->getReference($article["coloris"]));
            $entity->setTaille($this->getReference($article["taille"]));

            $manager->persist($entity);

            $this->addReference(self::ARTICLE . $i, $entity);
        }

        $manager->flush();
    }
}
