<?php

namespace Entity;

use DateTime;
use Trait\CreatedAtTrait;
use Trait\IdTrait;

enum VoteValue: int
{
    case POSITIVE = 1;
    case NEGATIVE = -1;
}


class Vote
{
    use IdTrait, CreatedAtTrait;

    public VoteValue $value {
        get {
            return $this->value;
        }
        set {
            $this->value = $value;
        }
    }
    public  User $author {
        get {
            return $this->author;
        }
        set {
            $this->author = $value;
        }
    }
    public Comment $comment {
        get {
            return $this->comment;
        }
        set {
            $this->comment = $value;
        }
    }
}