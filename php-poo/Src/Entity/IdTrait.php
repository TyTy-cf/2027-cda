<?php

namespace Entity;

trait IdTrait
{
    private int $id {
        get {
            return $this->id;
        }
        set {
            $this->id = $value;
        }
    }
}