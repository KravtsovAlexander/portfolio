<?php

namespace App\Controller\Admin;

use App\Entity\Label;
use App\Services\LabelService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LabelController extends AbstractController
{
    private $service;

    public function __construct(LabelService $labelService) {
        $this->service = $labelService;
    }
    /**
     * @Route("/admin/dashboard/labels", name="labels_management")
     */
    public function index(): Response
    {
        $labels = $this->getDoctrine()
            ->getRepository(Label::class)
            ->findAll();
        $metadata = $this->getDoctrine()
            ->getManager()
            ->getClassMetadata(Label::class)
            ->fieldMappings;

        return $this->render('admin/labels/index.html.twig', [
            'labels' => $labels,
            'labelLength' => $metadata['name']['length']
        ]);
    }
    /**
     * @Route("/admin/dashboard/add-label", name="add_label", methods={"POST"})
     */
    public function addLabel(Request $request, ValidatorInterface $validator): Response
    {
        $post = $request->request;
        $em = $this->getDoctrine()->getManager();
        $newLabel = $this->service->createLabel($post);
        $errors =  $validator->validate($newLabel);

        if (count($errors)) {
            return new Response((string) $errors);
        }

        $em->persist($newLabel);
        $em->flush();

        return $this->redirectToRoute('labels_management');
    }

    /**
     * @Route("/admin/dashboard/delete-label", name="delete_label", methods={"POST"})
     */
    public function deleteLabel(Request $request): Response
    {
        $checkedLabels = $request->request->get('delete');

        if (isset($checkedLabels)) {
            $this->service->deleteLabels($checkedLabels);
        }

        return $this->redirectToRoute('labels_management');
    }
}
