<?php

namespace Entity;

use DateTime;

class Favorite
{
    public int $id {
        get {
            return $this->id;
        }
        set {
            $this->id = $value;
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

    public Topic $topic {
        get {
            return $this->topic;
        }
        set {
            $this->topic = $value;
        }
    }
}