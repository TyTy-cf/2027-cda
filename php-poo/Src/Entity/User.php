<?php

namespace Entity;

class User implements CreatedAtInterface
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

}