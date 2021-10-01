<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\User\Login;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Thn\BackendTest\Domain\Model\User\PasswordEncoder;
use Thn\BackendTest\Domain\Model\User\SecurityUserRepository;
use Thn\BackendTest\Domain\Model\User\UserRepository;
use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\User\Exception\UserNotFound;
use Thn\BackendTest\Domain\Model\User\UserPassword;
use Thn\BackendTest\Domain\Model\User\UserToken;

class LoginQueryService
{
    /** @var SecurityUserRepository */
    private $userRepository;

    /** @var PasswordEncoder */
    private $passwordEncoder;

    /** @var LoginDataTransformer */
    private $loginDataTransformer;

    /** @var string */
    private $tokenTtl;

    public function __construct(
        UserRepository $userRepository,
        PasswordEncoder $passwordEncoder,
        LoginDataTransformer $loginDataTransformer,
        JWTEncoderInterface $jwtEncoder,
        string $tokenTtl
    ) {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
        $this->loginDataTransformer = $loginDataTransformer;
        $this->jwtEncoder = $jwtEncoder;
        $this->tokenTtl = $tokenTtl;
    }

    public function execute(
        Email $email,
        UserPassword $password
    ) {
        $user = $this->userRepository->byEmail($email);

        if (null === $user || true === $user->deleted()) {
            throw new UserNotFound();
        }

        $this->passwordEncoder->verify($password->value(), $user->password()->value());

        $expTime = time() + (int) $this->tokenTtl;
        $token = $this->jwtEncoder->encode([
            'username' => $email->value(),
            'exp' => $expTime
        ]);

        $userToken = new UserToken($token, $expTime);

        $this->loginDataTransformer->write(
            new LoginQueryResponse(
                $userToken,
                'bearer'
            )
        );

        return $this->loginDataTransformer->read();
    }
}
