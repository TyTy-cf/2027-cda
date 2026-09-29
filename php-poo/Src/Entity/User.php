<?php

namespace Entity;

use DateTime;

class User implements CreatedAtInterface, EntityInterface
{

    use IdTrait;
    use CreatedAtTrait;

    public ?string $email {
        get {
            return $this->email;
        }
        set {
            $this->email = $value;
        }
    }
    public ?string $password {
        get {
            return $this->password;
        }
        set {
            $this->password = $value;
        }
    }
    public ?string $nickname {
        get {
            return $this->nickname;
        }
        set {
            $this->nickname = $value;
        }
    }
    public ?string $picture {
        get {
            return $this->picture;
        }
        set {
            $this->picture = $value;
        }
    }
    public ?\DateTime $birthAt {
        get {
            return $this->birthAt;
        }
        set {
            $this->birthAt = $value;
        }
    }

    public ?array $roles {
        get {
            $this->roles[] = 'ROLE_USER';
            $this->roles;
        }
        set {
            $this->roles = $value;
        }
    }

    public ?string $activationCode {
        get {
            return $this->activationCode;
        }
        set {
            $this->activationCode = $value;
        }
    }

    public function getRoles(): array
    {
        if (empty($this->roles)) {
            return ["ROLE_USER"];
        }
        else{
            return $this->roles;
        }
    }

    public function isAdmin(): bool
    {
        return array_any($this->roles, fn($role) => $role === "ROLE_ADMIN");
    }

    public function getAge(): int
    {
        $age = new DateTime()->diff($this->birthAt);
        return $age->y;
    }
}