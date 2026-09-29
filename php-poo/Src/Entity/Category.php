<?php

namespace Entity;

class Category implements EntityInterface
{

    use IdTrait;

    public ?string $name {
        get {
            return $this->name;
        }
        set {
            $this->name = $value;
        }
    }

    public ?Category $parent = null {
        get => $this->parent;
        set => $this->parent = $value;
    }


}