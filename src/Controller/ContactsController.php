<?php

namespace App\Controller;

use App\Services\ContactsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactsController extends AbstractController
{
    /**
     * @Route("/contacts", name="contacts")
     */
    public function index(ContactsService $contactsService): Response
    {
        $contacts = $contactsService->getContacts();
        return $this->render('contacts/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/contacts/redirect/{go_to}", name="contacts_redirect")
     */
    public function contactRedirect($go_to, ContactsService $contactsService)
    {
        $contacts = $contactsService->getContacts();

        if (isset($contacts)) {
            if ($go_to === 'vk') {
                if ($vk = $contacts->getVk()) return $this->redirect($vk);
            } elseif ($go_to === 'instagram') {
                if ($inst = $contacts->getInstagram()) return $this->redirect($inst);
            } elseif ($go_to === 'telegram') {
                if ($telegr = $contacts->getTelegram()) return $this->redirect($telegr);
            }
        }

        return $this->redirectToRoute('home');
    }
}
