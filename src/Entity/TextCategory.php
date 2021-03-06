<?php

namespace App\Entity;

use App\Repository\TextCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TextCategoryRepository::class)
 */
class TextCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=TextExample::class, mappedBy="category", orphanRemoval=true)
     */
    private $textExamples;

    public function __construct()
    {
        $this->textExamples = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|TextExample[]
     */
    public function getTextExamples(): Collection
    {
        return $this->textExamples;
    }

    public function addTextExample(TextExample $textExample): self
    {
        if (!$this->textExamples->contains($textExample)) {
            $this->textExamples[] = $textExample;
            $textExample->setCategory($this);
        }

        return $this;
    }

    public function removeTextExample(TextExample $textExample): self
    {
        if ($this->textExamples->removeElement($textExample)) {
            // set the owning side to null (unless already changed)
            if ($textExample->getCategory() === $this) {
                $textExample->setCategory(null);
            }
        }

        return $this;
    }
}
