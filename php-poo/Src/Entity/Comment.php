<?php

namespace Entity;

use DateTime;

class Comment
{
    public int $id {
        get {
            return $this->id;
        }
        set {
            $this->id = $value;
        }
    }

    public string $content {
        get {
            return $this->content;
        }
        set {
            $this->content = $value;
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

    public DateTime $updatedAt {
        get {
            return $this->updatedAt;
        }
        set {
            $this->updatedAt = $value;
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

    public Comment $parent {
        get {
            return $this->parent;
        }
        set {
            $this->parent = $value;
        }
    }
}