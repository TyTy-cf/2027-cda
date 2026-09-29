<?php

class UserRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct('user');
    }

    protected function createObjectByAssocArray(array $array): object
    {
        // TODO: Implement createObjectByAssocArray() method.
    }

    protected function getAssocArrayByObject(object $object): array
    {


    }
}