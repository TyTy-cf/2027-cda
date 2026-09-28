<?php

class Favorite
{
  public function __construct() {}

  private int $id {
    get => $this->id;
    set => $value;
  }

  private User $user {
    get => $this->user;
    set => $value;
  }

  private Topic $topic {
    get => $this->topic;
    set => $value;
  }
}
