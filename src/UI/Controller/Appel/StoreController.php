<?php

namespace App\UI\Controller\Appel;

use App\Application\Service\AppelService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class StoreController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/specialist/call', name: 'specialist_call', methods: ['POST'])]
    public function __invoke(Request $request, AppelService $appelService): JsonResponse
    {
        try {
            $appelService->store($request->request->all());

            return $this->json([
                'success' => true,
                'message' => 'Appel est enregistré evec succès .',
            ]);
        } catch (Exception $exception) {
            throw new Exception('Something went wrong' . $exception->getMessage());
        }
    }
}
