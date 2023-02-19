<?php

namespace App\Services;

use App\Entity\Article;
use App\Entity\Pack;
use App\Repository\PackArticlesRepository;

class Commande
{
    public function __construct(PackArticlesRepository $packArticlesRepository)
    {
        $this->packArticlesRepository = $packArticlesRepository;
    }

    public function
    makeCommand(array $articles){
        $packs = [];

        // Recherche si des packs correspondent avec la commande passé
        do{
           $pack = $this->getPack($articles);
           if($pack){
               if(array_key_exists($pack['pack']->getEAN(), $packs)){
                   $packs[$pack['pack']->getEAN()]['quantite']++;
               } else {
                   $packs[$pack['pack']->getEAN()]['quantite'] = 1;
                   $packs[$pack['pack']->getEAN()]['pack'] = $pack;
               }
           }
        } while ($pack);

        return ['articles' => $articles, 'packs' =>  $packs];
    }

    private function getPack(array &$articles)
    {
        $packsArticles = [];

        // Recherche si un article correspond a un item de pack
        foreach ($articles as $article){
            $res = $this->packArticlesRepository->findByArticleByQuantite($article['article'], $article['quantite']);
            $packsArticles = array_merge($res, $packsArticles);
        }
        $packsProvisoires = [];

        // Calcul de la quantité d'article dans un pack
        foreach ($packsArticles as $packsArticle) {
            if(array_key_exists($packsArticle->getPack()->getEAN(), $packsProvisoires)){
                $packsProvisoires[$packsArticle->getPack()->getEAN()]['quantite'] += $packsArticle->getQuantity();
            } else {
                $packsProvisoires[$packsArticle->getPack()->getEAN()]['pack'] = $packsArticle->getPack();
                $packsProvisoires[$packsArticle->getPack()->getEAN()]['quantite'] = $packsArticle->getQuantity();
            }
        }

        // trier par ordre de quantité, décroissant
        uasort($packsProvisoires, fn($a, $b) => $b['quantite'] <=> $a['quantite']);

        // validation du pack
        foreach ($packsProvisoires as $packsProvisoire){
            $articlesSelected = array_filter($packsArticles, function ($item) use ($packsProvisoire) {
                if ($item->getPack()->getEAN() === $packsProvisoire['pack']->getEAN()) {
                    return true;
                }
                return false;
            });

            $checkPack = true;
            $articlesProvisoire = $articles;
            foreach ($articlesSelected as $selected){
                foreach ($articlesProvisoire as &$article){
                    if($article['article'] == $selected->getArticle() && $article['quantite'] >= $selected->getQuantity()){
                        $article['quantite'] -= $selected->getQuantity();
                        $checkPack = true;
                        break;
                    } else {
                        $checkPack = false;
                    }
                }
            }
            if($checkPack) {
                $articles = $articlesProvisoire;
                return $packsProvisoire;
            }
        }

        return false;
    }
}
