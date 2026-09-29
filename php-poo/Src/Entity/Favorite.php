<?php

namespace Entity;

use Trait\CreatedAtTrait;
use Trait\IdTrait;

class Favorite
{
    use IdTrait, CreatedAtTrait;
    public User $user {
        get {
            return $this->user;
        }
        set {
            $this->user = $value;
        }
    }
    public Topic $topic {
        get {
            return $this->topic;
        }
        set {
            $this->topic = $value;
        }
    }
}