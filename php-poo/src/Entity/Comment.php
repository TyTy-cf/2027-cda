<?php

class Comment
{
  public function __construct() {}

  private int $id {
    get => $this->id;
    set => $value;
  }

  private string $content {
    get => $this->content;
    set => $value;
  }

  private dateTime $createdAt {
    get => $this->createdAt;
    set => $value;
  }

  private ?dateTime $updatedAt {
    get => $this->updatedAt;
    set => $value;
  }

  private User $author {
    get => $this->author;
    set => $value;
  }

  private Topic $topic {
    get => $this->topic;
    set =>$value;
  }

  private ?Comment $parent {
    get => $this->parent;
    set => $value;
  }
}
