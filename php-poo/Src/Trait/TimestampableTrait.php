<?php

namespace Trait;

trait TimestampableTrait
{
    use CreatedAtTrait;

    public ?DateTime $updatedAt {
        get {
            return $this->updatedAt;
        }
        set {
            $this->updatedAt = $value;
        }
    }
}