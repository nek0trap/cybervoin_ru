<?php

namespace App\Controller;

use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Armor;
use App\Entity\Character;
use App\Entity\Cyberware;
use App\Form\CyberwareType;
use App\Form\GearType;
use App\Entity\Game;
use App\Entity\GameBoard;
use App\Entity\Gear;
use App\Entity\Weapon;
use App\Form\CharacterType;
use App\Form\GameType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;


class GameMasterController extends AbstractController
{
    /**
     * @Route("/game/character/list", name="gamemaster_character_list")
     */
    public function index(): Response
    {
        $user = $this->getUser();

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
            ->findBy([]);
        foreach ($weapons as $weapon)
        {
            $tmpChar->getGuns()->add($weapon);
        }
        $armor = $this->getDoctrine()->getManager()
            ->getRepository(Armor::class)
            ->findBy([]);
        foreach ($armor as $armorSet)
        {
            $tmpChar->getArmors()->add(($armorSet));
        }
        $gears = $this->getDoctrine()->getManager()
            ->getRepository(Gear::class)
            ->findBy([]);
        foreach ($gears as $gear)
        {
            $tmpChar->getGears()->add($gear);
        }
        $cyberwares = $this->getDoctrine()->getManager()
            ->getRepository(Cyberware::class)
            ->findBy([]);
        foreach ($cyberwares as $cyberware)
        {
            $tmpChar->getCyberwares()->add($cyberware);
        }

        $form = $this->createForm(CharacterType::class, $tmpChar);

        $form->handleRequest($request);
        $user = $this->getUser();

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

            $tmpArmors = $tmpChar->getArmors();
            $armors = array();
            foreach ($tmpArmors as $armor) {
                $armors[] = [
                    'name' => $armor->getName(),
                    'body' => $armor->getBody(),
                    'head' => $armor->getHead()
                ];
            }
            $tmpChar->setArmor($armors);

            $tmpGears = $tmpChar->getGears();
            $gears = array();
            foreach ($tmpGears as $gear) {
                $gears[] = [
                    'name' => $gear->getName(),
                    'description' => $gear->getDescription(),
                ];
            }
            $tmpChar->setGear($gears);

            $tmpCyberwares = $tmpChar->getCyberwares();
            $cyberwares = array();
            foreach ($tmpCyberwares as $cyberware) {
                $cyberwares[] = [
                    'name' => $cyberware->getName(),
                    'description' => $cyberware->getDescription(),
                ];
            }
            $tmpChar->setCyberware($cyberwares);


            $this->getDoctrine()->getManager()->persist($tmpChar);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gamemaster_character_list');
        }

        return $this->render('gamemaster/createForm.html.twig', [
            'char_create_form' => $form->createView(),
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
        $user = $this->getUser();

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
        $user = $this->getUser();
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
        $game = $this->getDoctrine()->getManager()->getRepository(Game::class)->findByOne(['id' => $id]);
        $user = $this->getUser();
        if($game[0]->getGameadmin() !== $user->getId())
        {
            return $this->redirectToRoute("gamemaster_list_game");
        }

        return $this->render('gamemaster/game.html.twig', [
            'game' => $game[0],
            ]);
    }

    /**
     * @Route("/game/board/{id}", name="game_board_byId")
     */
    public function getGameBoardById($id, Request $request)
    {

        $gameboard = $this->getDoctrine()->getManager()->getRepository(GameBoard::class)->findOneBy(['id' => 1]);



        $data = $request->request->get('charArray');
        if ($data) {
            $gameboard->setCharactersArray(explode(',',$data));
            $this->getDoctrine()->getManager()->persist($gameboard);
            $this->getDoctrine()->getManager()->flush();
            return new JsonResponse(explode(',',$data));
        }

        return $this->render('gamemaster/gameboard.html.twig', [
            'gameboard' => $gameboard,
        ]);
    }


    public function saveGameBoard(Request $request)
    {
    }
}
