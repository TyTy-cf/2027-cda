<?php

namespace Repository;

use DateTime;
use Entity\Category;
use Entity\Topic;
use Entity\User;

class TopicRepository extends AbstractRepository
{

    protected function __construct()
    {
        parent::__construct();
        $this->table = 'topic';
    }

    protected function createObjectByAssocArray(array $array): object
    {
        $cr = CategoryRepository::getInstance();
        $ur = UserRepository::getInstance();

        $topic = new Topic();
        $topic->id = $array['id'];
        $topic->title = $array['title'];
        $topic->content = $array['content'];
        $topic->picture = $array['picture'];
        $topic->createdAt = new DateTime($array['created_at']);

        $topic->updatedAt = null;
        if (isset($array['updated_at'])) {
            $topic->updatedAt = new DateTime($array['updated_at']);
        }

        /** @var Category $category */
        $category = $cr->findById($array['category_id']);
        $topic->category = $category;

        /** @var User $user */
        $user = $ur->findById($array['author_id']);
        $topic->author = $user;

        return $topic;
    }

    protected function getAssocArrayByObject(object $object): array
    {
        return [];
    }

}