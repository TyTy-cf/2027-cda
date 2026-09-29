<?php

namespace Entity;

class Vote
{
    use IdTrait;
    public int $value {
        get {
            return $this->value;
        }
        set {
            if ($value == 1 || $value == -1) {
                $this->value = $value;
            }
        }
    }
    public \DateTime $createdAt {
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