<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class GameMasterController extends AbstractController
{
    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    /**
     * @Route("/game/create", name="gameM_menu")
     */
    public function index(): Response
    {
        return $this->render('game_master/index.html.twig', [
            'controller_name' => 'GameMasterController',
        ]);
    }

    /**
     * @Route("/game/char/form", name="gameM_create_char")
     */

    public function charForm(Request $request): Response
    {
        $tmpChar = new Character();
        $form = $this->createForm(CharType::class, $tmpChar);

        $form->handleRequest($request);
        $user = $this->security->getUser();

        if($form->isSubmitted() && $form->isValid())
        {
            $tmpChar->setAuthor($user->getId());
            $tmpChar->setDateCreateChar(time());

            $this->getDoctrine()->getManager()->persist($tmpChar);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('gamemaster/createForm.html.twig', [
            'formStep1' => $form->createView(),
        ]);
    }
}
