<?php

class Comment
{
  public function __construct() {}

  public int $id {
    get => $this->id;
    set => $value;
  }

  public string $content {
    get => $this->content;
    set => $value;
  }

  public DateTime $createdAt {
    get => $this->createdAt;
    set => $value;
  }

  public ?DateTime $updatedAt {
    get => $this->updatedAt;
    set => $value;
  }

  public User $author {
    get => $this->author;
    set => $value;
  }

  public Topic $topic {
    get => $this->topic;
    set => $value;
  }

  public ?Comment $parent {
    get => $this->parent;
    set => $value;
  }

  public array $children = [] {
    get => $this->children;
    set => $value;
  }
}
