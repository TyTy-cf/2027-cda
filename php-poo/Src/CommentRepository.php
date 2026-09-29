<?php

use Repository\AbstractRepository;

class CommentRepository extends AbstractRepository
{

    protected function __construct()
    {
        parent::__construct();
        $this->table = 'comments';
    }

    protected function createObjectByAssocArray(array $array): object
    {
        // TODO: Implement createObjectByAssocArray() method.
    }

    protected function getAssocArrayByObject(object $object): array
    {
        // TODO: Implement getAssocArrayByObject() method.
    }
}