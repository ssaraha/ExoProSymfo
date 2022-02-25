<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\PlayerRepository;
use App\Data\SearchPlayerData;
use App\Form\SearchFormPlayer;


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


    //dd($searchPlayerForm->getData());
        /*if( $searchPlayerForm->isSubmitted() )
        {
        }*/

       // $players = $pr->findBy([], ['createdAt' => 'DESC']);
        $players = $pr->findSearch($spd);
        //dd($players);
        return $this->render('welcome/index.html.twig',
            [
                'players' => $players,
                'form' => $searchPlayerForm->createView()
            ]
        );
    }
}
