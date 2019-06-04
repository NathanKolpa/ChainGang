<?php

require_once "User.php"; 

class Review
{
    private $text; 
private $author; 
    private $karma; 
    private $date; 
    private $title; 
    private $id; 
    private $db; 

    //date as object not string
    private function __construct(DataBase $db, int $id, User $author, string $title, string $text, DateTime $date, int $karma)
    {
        $this->author = $author; 
        $this->title = $title; 
        $this->text = $text; 
        $this->date = $date; 
        $this->karma = $karma; 
        $this->id = $id; 
        $this->db = $db; 
    }

    /*public static function getLatestReviews($db, $limit) : array
    {
        $array = array();
        $result = $db->querry("SELECT * FROM review ORDER BY added DESC LIMIT ?", "i", $limit);


        $results = $result->get_result();

        //$arr = array();
        while($row = $results->fetch_assoc())
        {
            $item = new Review($db, $row["rating"], $row["title"], $row["body"], $row["added"], $row["author"] );

            array_push($array, $item);
        }


        return $array;
    }*/

    public static function getHomeReviews($db):array
    {
        $arr = array(); 
        $reviews = $db->querry("SELECT * FROM review", "")->get_result(); 

        while ($row = $reviews->fetch_assoc())
        {
            $author = User::getUserByID($db, $row["author"]); 

            $scoreRow = $db->querry("SELECT COUNT(review_id) as 'count', SUM(is_up) as 'ups' FROM review_vote WHERE review_id = ?", "d", $row["review_id"])->get_result()->fetch_assoc(); 
            $downs = $scoreRow["count"]-$scoreRow["ups"]; 
            $karma = $scoreRow["ups"]-$downs; 

            $rev = new Review($db, $row["review_id"], $author, $row["title"], $row["body"], new DateTime(), $karma); 

            array_push($arr, $rev); 
        }

        usort($arr,function($first,$second){
            return $first->getKarma() < $second->getKarma();
        });

        return $arr; 
    }

    public static function getReviewById($db, $id)
    {
        $result = $db->querry("SELECT * FROM review WHERE review_id = ?", "d", $id)->get_result(); 

        if ($row = $result->fetch_assoc())
        {
            $author = User::getUserByID($db, $row["author"]); 
            return new Review($db, $row["review_id"], $author, $row["title"], $row["body"], new DateTime(), 34); 
        }
        else
        {
            throw new Exception("review niet gevonden"); 
        }
    }

    public static function postHomeReview($db, User $user, $title, $body)
    {
        $result = $db->querry("DELETE FROM review WHERE author = ?", "i", $user->getId());

        $title = strip_tags($title);
        $body = strip_tags($body);
        $db->querry("INSERT INTO review(author, title, body) VALUES(?, ?, ?)", "iss", $user->getId(), $title, $body);
    }

    public function getId()
    {
        return $this->id; 
    }

    public function getText()
    {
        return $this->text; 
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

    public function hasUserVoted($user,  &$isUp)
    {
        $uId = $user->getId(); 
        $result = $this->db->querry("SELECT * FROM review_vote WHERE user_id = ? AND review_id = ?", "dd", $uId, $this->id)->get_result(); 

        if ($row = $result->fetch_assoc())
        {
            $isUp = $row["is_up"] == 1?true:false; 
            return true; 
        }
        else
        {
            return false; 
        }
    }

    public function vote(User $user, bool $isUp)
    {
        
        $foo; 
        $uid = $user->getId(); 
        if ($this->hasUserVoted($user, $foo))
        {
            if ($foo != $isUp)
            {
                $this->db->querry("UPDATE `review_vote` SET `is_up` = ? WHERE user_id = ? AND review_id = ?", "ddd", $isUp, $uid, $this->id); 
            }
            else
            {
                $this->db->querry("DELETE FROM `review_vote` WHERE user_id = ? AND review_id = ?", "dd", $uid, $this->id);  
            }
        }
        else
        {
            $this->db->querry("INSERT INTO `review_vote`(user_id, review_id, is_up) VALUES(?, ?, ". ($isUp ? 1 : 0) .") ", "dd", $uid, $this->id); 
        }
    }
}
