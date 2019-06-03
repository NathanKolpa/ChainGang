<?php

class Subscribe{
private $email;
private $db;
    public function __construct(DataBase $db){
        //$this->email = $email;
        $this->db = $db;
    }


    public function emailBestaat($email)
    {
        $result = $this->db->querry("SELECT nieuwsbrief_email FROM nieuwsbrief WHERE nieuwsbrief_email = ? ", "s", $email)->get_result();

        if ($row = $result->fetch_assoc())
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    //moet controleren of het niet al in zit
    // zit het er niet in voeg toe aan database anders krijg je een melding
    // dat je al aangemeld hebt voor nieuwsbrief
    public function schrijfIn(DataBase $db, string $email){

        //kijkt of de mail al bestaat als die niet bestaat dan komt die in de DAtaBase te komen
        if ($this->emailBestaat($email)) {
            try {
                $result = $db->querry("INSERT INTO nieuwsbrief (nieuwsbrief_email) VALUES (?)", "s", $email);


            } catch (Exception $e) {
                $arr = array("error" => $e->getMessage());
                echo json_encode($arr);

            }
        }
    }
    //moet nog een delete email komen
    // als unsubscribe
    //als het een vinkje box is maak een functie en stop daarin de schriijfIn functie in anders delete of zo iets
    public function schrijfUit(DataBase $db, string $email){

        //kijkt of de mail al bestaat als die niet bestaat dan komt die in de DAtaBase te komen
        if ($this->emailBestaat($email) == false) {
            try {
                $result = $db->querry("DELETE FROM nieuwsbrief WHERE nieuwsbrief_email = ?", "s", $email);


            } catch (Exception $e) {
                $arr = array("error" => $e->getMessage());
                echo json_encode($arr);

            }
        }
    }
}




?>
