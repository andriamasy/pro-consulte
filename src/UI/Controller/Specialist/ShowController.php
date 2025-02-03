<?php

namespace App\UI\Controller\Specialist;

use App\Application\Service\SpecialistService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShowController extends AbstractController
{
    #[Route('/psychologists/{id}', name: 'psychologist_details', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function __invoke(int $id, SpecialistService $specialistService): Response
    {
        // Récupérer le psychologue par ID
        $specialist = $specialistService->getDetail($id);

        // Si le psychologue n'existe pas, rediriger vers la liste
        if (!$specialist) {
            return $this->redirectToRoute('psychologists_list');
        }

        return $this->render('@UI/specialist/show.html.twig', [
            'specialist' => $specialist,
        ]);
    }
}
