<?php

namespace App\UI\Controller\Admin\Appel;

use App\Application\Service\AppelService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/admin/appels', name: 'admin_appels_index', methods: ['GET'])]
    public function index(AppelService $appelService)
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('access_denied');
        }

        // Récupère tous les appels
        $appels = $appelService->findAll();

        // Rendu de la vue en passant les appels récupérés
        return $this->render('@UI/admin/appels/index.html.twig', [
            'appels' => $appels,
        ]);
    }
}
