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

        /** @var Topic $topic */
        $topic = $tr->findById($array['topic_id']);
        $comment->topic = $topic;

        /** @var User $user */
        $user = $ur->findById($array['author_id']);
        $comment->author = $user;

        return $comment;
    }
    protected function getAssocArrayByObject(object $object): array
    {
        return [];
    }

}