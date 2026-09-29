<?php

namespace Entity;

class Vote implements CreatedAtInterface
{

    private const UP = 1;
    private const DOWN = -1;

    use IdTrait;
    use AuthorTrait;
    use CreatedAtTrait;

    public ?int $value {
        get {
            return $this->value;
        }
        set {
            if ($value === self::UP || $value === self::DOWN) {
                $this->value = $value;
            }
        }
    }

    public ?Comment $comment {
        get {
            return $this->comment;
        }
        set {
            $this->comment = $value;
        }
    }

}