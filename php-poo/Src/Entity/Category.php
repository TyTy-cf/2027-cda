<?php

namespace Entity;

class Category
{
    public int $id {
        get {
            return $this->id;
        }
        set {
            $this->id = $value;
        }
    }

    public string $name {
        get {
            return $this->name;
        }
        set {
            $this->name = $value;
        }
    }

    public ?Category $parent {
        get {
            return $this->parent;
        }
        set {
            $this->parent = $value;
        }
    }

}