<?php

class Vote
{
  public function __construct() {}

  private int $id {
    get => $this->id;
    set => $value;
  }

  // Value is either -1 or 1.
  private int $value = -1 {
    get => $this->value;
    set {
      if ($value !== -1 && $value !== 1) {
        throw new InvalidArgumentException('Vote value must be -1 or 1.');
      }

      $this->value = $value;
    }
  }

  private dateTime $createdAt {
    get => $this->createdAt;
    set => $value;
  }

  private User $author {
    get => $this->author;
    set => $value;
  }

  private Comment $comment {
    get => $this->comment;
    set => $value;
  }
}
