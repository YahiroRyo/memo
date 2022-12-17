<?php

namespace Packages\Service\User\Command;

use Packages\Domain\User\Entities\UserForLogin;
use Packages\Domain\User\ValueObjects\Token;
use Packages\Infrastructure\Repositories\User\AuthUserRepository;

final class AuthUserService
{
    private AuthUserRepository $authUserRepository;

    public function __construct(AuthUserRepository $authUserRepository)
    {
        $this->authUserRepository = $authUserRepository;
    }

    public function loginUser(UserForLogin $userForLogin): Token
    {
        return $this->authUserRepository->loginUser($userForLogin);
    }
}
