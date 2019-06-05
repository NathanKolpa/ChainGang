<?php

require_once config["CONTROLLER_FOLDER"] . "PageController.php";


class CatogorieController extends PageController
{
    public function __construct($db)
    {
        parent::__construct("Catogorie.phtml", "Catogorie", $db);
    }

    protected function getData() : array
    {
        $arr = array();
        $searchError = null;
        if(isset($_GET["cat"]) && $_GET["cat"])
        {
            try
            {
                $catogorie = Catogorie::searchCatogorieByName($this->dataBase, $_GET["cat"]);
                $arr = $catogorie->getProducts();
            }
            catch(Exception $e)
            {
                $searchError = $e->getMessage();
            }
        }
        else if(isset($_GET["search"]))
        {
            try
            {
                $arr = product::searchProductsByName($this->dataBase, $_GET["search"]);
            }
            catch(Exception $e)
            {
                $searchError = $e->getMessage();

            }
        }
        else
        {
            $arr = Catogorie::getAllProducts($this->dataBase);
        }


        return array("producten" => $arr, "searchError" =>$searchError);
    }
}

?>
