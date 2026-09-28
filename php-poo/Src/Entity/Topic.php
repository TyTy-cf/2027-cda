<?php

namespace Entity;

use DateTime;

class Topic
{
    public int $id {
        get {
            return $this->id;
        }
        set {
            $this->id = $value;
        }
    }

    public string $title {
        get {
            return $this->title;
        }
        set {
            $this->title = $value;
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

    public string $picture {
        get {
            return $this->picture;
        }
        set {
            $this->picture = $value;
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

    public ?DateTime $updatedAt {
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

    public Category $category {
        get {
            return $this->category;
        }
        set {
            $this->category = $value;
        }
    }

    public array $comments =[];

    public function getComments() : array
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        $this->comments[] = $comment;
        return $this;
    }
}