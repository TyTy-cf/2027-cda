<?php

namespace Entity;

use DateTime;

class Topic
{
    use IdTrait;
    use TimestampableTrait;
    private string $title {
        get {
            return $this->title;
        }
        set {
            $this->title = $value;
        }
    }
    private string $content {
        get {
            return $this->content;
        }
        set {
            $this->content = $value;
        }
    }
    private string $picture {
        get {
            return $this->picture;
        }
        set {
            $this->picture = $value;
        }
    }
    private User $author {
        get {
            return $this->author;
        }
        set {
            $this->author = $value;
        }
    }
    private Category $category {
        get {
            return $this->category;
        }
        set {
            $this->category = $value;
        }
    }
}