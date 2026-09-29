<?php

namespace Repository;

use Entity\Category;

class CategoryRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct('category');
    }

    protected function createObjectByAssocArray(array $array): Category
    {
        $cr = new CategoryRepository();

        $category = new Category();
        $category->id = $array['id'];
        $category->name = $array['name'];
        if (isset($array['parent_id'])) {
            /** @var Category $parent */
            $parent = $cr->findById($array['parent_id']);
            $category->parent = $parent;
        }

        return $category;
    }

    protected function getAssocArrayByObject(object $object): array
    {
        /** @var Category $object */
        return [
            'id' => $object->id,
            'name' => $object->name,
            'category_id' => $object->parent->id,
        ];
    }
}