<?php

namespace Entity;

class Comment implements CreatedAtInterface, EntityInterface
{

    use IdTrait;
    use TimestampableTrait;
    use AuthorTrait;

    public ?string $content {
        get {
            return $this->content;
        }
        set {
            $this->content = $value;
        }
    }
    public ?Comment $parent {
        get {
            return $this->parent;
        }
        set {
            $this->parent = $value;
        }
    }

    public ?Topic $topic {
        get {
            return $this->topic;
        }
        set {
            $this->topic = $value;
        }
    }

}