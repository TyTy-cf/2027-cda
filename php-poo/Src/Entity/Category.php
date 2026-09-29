<?php

namespace Entity;

class Category
{
    use IdTrait;
    private string $name {
        get {
            return $this->name;
        }
        set {
            $this->name = $value;
        }
    }
    private ?Category $parent {
        get {
            return $this->parent;
        }
        set {
            $this->parent = $value;
        }
    }
}