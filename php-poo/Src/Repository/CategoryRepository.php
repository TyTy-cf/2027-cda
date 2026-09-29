<?php

namespace Repository;

use Entity\Category;

class CategoryRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct('category');
    }

    public function createObjectByAssocArray(array $array): Category
    {
        $category = new Category();
        $category->id = $array['id'];
        $category->name = $array['name'];
        if($array['parent_id'] != null){
            $parent = $this->findById($array['parent_id']);
            $category->parent = $parent;
        }else{
            $category->parent = null;
        }
        return $category;
    }

    public function getAssocArrayByObject(Object $object): array
    {
        return [
            'id' => $object->id,
            'name' => $object->name,
            'parent_id' => $object->parent,
        ];
    }
}