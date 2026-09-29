<?php

namespace Trait;

use DateTime;

trait CreatedAtTrait
{
    public DateTime $createdAt {
        get {
            return $this->createdAt;
        }
        set {
            $this->createdAt = $value;
        }
    }
}