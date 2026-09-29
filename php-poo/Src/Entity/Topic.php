<?php

namespace Entity;

class Topic implements CreatedAtInterface, EntityInterface
{

    use IdTrait;
    use TimestampableTrait;
    use AuthorTrait;

    public ?string $title {
        get {
            return $this->title;
        }
        set {
            $this->title = $value;
        }
    }
    public ?string $content {
        get {
            return $this->content;
        }
        set {
            $this->content = $value;
        }
    }
    public ?string $picture {
        get {
            return $this->picture;
        }
        set {
            $this->picture = $value;
        }
    }
    public ?Category $category {
        get {
            return $this->category;
        }
        set {
            $this->category = $value;
        }
    }

    /**
     * @var array<Comment>
     */
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
        if (null !== $index = array_search($comment, $this->comments)) {
            unset($this->comments[$index]);
        }
    }

    public function isEdited(): bool
    {
        return $this->updatedAt !== null;
    }

}