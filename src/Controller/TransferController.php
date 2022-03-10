<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\TransferRepository;
use App\Form\SearchFormTransfer;
use App\Data\SearchTransferData;
/**
 * @Route("/transfer")
 * 
 **/
class TransferController extends AbstractController
{
    /**
     * @Route("/", name="app_list_transfer")
     */
    public function index(Request $request, TransferRepository $tr): Response
    {
        $data = new SearchTransferData();
        $form = $this->createForm(SearchFormTransfer::class, $data);
        $form->handleRequest($request);

        $transfers = $tr->searchTransfer($data);
        //dd($data);
        //$transfers = $tr->findBy([], ['createdAt'=> 'DESC']);
        //dd($transfers);
        return $this->render('transfer/index.html.twig', [
            'transfers' => $transfers,
            'form' => $form->createView()
        ]);
    }
}
