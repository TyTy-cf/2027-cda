<?php

namespace Entity;

class Favorite implements CreatedAtInterface
{

    use IdTrait;
    use CreatedAtTrait;

    public ?Topic $topic {
        get {
            return $this->topic;
        }
        set {
            $this->topic = $value;
        }
    }

    public ?User $user {
        get {
            return $this->user;
        }
        set {
            $this->user = $value;
        }
    }

}