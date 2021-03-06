<?php

namespace App\Services;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class GenreService
{
    public function __construct(GenreRepository $genreRepository, EntityManagerInterface $manager)
    {
        $this->repository = $genreRepository;
        $this->manager = $manager;
    }

    public function deleteGenres(array $checkedGenres)
    {
        foreach ($checkedGenres as $id) {
            $genre = $this->repository->find($id);
            $this->manager->remove($genre);
        }
        $this->manager->flush();
    }

    public function createGenre(ParameterBag $post)
    {
        $formInput = $post->get('genre');
        $newGenre = new Genre();
        $newGenre->setName($formInput);

        return $newGenre;
    }
}
