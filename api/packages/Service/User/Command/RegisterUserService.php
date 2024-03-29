<?php

namespace Packages\Service\User\Command;

use Packages\Domain\User\Entities\InitUser;
use Packages\Domain\User\ValueObjects\Token;
use Packages\Exceptions\User\UserExistsException;
use Packages\Infrastructure\Repositories\User\RegisterUserRepository;
use Packages\Infrastructure\Repositories\User\UserRepository;

final class RegisterUserService
{
    private RegisterUserRepository $registerUserRepository;
    private UserRepository $userRepository;

    public function __construct(
        RegisterUserRepository $registerUserRepository,
        UserRepository $userRepository
    ) {
        $this->registerUserRepository = $registerUserRepository;
        $this->userRepository = $userRepository;
    }

    public function register(InitUser $initUser): Token
    {
        return $this->registerUserRepository->register($initUser);
    }
}
