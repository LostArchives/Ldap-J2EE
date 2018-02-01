<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 1/29/18
 * Time: 3:44 PM
 */

/**
 * Class viewUtil created for template engine
 */
class viewUtil
{

    public static $viewId = "viewId";

    public static function getView($id){

        $data = array();

        switch ($id){
            case 0:

                $data["form"] = "parts/blocks/userForm.php";
                $data["list"] = "parts/blocks/usersList.php";

                break;

            case 1:

                $data["form"] = "parts/blocks/groupForm.php";
                $data["list"] = "parts/blocks/groupsList.php";

                break;

            default:

                break;
        }

        return $data;
    }
}