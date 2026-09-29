<?php

namespace Entity;

trait TimestampableTrait
{
    use CreatedAtTrait;
    private ?DateTime $updatedAt {
        get {
            return $this->updatedAt;
        }
        set {
            $this->updatedAt = $value;
        }
    }
}