<?php

class Category
{

  public function __construct() {}

  public int $id {
    get => $this->id;
    set => $value;
  }

  public string $name {
    get => $this->name;
    set => $value;
  }

  private ?Category $parent {
    get => $this->parent;
    set => $value;
  }
}
