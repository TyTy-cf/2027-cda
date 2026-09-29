<?php

namespace Repository;

use DateTime;
use Entity\Category;
class CategoryRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct('category');
    }
    protected function createObjectByAssocArray(array $array): object
    {
        $category = new Category();
        $category->id = $array['id'];
        $category->name = $array['name'];

        if ($array['parent_id'] !== null) {
            $parent = $this->findById($array['parent_id']);
            $category->parent = $parent;
        }
        else{
            $category->parent = null;
        }

        return $category;
    }

    protected function getAssocArrayByObject(object $object): array
    {
        return [
            'id' => $object->id,
            'name' => $object->name,
            'parent_id' => $object->parent->id,
        ];
    }
}