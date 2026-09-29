<?php

namespace Repository;

class TopicRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct('topic');
    }

    /**
     * @throws \DateMalformedStringException
     */
    protected function createObjectByAssocArray(array $array): Topic
    {

        $ur = new UserRepository();
        $cr = new CategoryRepository();

        $topic = new Topic();
        $topic->id = $array['id'];
        $topic->title = $array['title'];
        $topic->content = $array['content'];
        $topic->createdAt = new DateTime($array['created_at']);
        $topic->updatedAt = new DateTime($array['updated_at']);
        $topic->picture = $array['picture'];
        return $topic;
    }

    protected function getAssocArrayByObject(object $object): array
    {
        /** @var User $object */
        return [
            'id' => $object->id,
            'title' => $object->title,
            'content' => $object->content,
            'created_at' => $object->createdAt,
            'updated_at' => $object->updatedAt,
            'picture' => $object->picture,
        ];
    }
}