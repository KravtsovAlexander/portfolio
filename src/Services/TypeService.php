<?php

namespace App\Services;

use App\Entity\ProjectType;
use Doctrine\ORM\EntityManagerInterface;

class TypeService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function initTypes(): void
    {
        $types = ['Личный', 'Коммерческий'];

        foreach ($types as $value) {
            $type = new ProjectType();
            $type->setValue($value);
            $this->em->persist($type);
        }

        $this->em->flush();
    }
}
