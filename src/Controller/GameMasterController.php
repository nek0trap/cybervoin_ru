<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameMasterController extends AbstractController
{
    /**
     * @Route("/game/create", name="app_game_master")
     */
    public function index(): Response
    {
        return $this->render('game_master/index.html.twig', [
            'controller_name' => 'GameMasterController',
        ]);
    }
}
