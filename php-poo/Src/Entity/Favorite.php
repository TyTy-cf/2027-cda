<?php

namespace Entity;

class Favorite
{
    use IdTrait;
    use CreatedAtTrait;

    private User $user {
        get {
            return $this->user;
        }
        set {
            $this->user = $value;
        }
    }
    private Topic $topic {
        get {
            return $this->topic;
        }
        set {
            $this->topic = $value;
        }
    }
}