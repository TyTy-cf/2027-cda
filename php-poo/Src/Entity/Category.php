<?php

namespace Entity;

class Category
{

    public ?int $id = null {
        get {
            return $this->id;
        }
        set {
            $this->id = $value;
        }
    }

    public ?string $name {
        get {
            return $this->name;
        }
        set {
            $this->name = $value;
        }
    }


}