<?php

namespace Entity;

use DateTime;

class Vote
{
    public int $id {
        get {
            return $this->id;
        }
        set {
            $this->id = $value;
        }
    }

    public int $value {
        get {
            return $this->value;
        }
        set {
            $this->value = $value;
        }
    }

    public DateTime $createdAt {
        get {
            return $this->createdAt;
        }
        set {
            $this->createdAt = $value;
        }
    }

    public User $author {
        get {
            return $this->author;
        }
        set {
            $this->author = $value;
        }
    }

    public Comment $comment {
        get {
            return $this->comment;
        }
        set {
            $this->comment = $value;
        }
    }
}