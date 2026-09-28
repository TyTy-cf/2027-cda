<?php

class Topic
{
  public function __construct() {}

  private int $id {
    get => $this->id;
    set => $value;
  }

  private string $title {
    get => $this->title;
    set => $value;
  }

  private string $content {
    get => $this->content;
    set => $value;
  }

  private string $picture {
    get => $this->picture;
    set => $value;
  }

  private dateTime $createdAt {
    get => $this->createdAt;
    set => $value;
  }

  private ?dateTime $updatedAt = null {
    get => $this->updatedAt;
    set => $value;
  }

  private User $author {
    get => $this->author;
    set => $value;
  }

  private Category $category {
    get => $this->category;
    set => $value;
  }
}
