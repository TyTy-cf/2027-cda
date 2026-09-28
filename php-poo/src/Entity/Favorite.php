<?php

class Favorite
{
  public function __construct() {}

  public int $id {
    get => $this->id;
    set => $value;
  }

  public User $user {
    get => $this->user;
    set => $value;
  }

  public Topic $topic {
    get => $this->topic;
    set => $value;
  }
}
