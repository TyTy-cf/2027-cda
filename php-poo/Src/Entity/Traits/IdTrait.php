<?php

namespace Entity\Traits;

trait IdTrait
{
    public ?int $id = null {
        get {
            return $this->id;
        }
        set {
            $this->id = $value;
        }
    }
}