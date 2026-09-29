<?php

namespace Repository;

use Entity\Comment;
use Repository\UserRepository;
use Repository\TopicRepository;

use DateTime;

class CommentRepository extends AbstractRepository
{

  public function __construct()
  {
    parent::__construct('comment');
  }

  /**
   * @throws \DateMalformedStringException
   */
  protected function createObjectByAssocArray(array $array): Comment
  {
    $comment = new Comment();
    $authorRepository = new UserRepository();
    $topicRepository = new TopicRepository();

    $comment->id = $array['id'];
    $comment->content = $array['content'];
    $comment->author = $authorRepository->findById($array['author_id']);
    $comment->topic = $topicRepository->findById($array['topic_id']);
    $comment->createdAt = new DateTime($array['created_at']);
    $comment->updatedAt = null;
    if (isset($array['updated_at'])) {
      $comment->updatedAt = new DateTime($array['updated_at']);
    }

    if ($array['parent_id'] !== null) {
      $comment->parent = $this->findById($array['parent_id']);
    } else {
      $comment->parent = null;
    }

    return $comment;
  }

  protected function getAssocArrayByObject(object $object): array
  {
    /** @var Comment $object */
    return [
      'id' => $object->id,
      'content' => $object->content,
      'author_id' => $object->author?->id,
      'topic_id' => $object->topic?->id,
      'parent_id' => $object->parent?->id,
    ];
  }
}
