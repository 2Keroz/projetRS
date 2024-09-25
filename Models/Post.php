<?php
class Post
{
    private $id;
    private $userId;
    private $title;
    private $content;
    private $createdAt;
    private $updatedAt;

    public function __construct($userId, $title, $content, $id = null, $createdAt = null, $updatedAt = null)
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->content = $content;
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    // Getters and Setters
    public function getId() { return $this->id; }
    public function getUserId() { return $this->userId; }
    public function getTitle() { return $this->title; }
    public function getContent() { return $this->content; }
    public function getCreatedAt() { return $this->createdAt; }
    public function getUpdatedAt() { return $this->updatedAt; }
}
?>
