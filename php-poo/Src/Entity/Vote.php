<?php

namespace Entity;

class Vote
{

public int $id{
    get {
        return $this->id;
    }
    set {
        $this->id = $value;
    }
}

public \DateTime $createdAt{

    get {
        return $this->createdAt;
    }
    set {
        $this->createdAt = $value;
    }
}

public User $author{

    get {
        return $this->author;
    }
    set {
        $this->author = $value;
    }
}

public Comment $comment{

    get {
        return $this->comment;
    }
    set {
        $this->comment = $value;
    }
}

}