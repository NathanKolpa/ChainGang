<?php


class RestController extends Controller
{

    private $dataBase;

    public function __construct($dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function createView()
    {
        if(isset($_POST["request_type"]))
        {
            switch($_POST["request_type"])
            {
                case "vote":
                    {
                        try
                        {
                            $user = User::getUserByID($this->dataBase, $_SESSION["userid"]);
                            $review = Review::getReviewById($this->dataBase, $_POST["review_id"]);

                            $review->vote($user, $_POST["is_up"] == "true" ? true : false);

                            $arr = array("status" =>":)");
                            echo json_encode($arr);
                        }
                        catch(Exception $e)
                        {
                            $arr = array("error" => $e->getMessage());
                            echo json_encode($arr);
                        }
                    }
                    break;
            }
        }
        else
        {
            echo "<script>window.location.href = 'home'</script>";
        }
        
    }

}