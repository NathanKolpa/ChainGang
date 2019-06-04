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

    public static function getLatestReviews($db, $limit) : array
    {
        $array = array();
        $result = $db->querry("SELECT * FROM review ORDER BY added DESC LIMIT ?", "i", $limit);


        $results = $result->get_result();

        //$arr = array();
        while($row = $results->fetch_assoc())
        {
            // hier wordt een object gemaakt van Product
            $item = new Review($db, $row["rating"], $row["title"], $row["body"], $row["added"], $row["author"] );

            array_push($array, $item);
        }


        return $array;}

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