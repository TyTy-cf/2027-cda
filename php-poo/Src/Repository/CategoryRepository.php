<?php

namespace Repository;

use Entity\Category;

class CategoryRepository extends AbstractRepository
{

  public function __construct()
  {
    parent::__construct('category');
  }

  /**
   * @throws \DateMalformedStringException
   */
  protected function createObjectByAssocArray(array $array): Category
  {
    $category = new Category();
    $category->id = $array['id'];
    $category->name = $array['name'];

    if ($array['parent_id'] !== null) {
      $category->parent = $this->findById($array['parent_id']);
    } else {
      $category->parent = null;
    }

    return $category;
  }

  protected function getAssocArrayByObject(object $object): array
  {
    /** @var Category $object */
    return [
      'id' => $object->id,
      'name' => $object->name,
      'parent_id' => $object->parent?->id,
    ];
  }
}
