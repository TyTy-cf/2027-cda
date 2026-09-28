<?php
include_once "IdTrait.php";

class Category
{
  use IdTrait;

  public function __construct() {}

  public string $name {
    get => $this->name;
    set => $value;
  }

  public ?Category $parent {
    get => $this->parent;
    set => $value;
  }

  public array $children = [] {
    get => $this->children;
  }

  public function addCategory(Category $category): void
  {
    $this->children[] = $category;
    $category->parent = $this;
  }

  public function removeCategory(Category $category): void
  {
    $index = array_search($category, $this->children, true);
    if ($index !== false) {
      unset($this->children[$index]);
      $this->children = array_values($this->children);
      $category->parent = null;
    }
  }
}
