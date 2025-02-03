<?php

namespace App\UI\Controller\Specialist;

use App\Application\Service\SpecialistService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    public function __construct(
        private readonly SpecialistService $specialistService
    ) {
    }

    /**
     * Afficher la liste des psychologues en mettant les psychologues "En ligne" en premier.
     */
    #[Route('/', name: 'psychologists_list', methods: ['GET'])]
    public function index(): Response
    {
        $psychologists = $this->specialistService->getAll();

        return $this->render('@UI/specialist/index.html.twig', [
            'psychologists' => $psychologists,
        ]);
    }
}
