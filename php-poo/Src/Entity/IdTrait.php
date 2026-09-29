<?php

namespace Entity;

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

    public function getId(): ?int
    {
        return $this->id;
    }

}