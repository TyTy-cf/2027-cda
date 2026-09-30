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
        $ur = UserRepository::getInstance();
        $tr = TopicRepository::getInstance();

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

        if ($array['parent_id'] !== null) {
            /** @var Comment $parent */
            $parent = $this->findById($array['parent_id']);
            $comment->parent = $parent;
        } else {
            $comment->parent = null;
        }

        /** @var User $user */
        $user = $ur->findById($array['author_id']);
        $comment->author = $user;

        /** @var Topic $topic */
        $topic = $tr->findById($array['topic_id']);
        $comment->topic = $topic;

        return $comment;
    }

    protected function getAssocArrayByObject(object $object): array
    {
        return [];
    }

    public function getMainComments(): array
    {
        $mainComments = $this->findBy(['topic_id' => $_GET["id"], 'parent_id' => null]);

        foreach ($mainComments as $comment) {
            $this->getChildren($comment);
        }

        return $mainComments;
    }

    private function getChildren(Comment $comment): void
    {
        if ([] === $comments = $this->findBy(['parent_id' => $comment->id])) {
            return;
        }

        //dump($comments);

        $comment->setChildren($comments);

        foreach ($comments as $comment) {
            $this->getChildren($comment);
        }
    }
}