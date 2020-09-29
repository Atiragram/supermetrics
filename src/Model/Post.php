<?php

declare(strict_types=1);

namespace App\Model;

class Post
{
    private \DateTime $createdTime;
    private string $userId;
    private string $userName;
    private int $postLength;
    private int $postWeekNumber;
    private string $postMonth;

    public function __construct(
        \DateTime $createdTime,
        string $userId,
        string $userName,
        int $postLength
    ) {
        $this->createdTime = $createdTime;
        $this->userId = $userId;
        $this->userName = $userName;
        $this->postLength = $postLength;
        $this->postWeekNumber = (int) $createdTime->format('W');
        $this->postMonth = $createdTime->format('F');
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getPostLength(): int
    {
        return $this->postLength;
    }

    public function getPostWeekNumber(): int
    {
        return $this->postWeekNumber;
    }

    public function getPostMonth(): string
    {
        return $this->postMonth;
    }
}