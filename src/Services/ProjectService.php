<?php

namespace App\Services;

use App\Entity\Project;
use App\Repository\GenreRepository;
use App\Repository\LabelRepository;
use App\Repository\ProjectRepository;
use App\Repository\ProjectTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProjectConditionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProjectService
{
    private $em;
    private $repository;
    private $genRep;
    private $typeRep;
    private $condRep;
    private $labRep;
    private $container;
    private $filesystem;
    private $conditionService;
    private $typeService;

    public function __construct(
        EntityManagerInterface $em,
        Filesystem $filesystem,
        ContainerInterface $container,
        ProjectRepository $projectRepository,
        GenreRepository $genRep,
        ProjectTypeRepository $typeRep,
        ProjectConditionRepository $condRep,
        LabelRepository $labRep,
        ConditionService $conditionService,
        TypeService $typeService
    ) {
        $this->em = $em;
        $this->repository = $projectRepository;
        $this->genRep = $genRep;
        $this->typeRep = $typeRep;
        $this->condRep = $condRep;
        $this->labRep = $labRep;
        $this->container = $container;
        $this->filesystem = $filesystem;
        $this->conditionService = $conditionService;
        $this->typeService = $typeService;
    }

    public function buildNewProject (Request $request): Project
    {
        $post = $request->request;

        $project = new Project();
        $project->setTitle($post->get('title'));
        $project->setDescription($post->get('description'));

        foreach ($post->all('genres') as $id) {
            $genre = $this->genRep->find($id);
            $project->addGenre($genre);
        }

        $project->setProjectType(
            $this->typeRep->find($post->get('type'))
        );
        $project->setProjectCondition(
            $this->condRep->find($post->get('condition'))
        );
        $project->setWebVersionLink($post->get('web_version_link'));
        $project->setGooglePlayLink($post->get('googleplay_link'));
        $project->setAppStoreLink($post->get('appstore_link'));

        foreach ($post->all('labels') as $id) {
            $label = $this->labRep->find($id);
            $project->addLabel($label);
        }

        return $project;
    }

    public function getFormParameters(): array
    {
        $metadata = $this->em->getClassMetadata(Project::class);
        $titleLength = $metadata->fieldMappings['title']['length'];
        $linkLength = $metadata->fieldMappings['googlePlayLink']['length'];

        $genres = $this->genRep->findAll();

        $types = $this->typeRep->findAll();
        if (empty($types)) {
            $this->typeService->initTypes();
            $types = $this->typeRep->findAll();
        }

        $conditions = $this->condRep->findAll();
        if (empty($conditions)) {
            $this->conditionService->initConditions();
            $conditions = $this->condRep->findAll();
        }

        $labels = $this->labRep->findAll();

        return [
            'titleLength' => $titleLength,
            'linkLength' => $linkLength,
            'genres' => $genres,
            'types' => $types,
            'conditions' => $conditions,
            'labels' => $labels,
        ];
    }

    public function deleteImgFiles($images)
    {
        foreach ($images as $img) {
            $imgFiles[] = $this->container->getParameter('project_images') . '/' . $img->getFile();
        }
        if (isset($imgFiles)) $this->filesystem->remove($imgFiles);
    }

    public function validateImages($images): bool
    {
        $pattern = "/(jpe?g)|(png)/";
        foreach ($images as $img) {
            if (!($img->isValid()
                && preg_match($pattern, $img->guessExtension()))) {

                return false;
            }
        }
        return true;
    }
    
    public function saveImage(object $img): string
    {
        $file_name = uniqid() . '.' . $img->guessExtension();
        $directory = $this->container->getParameter('project_images');
        $img->move($directory, $file_name);

        return $file_name;
    }
}
