<?php

namespace App\Services;

use App\Entity\Label;
use App\Repository\LabelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class LabelService
{
    public function __construct(LabelRepository $labelRepository, EntityManagerInterface $manager)
    {
        $this->repository = $labelRepository;
        $this->manager = $manager;
    }

    public function deleteLabels(array $checkedLabels)
    {
        foreach ($checkedLabels as $id) {
            $label = $this->repository->find($id);
            $this->manager->remove($label);
        }
        $this->manager->flush();
    }

    public function createLabel(ParameterBag $post)
    {
        $formInput = $post->get('label');
        $newLabel = new Label();
        $newLabel->setName($formInput);

        return $newLabel;
    }
}
