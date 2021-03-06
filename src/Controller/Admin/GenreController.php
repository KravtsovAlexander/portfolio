<?php

namespace App\Controller\Admin;

use App\Entity\Genre;
use App\Services\GenreService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GenreController extends AbstractController
{
    private $service;

    public function __construct(GenreService $genreService) {
        $this->service = $genreService;
    }
    /**
     * @Route("/admin/dashboard/genres", name="genres_management")
     */
    public function index(): Response
    {
        $genres = $this->getDoctrine()
            ->getRepository(Genre::class)
            ->findAll();
        $metadata = $this->getDoctrine()
            ->getManager()
            ->getClassMetadata(Genre::class)
            ->fieldMappings;

        return $this->render('admin/genres/index.html.twig', [
            'genres' => $genres,
            'genreLength' => $metadata['name']['length']
        ]);
    }
    /**
     * @Route("/admin/dashboard/add-genre", name="add_genre", methods={"POST"})
     */
    public function addGenre(Request $request, ValidatorInterface $validator): Response
    {
        $em = $this->getDoctrine()->getManager();
        $post = $request->request;
        $newGenre = $this->service->createGenre($post);
        $errors =  $validator->validate($newGenre);

        if (count($errors)) {
            return new Response((string) $errors);
        }

        $em->persist($newGenre);
        $em->flush();

        return $this->redirectToRoute('genres_management');
    }

    /**
     * @Route("/admin/dashboard/delete-genre", name="delete_genre", methods={"POST"})
     */
    public function deleteGenre(Request $request): Response
    {
        $checkedGenres = $request->request->get('delete');
        if (isset($checkedGenres)) {
            $this->service->deleteGenres($checkedGenres);
        }

        return $this->redirectToRoute('genres_management');
    }
}
