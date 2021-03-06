<?php

namespace App\Entity;

use App\Repository\ContactsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContactsRepository::class)
 */
class Contacts
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max = 255, normalizer = "trim")
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     * @Assert\Length(max = 12, normalizer = "trim")
     * @Assert\Regex("/^(8|\+7)\d{10}$/")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Assert\Length(max = 45, normalizer = "trim")
     * @Assert\Url(message="Невалидный URL адрес")
     */
    private $vk;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Assert\Length(max = 45, normalizer = "trim")
     * @Assert\Url
     */
    private $telegram;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Assert\Length(max = 45, normalizer = "trim")
     * @Assert\Url
     */
    private $instagram;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getVk(): ?string
    {
        return $this->vk;
    }

    public function setVk(?string $vk): self
    {
        $this->vk = $vk;

        return $this;
    }

    public function getTelegram(): ?string
    {
        return $this->telegram;
    }

    public function setTelegram(?string $telegram): self
    {
        $this->telegram = $telegram;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }
}
