<?php

require_once "user.php";

class Review
{
    private $text;
    private $id;
    private $score;//the score the reviewer gave
    private $author;
    private $karma;//the votes the review got
    private $date;
    private $title;

    //date as object not string
    public function __construct(int $id, $author, string $title, string $text, DateTime $date, float $score, int $karma)
    {
        $this->id = $id;
        $this->author = $author;
        $this->title = $title;
        $this->text = $text;
        $this->date = $date;
        $this->score = $score;
        $this->karma = $karma;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getid()
    {
        return $this->id;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function getKarma()
    {
        return $this->karma;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDateText()
    {
        return $this->date->format('Y-m-d');
    }

    public function getAuthor()
    {
        return $this->author;
    }
}