<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\PlayerRepository;
use App\Data\SearchPlayerData;
use App\Form\SearchFormPlayer;
use App\Form\PlayerType;
use App\Entity\Player;
/**
 * 
 * @Route("/player")
 */ 
class WelcomeController extends AbstractController
{
    /**
     * @Route("/", name="app_welcome")
     */
    public function index(Request $request, PlayerRepository $pr): Response
    {
        $spd = new SearchPlayerData();
        $searchPlayerForm = $this->createForm(SearchFormPlayer::class, $spd);
        $searchPlayerForm->handleRequest($request);

       // $players = $pr->findBy([], ['createdAt' => 'DESC']);
        $players = $pr->findSearch($spd);
        return $this->render('welcome/index.html.twig',
            [
                'players' => $players,
                'form' => $searchPlayerForm->createView()
            ]
        );
    }

    /**
     * 
     * @Route("/add", name="app_add_player")
     */ 
    public function showAddPlayer(Request $request, EntityManagerInterface $em)
    {
        $player = new Player;
        $form = $this->createForm(PlayerType::class, $player);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() )
        {
            $player->setCreatedAt(new \Datetime());
            $em->persist($player);
            $em->flush();

            $this->addFlash('success', 'Joueur ajouté avec succèes');

            return $this->redirectToRoute('app_welcome');
        }

        return $this->render('welcome/add.html.twig', [
                    'form' => $form->createView()
                ]);
    }
}
