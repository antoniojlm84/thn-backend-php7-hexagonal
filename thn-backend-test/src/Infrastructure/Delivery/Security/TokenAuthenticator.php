<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Delivery\Security;

use Lexik\Bundle\JWTAuthenticationBundle\Security\Authenticator\JWTAuthenticator;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\User\User;
use Thn\BackendTest\Domain\Model\User\UserRepository;

class TokenAuthenticator extends JWTAuthenticator
{
    /** @var UserRepository  */
    private $userRepository;

    public function __construct(
        JWTTokenManagerInterface $jwtManager,
        EventDispatcherInterface $eventDispatcher,
        TokenExtractorInterface $tokenExtractor,
        UserProviderInterface $userProvider,
        UserRepository $userRepository
    ){
        parent::__construct($jwtManager, $eventDispatcher, $tokenExtractor, $userProvider);
        $this->userRepository = $userRepository;
    }

    protected function loadUser(array $payload, string $identity): UserInterface
    {
        $user = $this->userRepository->byEmail(new Email($identity));

        if ($user) {
            return $user;
        }

        throw new UserNotFoundException(
            sprintf('Username "%s" does not exist.', $identity)
        );
    }

    public function supports(Request $request): bool
    {
        return $request->headers->has('auth');
    }
}