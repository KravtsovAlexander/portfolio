<?php

namespace App\Controller\Admin;

use App\Services\ContactsService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContactsController extends AbstractController
{
    private $service;

    public function __construct(ContactsService $contactsService) {
        $this->service = $contactsService;
    }

    /**
     * @Route("/admin/dashboard/contacts", name="contacts_management", methods={"GET"})
     */
    public function index(string $result = '', array $errors = [])
    {

        // если таблица с контактами пустая, то создастся поле с пустыми контактами
        // чтобы шаблон не выдавал ошибку при обращении к null
        if (null === $this->service->getContacts()) {
            $this->service->initContacts();
        }
        
        $contacts = $this->service->getContacts();
        $params = [
            'contacts' => $contacts,
            'result' => $result,
            'errors' => $errors
        ];
        $params = array_merge($params, $this->service->getMaxLength());

        return $this->render('admin/contacts/index.html.twig', $params);
    }

    /**
     * @Route("/admin/dashboard/contacts", name="edit_contacts", methods={"POST"})
     */
    public function editContacts(Request $request, ValidatorInterface $validator):Response
    {
        $post = $request->request;
        $em = $this->getDoctrine()->getManager();
        
        $newContacts = $this->service->setContacts($post);
        $errors = $validator->validate($newContacts);

        if (count($errors) > 0) {

            foreach ($errors as $error) {
                $prop = $error->getPropertyPath();
                $errorMsg = $error->getMessage();
                $arr[] = $prop . ': ' . $errorMsg;
            }

            $result = 'Данные не были добавлены';

            return $this->index($result, $arr);
        }

        $em->persist($newContacts);
        $em->flush();

        $result = 'Данные успешно изменены';
        return $this->index($result);
    }
}