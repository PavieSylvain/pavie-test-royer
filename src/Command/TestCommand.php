<?php

namespace App\Command;

use App\Repository\ArticleRepository;
use App\Repository\PackArticlesRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Services\Commande;

#[AsCommand(
    name: 'test',
    description: 'Add a short description for your command',
)]
class TestCommand extends Command
{
    public function __construct(ArticleRepository $articleRepository, PackArticlesRepository $packArticlesRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->packArticlesRepository = $packArticlesRepository;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        while($this->start($input, $output)){ }

        $io->success('Good bye :)');
        return Command::SUCCESS;
    }

    private function start($input, $output){
        $section1 = $output->section();
        $section2 = $output->section();
        $section3 = $output->section();
        $section1->writeln('/************************** Test commande Royer **********************************/');
        $section1->writeln('1: Jeu de test 1');
        $section1->writeln('2: Jeu de test 2');
        $section1->writeln('3: Jeu de test 3');
        $section1->writeln('4: exit');
        $question = new Question("Entrer une valeur entre 1 et 3 pour choisir un jeu de test, 4 pour quitter \n");
        $helper = $this->getHelper('question');
        $answer = $helper->ask($input, $output, $question);
        $section2->writeln('votre réponse => ' . $answer );

        if($answer == 4){
            return false;
        } else if(is_int($answer) || $answer < 1 || $answer > 4){
            $section1->writeln('<error>!!! Veuillez rentrer une valeur valide !!!</error>');
            return true;
        }

        $section1->clear();
        $section2->clear();
        $section3->writeln('::::::::::::: Votre sélections d\'articles :::::::::::::::');
        $result = $this->testGame($answer, $section3);


        if($result){
            $section3->writeln('::::::::::::: Resultat de la commande :::::::::::::::::');
            $section3->writeln('---- Vos Packs ----');
            $total = 0;
            foreach ($result['packs'] as $pack){
                $section3->writeln(
                    '<error>'
                    .$pack['pack']['pack']->getEAN()
                    . ' '
                    . $pack['pack']['pack']->getLibelle()
                    . ':: prix unitaire = '
                    . $pack['pack']['pack']->getPrix()
                    . '€ :: quantité = '
                    . $pack['quantite']
                    . '</error>'
                );

                $total +=  $pack['pack']['pack']->getPrix() * $pack['quantite'];
            }
            $section3->writeln('---- Vos Articles seules ----');
            foreach ($result['articles'] as $article){
                if($article['quantite'] > 0) {
                    $section3->writeln(
                        '<error>'
                        . $article['article']->getEAN()
                        . ' '
                        . $article['article']->getModele()->getLibelle()
                        . ' '
                        . $article['article']->getColoris()->getLibelle()
                        . ' '
                        . $article['article']->getTaille()->getLibelle()
                        . ':: prix unitaire = '
                        . $article['article']->getModele()->getPrix()
                        . '€ :: quantité = '
                        . $article['quantite']
                        . '</error>'
                    );
                }

                $total +=  $article['article']->getModele()->getPrix() * $article['quantite'];
            }

            $section3->writeln('<info>Prix total = ' . $total . '€</info>');


        } else {
            $section1->writeln('<error>!!! Nous avons rencontrez un problème, veuillez nous excuser !!!</error>');
            return false;
        }

        $question2 = new Question("Appuez sur ENTRER pour continuer");
        $helper = $this->getHelper('question');
        $helper->ask($input, $output, $question2);
        $section1->clear();
        $section2->clear();
        $section3->clear();

        return true;
    }


    private function testGame($answer, $section3): array
    {
        // Simulation d'une commande //
        $commandeService = new Commande($this->packArticlesRepository);
        // Commande sans Pack
        $game1 = [
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334005']), 'quantite' => 2],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334023']), 'quantite' => 3],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334031']), 'quantite' => 5],
        ];

        // Commande correspondant a un pack
        $game2 = [
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334007']), 'quantite' => 10],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334016']), 'quantite' => 10],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334025']), 'quantite' => 10],
        ];

        // Grosse commande avec packs et articles
        $game3 = [
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334028']), 'quantite' => 90],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334029']), 'quantite' => 70],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334030']), 'quantite' => 70],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334031']), 'quantite' => 85],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334032']), 'quantite' => 70],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334033']), 'quantite' => 90],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334034']), 'quantite' => 70],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334035']), 'quantite' => 85],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334036']), 'quantite' => 90],

            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334007']), 'quantite' => 90],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334008']), 'quantite' => 70],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334009']), 'quantite' => 70],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334016']), 'quantite' => 85],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334017']), 'quantite' => 70],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334018']), 'quantite' => 90],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334025']), 'quantite' => 70],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334026']), 'quantite' => 85],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334027']), 'quantite' => 90],

            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334004']), 'quantite' => 90],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334012']), 'quantite' => 90],
            ['article' => $this->articleRepository->findOneBy(['EAN' => '1112223334020']), 'quantite' => 90],
        ];

        switch ($answer){
            case 1: $articles = $game1; break;
            case 2: $articles = $game2; break;
            case 3: $articles = $game3; break;
        }

        foreach ($articles as $article){
            $section3->writeln(
                $article['article']->getModele()->getLibelle()
                    . ' '
                . $article['article']->getColoris()->getLibelle()
                . ' '
                . $article['article']->getTaille()->getLibelle()
                . ' quantité = '
                . $article['quantite']
            );
        }

        return $commandeService->makeCommand($articles);
    }
}
