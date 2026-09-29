<?php

namespace Repository;

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
    $category->nickname = $array['nickname'];
    $category->email = $array['email'];
    return $category;}
}