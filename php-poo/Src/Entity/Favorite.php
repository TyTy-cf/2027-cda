<?php

namespace Entity;

class Favorite
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

public User $user{

    get {
        return $this->user;
    }
    set {
        $this->user = $value;
    }
}

public Topic $topic{

    get {
        return $this->topic;
    }
    set {
        $this->topic = $value;
    }
}

}