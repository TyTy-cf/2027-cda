<?php

namespace Repository;

use DateTime;
use Entity\Category;
use Entity\Topic;
class TopicRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct('topic');
    }

    protected function createObjectByAssocArray(array $array): object
    {
        $cr = new CategoryRepository();

        $topic = new Topic();
        $topic->id = $array['id'];
        $topic->title = $array['nickname'];
        $topic->content = $array['content'];
        $topic->createdAt = new DateTime($array['created_at']);
        $topic->updatedAt = new DateTime($array['birth_at']);
        $topic->picture = $array['picture'];
        $topic->category = $cr->;


        return $topic;
    }

    protected function getAssocArrayByObject(object $object): array
    {
        // TODO: Implement getAssocArrayByObject() method.
    }
}