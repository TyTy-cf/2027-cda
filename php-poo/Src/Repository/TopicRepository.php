<?php

namespace Repository;

use DateTime;
use Entity\Category;
use Entity\Topic;
use Entity\User;

class TopicRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct('topic');
    }

    protected function createObjectByAssocArray(array $array): Topic
    {
        $ur = new UserRepository();
        $cr = new CategoryRepository();

        //dump($array);

        $topic = new Topic();
        $topic->id = $array['id'];
        $topic->title = $array['title'];
        $topic->content = $array['content'];
        $topic->createdAt = new DateTime($array['created_at']);
        if (isset($array['updated_at'])) {
            $topic->updatedAt = new DateTime($array['updated_at']);
        }
        /** @var User $author */
        $author = $ur->findById($array['author_id']);
        $topic->author = $author;
        /** @var Category $category */
        $category =$cr->findById($array['category_id']);
        $topic->category = $category;
        $topic->picture = $array['picture'];
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
            'author_id' => $object->author->id,
            'category_id' => $object->category->id,
            'picture' => $object->picture,
        ];
    }
}