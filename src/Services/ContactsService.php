<?php

namespace App\Services;

use App\Entity\Contacts;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class ContactsService
{
    private $em;
    private $md;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->md = $em->getClassMetadata(Contacts::class);
    }

    public function getMaxLength(): array
    {
        return [
            'phoneLength' => $this->md->fieldMappings['phone']['length'],
            'emailLength' => $this->md->fieldMappings['email']['length'],
            'vkLength' => $this->md->fieldMappings['vk']['length'],
            'instagramLength' => $this->md->fieldMappings['instagram']['length'],
            'telegramLength' => $this->md->fieldMappings['telegram']['length'],
        ];
    }

    public function initContacts(): void
    {
        $emptyContacts = new Contacts();
        $emptyContacts->setId('contacts');
        $this->em->persist($emptyContacts);
        $this->em->flush();
    }

    public function getContacts(): ?object
    {
        return $this->em
            ->getRepository(Contacts::class)
            ->find('contacts');
    }

    public function setContacts(ParameterBag $post)
    {
        $newContacts = $this->getContacts();

        $newContacts->setEmail($post->get('email'));
        $newContacts->setPhone($post->get('phone'));
        $newContacts->setVk($post->get('vk'));
        $newContacts->setInstagram($post->get('instagram'));
        $newContacts->setTelegram($post->get('telegram'));

        return $newContacts;
    }

    public function getPhoneNum(): string
    {
        return $this->getContacts()->getPhone();
    }

    public function getEmail(): string
    {
        return $this->getContacts()->getEmail();
    }
}
