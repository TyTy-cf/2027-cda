<?php

namespace Entity;

class Topic
{
    use IdTrait;
    public string $title {
        get => $this->title;
        set => $value;
    }
    public string $content {
        get => $this->content;
        set => $value;
    }
    public string $picture {
        get => $this->picture;
        set => $value;
    }
    public \DateTime $createdAt {
        get => $this->createdAt;
        set => $value;
    }
    public ?\DateTime $updatedAt{
        get => $this->updatedAt;
        set => $value;
    }
    public User $author {
        get => $this->author;
        set => $value;
    }
    public Category $category {
        get => $this->category;
        set => $value;
    }

    public array $comments = [];
    public function getComments(): array
    {
        return $this->comments;
    }
    public function addComment(Comment $comment): self
    {
        $this->comments[] = $comment;
        return $this;
    }

    public function removeComment(Comment $comment): void
    {
        if(null !== $index = array_search($comment, $this->comments)) {
            unset($this->comments[$index]);
        }
    }
}