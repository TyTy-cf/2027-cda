<?php

namespace Entity;

use DateTime;

class User
{

    public int $id {
        get {
            return $this->id;
        }
        set {
            $this->id = $value;
        }
    }

    public string $email {
        get {
            return $this->email;
        }
        set {
            $this->email = $value;
        }
    }

    public array $roles = [] {
        get {
            return $this->roles;
        }
        set {
            $this->roles = $value;
        }
    }

    public string $password {
        get {
            return $this->password;
        }
        set {
            $this->password = $value;
        }
    }

    public string $nickname {
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

    public ?DateTime $birthAt {
        get {
            return $this->birthAt;
        }
        set {
            $this->birthAt = $value;
        }
    }

    public DateTime $createdAt {
        get {
            return $this->createdAt;
        }
        set {
            $this->createdAt = $value;
        }
    }

    public function addTopic() : array
    {
        return []
    }


}