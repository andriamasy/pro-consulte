<?php

namespace App\UI\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// page personnalisée au lieu d’une simple erreur 403
class AccessDeniedController extends AbstractController
{
    #[Route('/access-denied', name: 'access_denied', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->render('security/access_denied.html.twig');
    }
}
