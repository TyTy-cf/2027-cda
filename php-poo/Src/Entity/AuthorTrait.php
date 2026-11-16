<?php

namespace Entity;

trait AuthorTrait
{

    public ?User $author {
        get {
            return $this->author;
        }
        set {
            $this->author = $value;
        }
    }

}