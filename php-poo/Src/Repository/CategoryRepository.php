<?php

namespace Repository;

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

        if($array['parent_id'] != null){
            /** @var Category $parent */
            $parent = $category->parent_id = $array['parent_id'];
            $category->parent = $parent;
        } else {
            $category->parent = null;
        }

        return $category;
    }

    protected function getAssocArrayByObject(object $object): array
    {
        /** @var User $object */
        return [
            'id' => $object->id,
            'title' => $object->title,
            'parent_id' => $object->parent->id,
        ];
    }
}