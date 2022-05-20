<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvatarsController extends AbstractController
{
    /**
     * @Route("/avatars", name="avatar_folder")
     */
    public function index(): Response
    {
        return $this->render('avatars/index.html.twig', [
            'controller_name' => 'AvatarsController',
        ]);
    }

    /**
     * @route("/avatar/upload/form", name="upload_avatar_on_server")
     */
    public function uploadAvatar(Request $request): Response
    {
        return $this->render('base.html.twig');
    }
}
