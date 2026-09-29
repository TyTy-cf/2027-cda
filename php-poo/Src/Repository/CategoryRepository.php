<?php

namespace Repository;

use Entity\Category;

class CategoryRepository extends AbstractRepository
{

    protected function __construct()
    {
        parent::__construct();
        $this->table = 'category';
    }

    protected function createObjectByAssocArray(array $array): object
    {
        $category = new Category();
        $category->id = $array['id'];
        $category->name = $array['name'];

        if ($array['parent_id'] !== null) {
            /** @var Category $parent */
            $parent = $this->findById($array['parent_id']);
            $category->parent = $parent;
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
            'parent_id' => $object->parent->id,
        ];
    }

}