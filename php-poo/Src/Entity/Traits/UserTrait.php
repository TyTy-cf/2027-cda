<?php

namespace Entity\Traits;

use Entity\User;

trait UserTrait
{
    public User $author {
        get {
            return $this->author;
        }
        set {
            $this->author = $value;
        }
    }
}