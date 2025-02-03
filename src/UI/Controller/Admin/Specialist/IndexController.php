<?php

namespace App\UI\Controller\Admin\Specialist;

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
    #[Route('/admin', name: 'admin_specialist_list', methods: ['GET'])]
    public function index(): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('access_denied');
        }

        $specialists = $this->specialistService->getAll();

        return $this->render('@UI/admin/specialist/index.html.twig', [
            'specialists' => $specialists,
        ]);
    }
}
