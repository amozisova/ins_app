<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;
use App\Helpers\ViewHelper;
/**
 * User controller
 *
 */
class Insurances extends \Core\Controller
{

 /**
  * Display the user's insurance page
  *
  * @return void
  */
    public function viewAction()
    {
        $userData = $this->showInsuranceData();

        View::renderTemplate('Insurance/index.html', (array) $userData);
    }

    /**
     * Function to call for insurance details of a user
     * Sends user ID and client data to User model
     *
     * @return void
     */
    private function showInsuranceData()
    {
        $user = new User;
        $id = $_SESSION['user_id'];
        $query = 'ins_number, ins_cat, startdate, enddate, ins_status';
        $tableName='insurances';
        $userData = $user->getClientData($id, $tableName, $query);
        return $userData;
    }
}