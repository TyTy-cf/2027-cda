<?php

class Topic
{

  public array $comments = [];

  public function __construct() {}

  public int $id {
    get => $this->id;
    set => $value;
  }

  public string $title {
    get => $this->title;
    set => $value;
  }

  public string $content {
    get => $this->content;
    set => $value;
  }

  public string $picture {
    get => $this->picture;
    set => $value;
  }

  public DateTime $createdAt {
    get => $this->createdAt;
    set => $value;
  }

  public ?DateTime $updatedAt = null {
    get => $this->updatedAt;
    set => $value;
  }

  public User $author {
    get => $this->author;
    set => $value;
  }

  public Category $category {
    get => $this->category;
    set => $value;
  }

  public function getComments(): array
  {
    return $this->comments;
  }

  public function addComment(Comment $comment): self
  {
    $this->comments[] = $comment;
    $comment->topic = $this;
    return $this;
  }
}
