<?php

class Vote
{

  private const UP = 1;
  private const DOWN = -1;

  public function __construct() {}

  public int $id {
    get => $this->id;
    set => $value;
  }

  public int $value {
    get => $this->value;
    set {
      if ($value === self::DOWN || $value === self::UP) {
        $this->value = $value;
      }
    }
  }

  public DateTime $createdAt {
    get => $this->createdAt;
    set => $value;
  }

  public User $author {
    get => $this->author;
    set => $value;
  }

  public Comment $comment {
    get => $this->comment;
    set => $value;
  }
}
