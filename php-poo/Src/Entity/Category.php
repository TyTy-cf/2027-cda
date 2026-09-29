<?php

namespace Entity;

class Category
{
    use IdTrait;
    public string $name {
        get => $this->name;
        set => $value;
    }
    public ?Category $parent {
        get => $this->parent;
        set => $value;
    }

    public array $children = [];

    public function getChildren(): array
    {
        return $this->children;
    }

    public function addChildren(Category $children): self
    {
        $this->children[] = $children;
        return $this;
    }

    public function removeChildren(Category $children): void
    {
        if(null !== $index = array_search($children, $this->children)) {
            unset($this->children[$index]);
        }
    }

}