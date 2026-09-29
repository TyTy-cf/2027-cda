<?php

namespace Entity;

use Trait\IdTrait;

class Category
{
    use IdTrait;
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
            $value->addChild($this);
        }
    }
    private array $children = [];

    public function getChildren(): array
    {
        return $this->children;
    }

    public function setChildren(array $children): void
    {
        $this->children = $children;
    }

    public function addChild(Category $category): void
    {
        $this->children[] = $category;
        $category->parent = $this;
    }

    public function addChildren(array $categories): void
    {
        foreach ($categories as $category) {
            $this->addChild($category);
        }
    }

    public function removeChild(Category $category): void
    {
        if (($key = array_search($category, $this->children)) !== false) {
            unset($this->children[$key]);
        }
    }

    public function isRoot(): bool
    {
        if (!$this->parent) {
            return false;
        }
        return true;
    }
}