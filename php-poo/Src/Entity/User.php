<?php

namespace Entity;

use DateTime;

class User
{
    use IdTrait;
    private string $email {
        get {
            return $this->email;
        }
        set {
            $this->email = $value;
        }
    }
    private Array $roles {
        get {
            return $this->roles;
        }
        set {
            $this->roles = $value;
        }
    }
    private string $password {
        get {
            return $this->password;
        }
        set {
            $this->password = $value;
        }
    }
    private string $nickname {
        get {
            return $this->nickname;
        }
        set {
            $this->nickname = $value;
        }
    }
    private string $picture {
        get {
            return $this->picture;
        }
        set {
            $this->picture = $value;
        }
    }
    private DateTime $birthAt {
        get {
            return $this->birthAt;
        }
        set {
            $this->birthAt = $value;
        }
    }
    private DateTime $createdAt {
        get {
            return $this->createdAt;
        }
        set {
            $this->createdAt = $value;
        }
    }

}