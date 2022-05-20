<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\Game;
use App\Entity\GameBoard;
use App\Entity\Weapon;
use App\Form\CharType;
use App\Form\GameBoardType;
use App\Form\GameType;
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
     * @Route("/game/character/list", name="gamemaster_character_list")
     */
    public function index(): Response
    {
        $user = $this->security->getUser();

        $chars = $this->getDoctrine()->getManager()
            ->getRepository(Character::class)
            ->findBy(['author' => $user->getId()],[]);


        return $this->render('admin/characters/list.html.twig', [
            'characters' => $chars,
        ]);
    }

    /**
     * @Route("/game/character/form", name="gamemaster_create_char")
     */

    public function charForm(Request $request): Response
    {
        $tmpChar = new Character();

        $weapons = $this->getDoctrine()->getManager()
            ->getRepository(Weapon::class)
            ->findBy([],[]);


        foreach ($weapons as $weapon)
        {
            $tmpChar->getGuns()->add($weapon);
        }



        $form = $this->createForm(CharType::class, $tmpChar);

        $form->handleRequest($request);
        $user = $this->security->getUser();

        if($form->isSubmitted() && $form->isValid())
        {
            $tmpChar->setAuthor($user->getId());
            $tmpChar->setDateCreateChar(time());

            $tmpGuns = $tmpChar->getGuns();
            $guns = array();
            foreach ($tmpGuns as $gun)
            {
                $tmp = array($gun->getName() => $gun->getDamage());
                array_push($guns, $tmp);
            }

            $tmpChar->setWeapons($guns);

            $this->getDoctrine()->getManager()->persist($tmpChar);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gamemaster_character_list');
        }

        return $this->render('gamemaster/createForm.html.twig', [
            'form' => $form->createView(),
            'back_path' => 'gamemaster_create_char'
        ]);
    }


    /**
     * @Route("/game/create/game", name="gamemaster_create_game")
     */
    public function createGame(Request $request): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);

        $form->handleRequest($request);
        $user = $this->security->getUser();

        if($form->isSubmitted() && $form->isValid())
        {
            $game->setAuthor($user->getId());
            $game->setGameadmin($user->getId());

            $this->getDoctrine()->getManager()->persist($game);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gamemaster_list_game');
        }

        return $this->render('gamemaster/createForm.html.twig', [
            'form' => $form->createView(),
            'back_path' => 'gamemaster_create_game'
        ]);
    }

    /**
     * @Route("/game/list", name="gamemaster_list_game")
     */
    public function showGames(): Response
    {
        $user = $this->security->getUser();
        $games = $this->getDoctrine()->getManager()->getRepository(Game::class)->findBy(['author'=>$user->getId()]);

        return $this->render('gamemaster/games_list.html.twig', [
            'games' => $games,
        ]);
    }

    /**
     * @Route("/game/{id}", name="game_byId")
     */

    public function getGameById($id): Response
    {

        $game = $this->getDoctrine()->getManager()->getRepository(Game::class)->findBy(['id' => $id], []);
        $user = $this->security->getUser();
        if($game[0]->getGameadmin() !== $user->getId())
        {
            return $this->redirectToRoute("gamemaster_list_game");
        }



        return $this->render('gamemaster/game.html.twig', [
            'game' => $game[0],
            ]);
    }
}
