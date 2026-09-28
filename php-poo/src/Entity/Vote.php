<?php

class Vote
{
  public function __construct() {}

  public int $id {
    get => $this->id;
    set => $value;
  }

  public int $value = -1 {
    get => $this->value;
    set {
      if (!$value === -1 || $value === 1) {
        return;
      }

      $this->value = $value;
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
