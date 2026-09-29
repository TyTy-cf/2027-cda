<?php

namespace Repository;

use DateTime;
use Entity\Comment;
use Entity\Topic;
use Entity\User;

class CommentRepository extends AbstractRepository
{
    protected function __construct()
    {
        parent::__construct();
        $this->table = 'comment';
    }

    protected function createObjectByAssocArray(array $array): object
    {

        $tr = TopicRepository::getInstance();
        $ur = UserRepository::getInstance();

        $comment = new Comment();
        $comment->id = $array['id'];
        $comment->content = $array['content'];
        $comment->createdAt = new DateTime($array['created_at']);

        $comment->updatedAt = null;
        if (isset($array['updated_at'])) {
            $comment->updatedAt = new DateTime($array['updated_at']);
        }

        /** @var User $user */
        $user = $ur->findById($array['author_id']);
        $comment->author = $user;

        /** @var Topic $topic */
        $topic = $tr->findById($array['topic_id']);
        $comment->topic = $topic;

        if ($array['parent_id'] !== null) {
            /** @var Comment $parent */
            $parent = $this->findById($array['parent_id']);
            $comment->parent = $parent;
        } else {
            $comment->parent = null;
        }

        return $comment;
    }

    protected function getAssocArrayByObject(object $object): array
    {
        /** @var Comment $object */
        return [
            'content' => $object->content,
            'created_at' => $object->createdAt,
            'updated_at' => $object->updatedAt,
            'author_id' => $object->author->id,
            'topic_id' => $object->topic->id,
            'parent_id' => $object->parent?->id,
        ];
    }
}