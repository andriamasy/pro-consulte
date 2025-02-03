<?php

namespace App\Infrastructure\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class LoginFormAuthenticator extends AbstractLoginFormAuthenticator
{
    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly AuthorizationCheckerInterface $authorizationChecker
    ) {
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->get('username', '');

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->get('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }

    /**
     * si authentification success.
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            return new RedirectResponse($this->urlGenerator->generate('admin_specialist_list'));
        }

        return new RedirectResponse($this->urlGenerator->generate('psychologists_list'));

    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate('app_login');
    }

    protected function getDefaultSuccessRedirectUrl(): string
    {
        return $this->urlGenerator->generate('psychologists_list');
    }
}
