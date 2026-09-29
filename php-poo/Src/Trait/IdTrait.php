<?php

namespace Trait;

trait IdTrait
{
    public int $id {
        get {
            return $this->id;
        }
        set {
            $this->id = $value;
        }
    }

}