<?php

namespace App\Controller;

use App\Entity\Character;
use http\Env\Request;
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

    /**
     * @Route("/game/char/form", name="app_create_char")
     */

    public function charForm(Request $request): Response
    {
        $tmpChar = new Character();
        return $this->render('game_master/index.html.twig', []);
    }
}
