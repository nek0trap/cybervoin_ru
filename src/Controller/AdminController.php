<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/help/createUser", name="admin_faq_user")
     */
    public function createUser(): Response
    {
        return $this->render('admin/help/createUser.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/characters/list", name="admin_char_list")
     */
    public function showCharacter(): Response
    {
        $chars = $this->getDoctrine()->getManager()
            ->getRepository(Character::class)
            ->findBy([],[]);


        return $this->render('admin/characters/list.html.twig', [
            'characters' => $chars,
        ]);
    }

    /**
     * @Route("/admin/characters/{id}", name="admin_char_byId")
     */
    public function charByID($id): Response
    {
        $char = $this->getDoctrine()->getManager()->find(Character::class, $id);

        if ($char === null) {
            throw $this->createNotFoundException(sprintf("Not found id, %s", $id));
        }

        return $this->render('admin/characters/character.html.twig', [
            'charcter' => $char,
        ]);
    }

    /**
     * @Route("/admin/characters/{id}/edit", name="admin_char_byId_edit")
     */
    public function editFormCharByID($id): Response
    {
        $char = $this->getDoctrine()->getManager()->find(Character::class, $id);

        if ($char === null) {
            throw $this->createNotFoundException(sprintf("Not found id, %s", $id));
        }

        return $this->render('admin/characters/character.html.twig', [
            'charcter' => $char,
        ]);
    }

    /**
     * @Route("/admin/characters/{id}/delete", name="admin_char_byId_delete")
     */
    public function deleteCharById($id): Response
    {
        $strng = "IS NOT WORKING";
        dd($strng);
        $char = $this->getDoctrine()->getManager()->find(Character::class, $id);

        if ($char === null) {
            throw $this->createNotFoundException(sprintf("Not found id, %s", $id));
        }

        return $this->render('admin/characters/character.html.twig', [
            'charcter' => $char,
        ]);
    }

    /**
     * @Route("/admin/createPost", name="admin_char_byId_delete")
     */
    public function createPostForm(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $post->setDateCreatePost(time());
            $post->setAuthor($this->getUser());
            $this->getDoctrine()->getManager()->persist($post);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('home_page');
        }

        return $this->render('admin/forms/post_create_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
