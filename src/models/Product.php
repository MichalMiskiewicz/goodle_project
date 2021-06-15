<?php


class Product
{
    private $title;
    private $description;
    private $image;
    private $like;
    private $dislike;
    private $id;
    private $idAssignedBy;

    public function __construct($title, $description, $image, $like = 0, $dislike = 0, $id = null, $idAssignedBy = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->like = $like;
        $this->dislike = $dislike;
        $this->id = $id;
        $this->idAssignedBy = $idAssignedBy;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getLike()
    {
        return $this->like;
    }

    public function setLike($like): void
    {
        $this->like = $like;
    }

    public function getDislike()
    {
        return $this->dislike;
    }

    public function setDislike($dislike): void
    {
        $this->dislike = $dislike;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIdAssignedBy()
    {
        return $this->idAssignedBy;
    }

    public function setIdAssignedBy($idAssignedBy): void
    {
        $this->idAssignedBy = $idAssignedBy;
    }





}