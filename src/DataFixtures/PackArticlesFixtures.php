<?php

namespace App\DataFixtures;

use App\Entity\PackArticles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PackArticlesFixtures extends Fixture implements DependentFixtureInterface
{
    public const  PACKARTICLES = "packarticles.";

    public const ARTICLE = "article.";
    public const PACK = "pack.";

    public function getDependencies(): array
    {
        return [
            PackFixtures::class,
            ArticleFixture::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $packs = [
            // pack été orange S X10
            ['pack' => self::PACK . 1, 'article' => self::ARTICLE . 7,  'quantite' => 10],
            ['pack' => self::PACK . 1, 'article' => self::ARTICLE . 16,  'quantite' => 10],
            ['pack' => self::PACK . 1, 'article' => self::ARTICLE . 25,  'quantite' => 10],

            // pack été orange M X10
            ['pack' => self::PACK . 2, 'article' => self::ARTICLE . 8,  'quantite' => 10],
            ['pack' => self::PACK . 2, 'article' => self::ARTICLE . 17,  'quantite' => 10],
            ['pack' => self::PACK . 2, 'article' => self::ARTICLE . 26,  'quantite' => 10],

            // pack été orange L X10
            ['pack' => self::PACK . 3, 'article' => self::ARTICLE . 9,  'quantite' => 10],
            ['pack' => self::PACK . 3, 'article' => self::ARTICLE . 18,  'quantite' => 10],
            ['pack' => self::PACK . 3, 'article' => self::ARTICLE . 27,  'quantite' => 10],

            // pack été orange S X50
            ['pack' => self::PACK . 5, 'article' => self::ARTICLE . 7,  'quantite' => 50],
            ['pack' => self::PACK . 5, 'article' => self::ARTICLE . 16,  'quantite' => 50],
            ['pack' => self::PACK . 5, 'article' => self::ARTICLE . 25,  'quantite' => 50],

            // pack été orange M
            ['pack' => self::PACK . 6, 'article' => self::ARTICLE . 8,  'quantite' => 50],
            ['pack' => self::PACK . 6, 'article' => self::ARTICLE . 17,  'quantite' => 50],
            ['pack' => self::PACK . 6, 'article' => self::ARTICLE . 26,  'quantite' => 50],

            // pack été orange L
            ['pack' => self::PACK . 7, 'article' => self::ARTICLE . 9,  'quantite' => 50],
            ['pack' => self::PACK . 7, 'article' => self::ARTICLE . 18,  'quantite' => 50],
            ['pack' => self::PACK . 7, 'article' => self::ARTICLE . 27,  'quantite' => 50],

            // pack pantalon
            ['pack' => self::PACK . 4, 'article' => self::ARTICLE . 28,  'quantite' => 10],
            ['pack' => self::PACK . 4, 'article' => self::ARTICLE . 29,  'quantite' => 10],
            ['pack' => self::PACK . 4, 'article' => self::ARTICLE . 30,  'quantite' => 10],
            ['pack' => self::PACK . 4, 'article' => self::ARTICLE . 31,  'quantite' => 10],
            ['pack' => self::PACK . 4, 'article' => self::ARTICLE . 32,  'quantite' => 10],
            ['pack' => self::PACK . 4, 'article' => self::ARTICLE . 33,  'quantite' => 10],
            ['pack' => self::PACK . 4, 'article' => self::ARTICLE . 34,  'quantite' => 10],
            ['pack' => self::PACK . 4, 'article' => self::ARTICLE . 35,  'quantite' => 10],
            ['pack' => self::PACK . 4, 'article' => self::ARTICLE . 36,  'quantite' => 10],


        ];

        $i = 0;
        foreach ($packs as $pack) {
            $i++;
            $entity = new PackArticles();
            $entity->setPack($this->getReference($pack["pack"]));
            $entity->setArticle($this->getReference($pack["article"]));
            $entity->setQuantity($pack["quantite"]);
            $manager->persist($entity);

            $this->referenceRepository->addReference(self::PACKARTICLES . $i, $entity);
        }

        $manager->flush();
    }
}
