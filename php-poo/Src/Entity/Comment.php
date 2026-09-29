<?php

namespace Entity;

use DateTime;
use Trait\IdTrait;
use Trait\TimestampableTrait;

class Comment
{
    use IdTrait, TimestampableTrait;
    public string $content {
        get {
            return $this->content;
        }
        set {
            $this->content = $value;
        }
    }
    public User $author {
        get {
            return $this->author;
        }
        set {
            $this->author = $value;
            $value->addComment($this);
        }
    }
    public Topic $topic {
        get {
            return $this->topic;
        }
        set {
            $this->topic = $value;
            $value->addComment($this);
        }
    }
    public ?Comment $parent {
        get {
            return $this->parent;
        }
        set {
            $this->parent = $value;
            $value->addChild($this);
        }
    }

    private array $replies = [];

    public function getReplies(): array
    {
        return $this->replies;
    }

    public function setReplies(array $replies): void
    {
        $this->replies = $replies;
    }

    public function addReply(Comment $reply): void
    {
        $this->replies[] = $reply;
        $reply->parent = $this;
    }

    public function addReplies(array $replies): void
    {
        foreach ($replies as $reply) {
            $this->addReply($reply);
        }
    }

    public function removeReply(Comment $reply): void
    {
        if (($key = array_search($reply, $this->replies)) !== false) {
            unset($this->replies[$key]);
        }
    }

    private array $votes = [];

    public function getVotes(): array
    {
        return $this->votes;
    }

    public function setVotes(array $votes): void
    {
        $this->votes = $votes;
    }

    public function addVote(Vote $vote): void
    {
        $this->votes[] = $vote;
        $vote->comment = $this;
    }

    public function addVotes(array $votes): void
    {
        foreach ($votes as $vote) {
            $this->addVotes($votes);
        }
    }

    public function removeVote(Vote $vote): void
    {
        if (($key = array_search($vote, $this->votes)) !== false) {
            unset($this->votes[$key]);
        }
    }

    public function getKarma()
    {
        $karma = 0;
        foreach ($this->getVotes() as $vote) {
            $karma += $vote->value;
        }
        return $karma;
    }
}