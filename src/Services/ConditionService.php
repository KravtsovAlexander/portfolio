<?php

namespace App\Services;

use App\Entity\ProjectCondition;
use App\Repository\ProjectConditionRepository;
use Doctrine\ORM\EntityManagerInterface;

class ConditionService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function initConditions(): void
    {
        $conditions = ['Завершен', 'В разработке', 'Отменен'];

        foreach ($conditions as $value) {
            $condition = new ProjectCondition();
            $condition->setValue($value);
            $this->em->persist($condition);
        }

        $this->em->flush();
    }
}
