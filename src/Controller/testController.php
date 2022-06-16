<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\CharacterStatsPreset;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Важный компонент, для роутинга
 */
use Symfony\Component\Routing\Annotation\Route;



class testController extends AbstractController
{
    /**
     * @Route("/stat")
     */
    public function number(Request $request): Response
    {
        $id = 1;
        $stats = $this->getDoctrine()->getManager()->find(CharacterStatsPreset::class, $id);
        dd($stats);
    }


    /**
     * @Route("/showPage", name="show_template")
     */
    public function showPage(): Response
    {
        return $this->render('library.html.twig');
    }

}