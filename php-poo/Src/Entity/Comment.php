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
    public ?Comment $parent = null {
        get {
            return $this->parent;
        }
        set {
            //$value->addChild($this);
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

    private array $children = [];

    public function getChildren(): array
    {
        return $this->children;
    }

    public function setChildren(array $children): void
    {
        $this->children = $children;
    }

    public function addChild(Comment $child): void
    {
        $this->children[] = $child;
        $child->parent = $this;
    }

    public function addChildren(array $children): void
    {
        foreach ($children as $child) {
            $this->addchild($child);
        }
    }

    public function removeChild(Comment $child): void
    {
        if (($key = array_search($child, $this->children)) !== false) {
            unset($this->children[$key]);
        }
    }
}