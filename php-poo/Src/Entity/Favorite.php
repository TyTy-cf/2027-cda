<?php

namespace Entity;

class Favorite
{
    use IdTrait;
    public \DateTime $createdAt {
        get => $this->createdAt;
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