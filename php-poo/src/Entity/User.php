<?php

class User
{
  public function __construct() {}


  public int $id {
    get => $this->id;
    set => $value;
  }

  public string $email {
    get => $this->email;
    set => $value;
  }

  public string $password {
    get => $this->password;
    set => $value;
  }

  public string $nickname {
    get => $this->nickname;
    set => $value;
  }

  public string $picture {
    get => $this->picture;
    set => $value;
  }

  public DateTime $birthAt {
    get => $this->birthAt;
    set => $value;
  }

  public DateTime $createdAt {
    get => $this->createdAt;
    set => $value;
  }

  public array $roles = ["ROLE_USER"] {
    get => $this->roles;
    set => $value;
  }
}
