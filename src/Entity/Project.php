<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\NotBlank
     * @Assert\Length(max = 45, normalizer = "trim")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max = 255, normalizer = "trim")
     * @Assert\Url
     */
    private $googlePlayLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max = 255, normalizer = "trim")
     * @Assert\Url
     */
    private $appStoreLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max = 255, normalizer = "trim")
     * @Assert\Url
     */
    private $webVersionLink;

    /**
     * @ORM\ManyToOne(targetEntity=ProjectCondition::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     */
    private $projectCondition;

    /**
     * @ORM\OneToMany(targetEntity=ProjectImage::class, mappedBy="project", cascade={"persist", "remove"})
     */
    private $projectImages;

    /**
     * @ORM\OneToOne(targetEntity=ProjectVideo::class, mappedBy="project", cascade={"persist", "remove"})
     */
    private $projectVideo;

    /**
     * @ORM\ManyToOne(targetEntity=ProjectType::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     */
    private $projectType;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, mappedBy="projects")
     */
    private $genres;

    /**
     * @ORM\ManyToMany(targetEntity=Label::class, mappedBy="projects")
     */
    private $labels;

    public function __construct()
    {
        $this->projectImages = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->labels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGooglePlayLink(): ?string
    {
        return $this->googlePlayLink;
    }

    public function setGooglePlayLink(?string $googlePlayLink): self
    {
        $this->googlePlayLink = $googlePlayLink;

        return $this;
    }

    public function getAppStoreLink(): ?string
    {
        return $this->appStoreLink;
    }

    public function setAppStoreLink(?string $appStoreLink): self
    {
        $this->appStoreLink = $appStoreLink;

        return $this;
    }

    public function getWebVersionLink(): ?string
    {
        return $this->webVersionLink;
    }

    public function setWebVersionLink(?string $webVersionLink): self
    {
        $this->webVersionLink = $webVersionLink;

        return $this;
    }

    public function getProjectCondition(): ?ProjectCondition
    {
        return $this->projectCondition;
    }

    public function setProjectCondition(?ProjectCondition $projectCondition): self
    {
        $this->projectCondition = $projectCondition;

        return $this;
    }

    /**
     * @return Collection|ProjectImage[]
     */
    public function getProjectImages(): Collection
    {
        return $this->projectImages;
    }

    public function addProjectImage(ProjectImage $projectImage): self
    {
        if (!$this->projectImages->contains($projectImage)) {
            $this->projectImages[] = $projectImage;
            $projectImage->setProject($this);
        }

        return $this;
    }

    public function removeProjectImage(ProjectImage $projectImage): self
    {
        if ($this->projectImages->removeElement($projectImage)) {
            // set the owning side to null (unless already changed)
            if ($projectImage->getProject() === $this) {
                $projectImage->setProject(null);
            }
        }

        return $this;
    }

    public function getProjectVideo(): ?ProjectVideo
    {
        return $this->projectVideo;
    }

    public function setProjectVideo(ProjectVideo $projectVideo): self
    {
        // set the owning side of the relation if necessary
        if ($projectVideo->getProject() !== $this) {
            $projectVideo->setProject($this);
        }

        $this->projectVideo = $projectVideo;

        return $this;
    }

    public function getProjectType(): ?ProjectType
    {
        return $this->projectType;
    }

    public function setProjectType(?ProjectType $projectType): self
    {
        $this->projectType = $projectType;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
            $genre->addProject($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeProject($this);
        }

        return $this;
    }

    /**
     * @return Collection|Label[]
     */
    public function getLabels(): Collection
    {
        return $this->labels;
    }

    public function addLabel(Label $label): self
    {
        if (!$this->labels->contains($label)) {
            $this->labels[] = $label;
            $label->addProject($this);
        }

        return $this;
    }

    public function removeLabel(Label $label): self
    {
        if ($this->labels->removeElement($label)) {
            $label->removeProject($this);
        }

        return $this;
    }
}
