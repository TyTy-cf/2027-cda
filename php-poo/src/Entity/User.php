<?php

class User
{
  public function __construct() {}


  private int $id {
    get => $this->id;
    set => $value;
  }

  private string $email {
    get => $this->email;
    set => $value;
  }

  private string $password {
    get => $this->password;
    set => $value;
  }

  private string $nickname {
    get => $this->nickname;
    set => $value;
  }

  private string $picture {
    get => $this->picture;
    set => $value;
  }

  private dateTime $birthAt {
    get => $this->birthAt;
    set => $value;
  }

  private dateTime $createdAt {
    get => $this->createdAt;
    set => $value;
  }

  private array $roles = ["ROLE_USER"] {
    get => $this->roles;
    set => $value;
  }
}
