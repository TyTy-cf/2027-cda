<?php

namespace Repository;

use Entity\Category;
use Entity\Topic;
class TopicRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct('topic');
    }

    protected function createObjectByAssocArray(array $array): Topic
    {
        $cr = new CategoryRepository();

        $topic = new Topic();
        $topic->id = $array['id'];
        $topic->title = $array['title'];
        $topic->content = $array['content'];
        $topic->picture = $array['picture'];
        $topic->createdAt = $array['created_at'];
        if($topic['updated_at'] != null){
            $topic->updatedAt = $array['updated_at'];
        }else{
            $topic->updatedAt = null;
        }
        $topic->author = $array['author'];
        $category = $cr->findById($array['category_id']);
        $topic->category = $cr;
        return $topic;
    }

    protected function getAssocArrayByObject(object $object): array
    {
        return [
            'id' => $object->id,
            'title' => $object->title,
            'content' => $object->content,
            'picture' => $object->picture,
            'createdAt' => $object->createdAt,
            'updatedAt' => $object->updatedAt,
            'author_id' => $object->author,
            'category_id' => $object->category,
        ];
    }

}