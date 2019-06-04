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
                        if(isset($_SESSION["userid"]))
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
                    }
                    break;
                
                case "cartGet":
                    {
                        $arr = json_decode($_COOKIE["products"]);
                        $returnHTML = "";
                        $index = 0;
                        foreach($arr as $prodID)
                        {
                            $prod = Product::getProductByID($this->dataBase, $prodID);
                            $returnHTML .= 
                            "<div class='dropdown-item'>" .
                                "<ul class='list-inline'>" .
                                    "<li class='list-inline-item'>".
                                        $prod->getName() .
                                    "</li>".
                                    "<li class='list-inline-item'>".
                                        "€ " . $prod->getPrijs() .
                                    "</li>".
                                    "<li class='list-inline-item'>".
                                        "<button onclick='removeFromCart($index)'>X</button>".
                                    "</li>".
                                "</ul>" .
                            "</div>";
                            $index++;
                        }
                        echo json_encode($returnHTML);
                    }
                    break;

                case "sub":
                    {
                        if(isset($_SESSION["userid"]))
                        {
                            $ussr = User::getUserByID($this->dataBase, $_SESSION["userid"]);

                            NewsLetter::schrijfUserIn($this->dataBase, $ussr);
                        }
                        else
                        {
                            try {
                                NewsLetter::schrijfIn($this->dataBase, $_POST['email']);
    
                                $arr = array("status" => ":)");
                                echo json_encode($arr);
    
                                unset($sub);
    
                                echo 'ik heb de email in de controller';
                            }
                            catch(Exception $e)
                            {
                                $arr = array("error" => $e->getMessage());
                                echo json_encode($arr);
    
                                echo 'error in controller';
                            }
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