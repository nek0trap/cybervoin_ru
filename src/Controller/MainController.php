<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/mm", name="main_menu")
     */
    public function showMenu(): Response
    {
        return $this->render('main_menu/index.html.twig', [
            'controller_name' => 'MainMenuController',
        ]);
    }


    /**
     * @Route("/", name="home_page")
     */
    public function index(): Response
    {
        return $this->redirectToRoute("main_menu");
    }

    /**
     * @Route("/showCharacter", name="eg_char")
     */
    public function showCharacter(): Response
    {

        $character = [
            'charname' => 'Пример имени чара☑',
            'charclass' => 'Класс чара☑',
            'starting_hits' => '15☑',
            'seriously_wounded' => '7☑',
            'death_save' => '10☑',
            'int' => '2☑',
            'ref' => '3☑',
            'dex' => '9☑',
            'tech' => '2☑',
            'cool' => '7☑',
            'will' => '6☑',
            'luck' => '9☑',
            'move' => '8☑',
            'body' => '10☑',
            'emp' => '1☑',
            'просто для того чтобы видеть разделение' => 'пиздец я заебался эту галочку делать "☑"',
            'skills' => [
                'skill1' => 'Скилл №1',
                'skill2' => 'Крутой скилл #2',
                'skill3' => 'хз, кончились идеи',
                'skill4' => 'Скилл №1',
                'skill5' => 'Крутой скилл #2',
                'skill6' => 'хз, кончились идеи',
                'skill7' => 'Скилл №1',
                'skill8' => 'Крутой скилл #2',
                'skill9' => 'хз, кончились идеи',
                'skill10' => 'Скилл №1',
                'skill11' => 'Крутой скилл #2',
                'skill12' => 'хз, кончились идеи',
                'skill13' => 'Ограничений нет))) ',
            ],
            'armor' => [
                'armor1' => 'вообще не ебу че это',
                'armor2' => 'но пусть будет'
            ],
            'weapons' => [
                'weapon1' => 'пушка №1',
                'weapon2' => 'пушка №2',
                'weapon3' => 'Просто кулак ебать'
            ]
        ];

        return $this->render('character-sheet.html.twig', [
            'charcter' => $character,
        ]);
    }
    
    /**
     * @Route("/testlogin")
     */
    public function testlogin(): Response
    {
        return $this->render('test-login.html.twig');
    }
}
