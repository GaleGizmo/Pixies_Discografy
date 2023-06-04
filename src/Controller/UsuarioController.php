<?php

namespace App\Controller;

use App\Form\UsuarioType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController {

    #[Route("/new/user",  name: "new_user")]
    public function createUser(Request $request, EntityManagerInterface $doctrine, UserPasswordHasherInterface $hasher) {
        $form = $this->createForm(UsuarioType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usuario = $form->getData();
            $password = $hasher->hashPassword($usuario, $usuario->getPassword());
            $usuario->setPassword($password);
            $usuario->setRoles(['ROLE_USER']);
            $doctrine->persist($usuario);
            $doctrine->flush();
            return $this->redirectToRoute('home');

    }

    return $this->render('usuarios/crearUsuario.html.twig', ['usuarioForm' => $form]);

}
}