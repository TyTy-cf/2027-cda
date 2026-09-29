<?php

namespace Entity;

class Comment
{
    use IdTrait;
    public string $content {
        get => $this->content;
        set => $value;
    }
    public \DateTime $createdAt {
        get => $this->createdAt;
        set => $value;
    }
    public ?\DateTime $updatedAt {
        get => $this->updatedAt;
        set => $value;
    }
    public User $author {
        get => $this->author;
        set => $value;
    }
    public Topic $topic {
        get => $this->topic;
        set => $value;
    }
    public ?Comment $parent {
        get => $this->parent;
        set => $value;
    }
}