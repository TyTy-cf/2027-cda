<?php

namespace Entity;

trait CreatedAtTrait
{
    private DateTime $createdAt {
        get {
            return $this->createdAt;
        }
        set {
            $this->createdAt = $value;
        }
    }
}