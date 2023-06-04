<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AlbumPixiesController extends AbstractController
{

   

    #[Route('/insert/album', name: "insertAlbum")]
    public function insertAlbum(
        EntityManagerInterface $doctrine,
        Request $request,
        RouterInterface  $router,
        Security $security
    ) {
        if (!$security->isGranted('ROLE_ADMIN')) {
            $errorMessage = 'No tienes permiso para acceder a esa área.';
            $this->addFlash('error', $errorMessage);
            return $this->redirectToRoute('home');
        }


        $form = $this->createForm(AlbumFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $album = $form->getData();
            $ficheroImagen = $form->get('ficheroImagen')->getData();
            if ($ficheroImagen) {
                $fileName = uniqid() . '.' . $ficheroImagen->guessExtension();

                try {
                    $ficheroImagen->move(
                        $this->getParameter("kernel.project_dir") . '/public/assets/images',
                        $fileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }

            $album->setImagen("/assets/images/$fileName");
            // foreach ($album->getCanciones() as $cancion) {
            //     $cancion->setAlbum($album);
            // }
            $doctrine->persist($album);
            $doctrine->flush();
            return $this->redirectToRoute('listAlbums');
        }

        return $this->render('insertAlbum.html.twig', ['AlbumForm' => $form]);
    }

    #[Route("/edit/album/{id}", name: "editAlbum")]
    public function editAlbum(
        EntityManagerInterface $doctrine,
        Request $request,
        
        Security $security, $id
    ) {
        if (!$security->isGranted('ROLE_ADMIN')) {
            $errorMessage = 'No tienes permiso para acceder a esa área.';
            $this->addFlash('error', $errorMessage);
            return $this->redirectToRoute('home');
        }
        $repo = $doctrine->getRepository(Album::class);
        $album = $repo->find($id);  

        $form = $this->createForm(AlbumFormType::class, $album);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $album = $form->getData();
            $ficheroImagen = $form->get('ficheroImagen')->getData();
            if ($ficheroImagen) {
                $fileName = uniqid() . '.' . $ficheroImagen->guessExtension();

                try {
                    $ficheroImagen->move(
                        $this->getParameter("kernel.project_dir") . '/public/assets/images',
                        $fileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }

            $album->setImagen("/assets/images/$fileName");
            // foreach ($album->getCanciones() as $cancion) {
            //     $cancion->setAlbum($album);
            // }
            $doctrine->persist($album);
            $doctrine->flush();
            return $this->redirectToRoute('listAlbums');
        }

        return $this->render('insertAlbum.html.twig', ['AlbumForm' => $form, 'album' => $album]);
    }
 
    #[Route('list/albums', name: "listAlbums")]
    #[IsGranted("ROLE_USER")]
    public function listAlbums(EntityManagerInterface $doctrine)
    {

        $repo = $doctrine->getRepository(Album::class);
        $albums = $repo->findAll();
        return $this->render('albums.html.twig', ['albums' => $albums]);
    }

    #[Route('/contacto', name: "contacto")]
    public function contacto()
    {
        return $this->render('contacto.html.twig');
    }

    #[Route('/', name: "home")]
    public function getAlbums()
    {
        return $this->render('base.html.twig');
    }
}
