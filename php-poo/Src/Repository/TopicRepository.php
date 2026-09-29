<?php

namespace Repository;

use Entity\Topic;
use DateTime;

class TopicRepository extends AbstractRepository
{

    protected function createObjectByAssocArray(array $array): Topic
    {
        $topic = new Topic();
        $topic->id = $array['id'];
        $topic->title = $array['title'];
        $topic->content = $array['content'];
        $topic->createdAt = new DateTime($array['created_at']);
        $topic->updatedAt = new DateTime($array['updated_at']);
        $topic->picture = $array['picture'];
        $topic->
        return $topic;
    }

    protected function getAssocArrayByObject(object $object): array
    {
        /** @var Topic $object */
        return [
            'id' => $object->id,
            'title' => $object->title,
            'content' => $object->content,
            'created_at' => $object->createdAt,
            'updated_at' => $object->updatedAt,
            'picture' => $object->picture,
            'author_id' => $object->author,
            'category_id' => $object->category
        ];
    }



}