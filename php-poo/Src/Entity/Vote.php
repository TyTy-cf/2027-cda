<?php

namespace Entity;

use DateTime;

class Vote
{
    use IdTrait;
    Use CreatedAtTrait;
    private const $value = 1;
    private User $author {
        get {
            return $this->author;
        }
        set {
            $this->author = $value;
        }
    }
    private Comment $comment {
        get {
            return $this->comment;
        }
        set {
            $this->comment = $value;
        }
    }
}