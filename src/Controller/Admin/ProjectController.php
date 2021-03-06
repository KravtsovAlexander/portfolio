<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Entity\ProjectImage;
use App\Services\ProjectService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProjectController extends AbstractController
{
    private $service;

    public function __construct(ProjectService $projectService)
    {
        $this->service = $projectService;
    }
    /**
     * @Route("/admin/dashboard/projects", name="projects_management", methods={"GET"})
     */
    public function index()
    {
        $projects = $this->getDoctrine()
            ->getRepository(Project::class)
            ->findAll();

        return $this->render('admin/projects/index.html.twig', [
            'projects' => $projects
        ]);
    }

    /**
     * @Route("/admin/dashboard/projects/delete/{id}", name="delete_project", methods={"POST"})
     */
    public function deleteProject($id)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository(Project::class)->find($id);
        $em->remove($project);
        $em->flush();
        //удаление изображений из хранилища
        $this->service->deleteImgFiles($project->getProjectImages());

        return $this->redirectToRoute('projects_management');
    }


    /**
     * @Route("/admin/dashboard/projects/add-project", name="form_project", methods={"GET"})
     */
    public function formAction()
    {
        // массив с данными для валидации на клиенте и чекбоксами
        $params = $this->service->getFormParameters();

        return $this->render('admin/projects/add_project.html.twig', $params);
    }

    /**
     * @Route("/admin/dashboard/projects/add-project", name="add_project", methods={"POST"})
     */
    public function addProject(Request $request, ValidatorInterface $validator)
    {
        $em = $this->getDoctrine()->getManager();
        // создание объекта проекта без изображений
        $newProject = $this->service->buildNewProject($request);
        // его валидация
        $errors = $validator->validate($newProject);

        if (count($errors)) {
            return new Response((string) $errors);
        }

        // валидация изображений
        $images = $request->files->get('images');
        $isValid = $this->service->validateImages($images);

        if (!$isValid) {
            return new Response('Что-то не так с изображениями', 415);
        }

        // сохранение изображений и добавление их в объект проекта
        foreach ($images as $img) {
            $file_name = $this->service->saveImage($img);
            $image = new ProjectImage();
            $image->setFile($file_name);
            $newProject->addProjectImage($image);
            $em->persist($image);
        }

        $em->persist($newProject);
        $em->flush();

        return $this->index();
    }
}
