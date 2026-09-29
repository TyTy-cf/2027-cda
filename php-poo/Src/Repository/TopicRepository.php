<?php

namespace Repository;

use DateTime;
use Entity\Topic;
use Repository\CategoryRepository;
use Repository\UserRepository;

class TopicRepository extends AbstractRepository
{
  private CategoryRepository $categoryRepository;
  private UserRepository $userRepository;

  public function __construct()
  {
    parent::__construct('topic');
    $this->categoryRepository = new CategoryRepository();
    $this->userRepository = new UserRepository();
  }

  /**
   * @throws \DateMalformedStringException
   */
  protected function createObjectByAssocArray(array $array): Topic
  {
    $topic = new Topic();
    $topic->id = $array['id'];
    $topic->title = $array['title'];
    $topic->content = $array['content'];
    $topic->picture = $array['picture'];
    $topic->author = $this->userRepository->findById($array['author_id']);
    $topic->category = $this->categoryRepository->findById($array['category_id']);
    $topic->createdAt = new DateTime($array['created_at']);
    $topic->updatedAt = null;
    if (isset($array['updated_at'])) {
      $topic->updatedAt = new DateTime($array['updated_at']);
    }

    return $topic;
  }

  protected function getAssocArrayByObject(object $object): array
  {
    /** @var Topic $object */
    return [
      'id' => $object->id,
      'title' => $object->title,
      'content' => $object->content,
      'picture' => $object->picture,
      'author_id' => $object->author->id,
      'category_id' => $object->category->id,
      'updated_at' => $object->updatedAt,
      'created_at' => $object->createdAt,
    ];
  }
}
