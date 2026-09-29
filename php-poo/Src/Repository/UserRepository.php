<?php

namespace Repository;

use DateTime;
use Entity\User;

class UserRepository extends AbstractRepository
{

    protected function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }

    /**
     * @throws \DateMalformedStringException
     */
    protected function createObjectByAssocArray(array $array): User
    {
        $user = new User();
        $user->id = $array['id'];
        $user->nickname = $array['nickname'];
        $user->email = $array['email'];
        $user->password = $array['password'];
        $user->createdAt = new DateTime($array['created_at']);
        $user->birthAt = new DateTime($array['birth_at']);
        $user->picture = $array['picture'];
        $user->roles = [$array['roles']];
        $user->activationCode = $array['activation_code'];
        return $user;
    }

    protected function getAssocArrayByObject(object $object): array
    {
        /** @var User $object */
        return [
            'id' => $object->id,
            'email' => $object->email,
            'nickname' => $object->nickname,
            'password' => $object->password,
            'created_at' => $object->createdAt,
            'birth_at' => $object->birthAt,
            'roles' => $object->roles,
            'picture' => $object->picture,
        ];
    }
}