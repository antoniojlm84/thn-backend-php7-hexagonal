<?php

namespace Thn\BackendTest\Domain\Model\SecurityUser;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Serializable;
use Thn\BackendTest\Domain\Model\DeleteTrait;
use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\User\User;
use Thn\BackendTest\Domain\Model\User\UserId;
use Thn\BackendTest\Domain\Model\User\UserPassword;
use Thn\BackendTest\Domain\Model\User\UserRole;

class SecurityUser implements UserInterface, EquatableInterface, Serializable, SecurityUserInterface
{
    use DeleteTrait;

    /** @var UserId */
    protected $id;

    /** @var string */
    private $salt;

    /** @var UserRole */
    protected $role;

    /** @var UserPassword */
    protected $password;

    /** @var Email */
    protected $email;

    private function __construct(
        UserId $id,
        Email $email,
        UserPassword $password,
        UserRole $role
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getRoles(): array
    {
        return [$this->role->value()];
    }

    public function getPassword(): string
    {
        return $this->password->value();
    }

    public function getSalt(): string
    {
        return $this->salt;
    }

    public function getUsername():string
    {
        return $this->email->value();
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function eraseCredentials() {}

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof User) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->salt !== $user->getSalt()) {
            return false;
        }

        if ($this->email !== $user->getUsername()) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->id()->value(),
            $this->email()->value(),
            $this->password()->value(),
            $this->salt
        ));
    }

    public function unserialize($serialized):void
    {
        list ($id, $email, $password, $salt) = unserialize($serialized);
        $this->id = new UserId($id);
        $this->email = new Email($email);
        $this->password = new  UserPassword($password);
        $this->salt = $salt;
    }


    public function id(): UserId
    {
        return $this->id;
    }

    public function role(): UserRole
    {
        return $this->role;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(UserRole::admin());
    }

    public function hasRole(UserRole $role): bool
    {
        return $role->value() === $this->role()->value();
    }
}