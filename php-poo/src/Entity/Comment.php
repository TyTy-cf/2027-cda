<?php

class Comment
{
  public function __construct() {}

  public int $id {
    get => $this->id;
    set => $value;
  }

  public string $content {
    get => $this->content;
    set => $value;
  }

  public DateTime $createdAt {
    get => $this->createdAt;
    set => $value;
  }

  public ?DateTime $updatedAt {
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

  public array $children = [] {
    get => $this->children;
    set => $value;
  }

  /** @var list<Vote> */
  public array $votes = [] {
    get => $this->votes;
    set {
      foreach ($value as $vote) {
        if (!$vote instanceof Vote) {
          throw new InvalidArgumentException('Comments can only contain Vote objects.');
        }
      }

      $this->votes = $value;
    }
  }

  public function addVote(Vote $vote): void
  {
    $this->votes[] = $vote;
  }

  public function getScore(): int
  {
    $score = 0;
    foreach ($this->votes as $vote) {
      $score += $vote->value;
    }
    return $score;
  }
}
