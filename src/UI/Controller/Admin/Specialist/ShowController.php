<?php

namespace App\UI\Controller\Admin\Specialist;

use App\Application\Service\SpecialistService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShowController extends AbstractController
{
    #[Route('/admin/psychologists/{id}', name: 'admin_specialist_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function details(int $id, SpecialistService $specialistService): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('access_denied');
        }
        // Récupérer le psychologue par ID
        $specialist = $specialistService->getDetail($id);

        // Si le psychologue n'existe pas, rediriger vers la liste
        if (!$specialist) {
            return $this->redirectToRoute('psychologists_list');
        }

        return $this->render('@UI/admin/specialist/show.html.twig', [
            'psychologist' => $specialist,
        ]);
    }
}
