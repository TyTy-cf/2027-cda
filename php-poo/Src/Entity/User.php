<?php

namespace Entity;

use Couchbase\Role;
use DateTime;
use Trait\CreatedAtTrait;
use Trait\IdTrait;

enum Roles: string
{
    case USER = "ROLE_USER";
    case ADMIN = "ROLE_ADMIN";
}

class User
{
    use IdTrait, CreatedAtTrait;

    public ?string $email = null {
        get => $this->email;
        set => $value;
    }
    public array $roles {
        get {
            $this->roles[] = Roles::USER;
            return $this->roles;
        }
        set {
            $this->roles = $value;
        }
    }
    public string $password {
        get {
            return $this->password;
        }
        set {
            $this->password = $value;
        }
    }
    public string $nickname {
        get {
            return $this->nickname;
        }
        set {
            $this->nickname = $value;
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
    public DateTime $birthAt {
        get {
            return $this->birthAt;
        }
        set {
            $this->birthAt = $value;
        }
    }
    private array $topicList = [];

    public array $topics {
        get {
            return $this->topicList;
        }
        set {
            $this->topicList = $value;
        }
    }

    public function addTopic(Topic $topic)
    {
        $this->topicList[] = $topic;
        $topic->author = $this;
    }

    public function addTopics(array $topics)
    {
        foreach ($topics as $topic) {
            $this->addTopic($topic);
        }
    }

    public function removeTopic(Topic $topic)
    {
        if (($key = array_search($topic, $this->topicList)) !== false) {
            unset($this->topicList[$key]);
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
        $comment->author = $this;
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
        $favorite->user = $this;
    }

    public function addFavorites(array $favorites): void
    {
        foreach ($favorites as $favorite) {
            $this->addComment($favorite);
        }
    }

    public function removeFavorite(Favorite $favorite): void
    {
        if (($key = array_search($favorite, $this->favorites)) !== false) {
            unset($this->favorites[$key]);
        }
    }

    public function isAdmin()
    {
        if (array_search(Roles::ADMIN, $this->roles))
            return true;
        return false;
    }

    public function getAge(): int
    {
        //get age from date or birthdate
        $age = (date("md", date("U", mktime(0, 0, 0, $this->birthAt->format('d'), $this->birthAt->format('m'), $this->birthAt->format('Y')))) > date("md")
            ? ((date("Y") - $this->birthAt->format('Y') - 1))
            : (date("Y") - $this->birthAt->format('Y')));

        return $age;
    }
}