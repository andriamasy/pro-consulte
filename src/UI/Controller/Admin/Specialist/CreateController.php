<?php

namespace App\UI\Controller\Admin\Specialist;

use App\Application\Service\SpecialistService;
use App\Infrastructure\Form\SpecialistType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreateController extends AbstractController
{
    public function __construct(
        private readonly SpecialistService $specialistService
    ) {
    }

    /**
     * @throws Exception
     */
    #[Route('/admin/psychologists/new', name: 'admin_psychologists_new', methods: ['POST', 'GET'])]
    public function create(Request $request): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('access_denied');
        }

        $form = $this->createForm(SpecialistType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $data = $form->getData();
            // Appel du service pour créer un psychologue
            $this->specialistService->store($data);

            // Message de succès
            $this->addFlash('success', 'Psychologue est enregistré avec succès .');

            // Redirection
            return $this->redirectToRoute('admin_specialist_list');
        }

        return $this->render('@UI/admin/specialist/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
