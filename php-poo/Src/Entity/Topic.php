<?php

namespace Entity;

use DateTime;
use Trait\IdTrait;
use Trait\TimestampableTrait;

class Topic
{
    use IdTrait, TimestampableTrait;
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
    public User $author {
        get {
            return $this->author;
        }
        set {
            $this->author = $value;
            $value->addTopic($this);
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

    private array $comments = [];

    public function getComments(): array
    {
        return $this->comments;
    }

    public function setComments(array $comments): void
    {
        $this->comments = $comments;
    }

    public function addComment(Comment $comment): void
    {
        $this->comments[] = $comment;
        $comment->topic = $this;
    }

    public function addComments(array $comments): void
    {
        foreach ($comments as $comment) {
            $this->addComment($comment);
        }
    }

    public function removeComment(Comment $comment): void
    {
        if (($key = array_search($comment, $this->comments)) !== false) {
            unset($this->comments[$key]);
        }
    }

    private array $favorites = [];

    public function getFavorites(): array
    {
        return $this->favorites;
    }

    public function setFavorites(array $favorites): void
    {
        $this->favorites = $favorites;
    }

    public function addFavorite(Favorite $favorite): void
    {
        $this->favorites[] = $favorite;
    }

    public function addFavorites(array $favorites): void
    {
        foreach ($favorites as $favorite) {
            $this->addFavorite($favorite);
        }
    }

    public function removeFavorite(Favorite $favorite): void
    {
        if (($key = array_search($favorite, $this->favorites)) !== false) {
            unset($this->favorites[$key]);
        }
    }

    public function isEdited(): bool
    {
        if (!$this->updatedAt)
            return false;
        return true;
    }
}