<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;
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
        $insuranceData = $this->showInsuranceData();

        View::renderTemplate('Insurance/index.html', ['insurancesData'=> $insuranceData]);
    }

 /**
  * Display the user's insurance details page
  *
  * @return void
  */
    public function detailsAction()
    {
        $insuranceInfo = $this->showInsuranceData();
        $insDetails = $this->showInsuranceDetails();
    
        View::renderTemplate('Insurance/details.html', ['insuranceInfo' =>$insuranceInfo, 'insuranceDetails'=> $insDetails, 'id'=> $_GET['id']]);
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
        $tableName='insurances';
        $searchBy='client_id';
        $query = 'ins_number, ins_cat, startdate, enddate, ins_status';
     
        $userData = $user->getClientData($id, $tableName, $searchBy, $query);
        return $userData;
    }



    private function showInsuranceDetails()
    {
        $user = new User;

        $id = $_GET['id'];
        $tableName='payments';
        $searchBy = 'ins_id';
        $query = 'pay_ammount, pay_until, pay_via, frequency, pay_to, pay_status';
    
        $userData = $user->getClientData($id, $tableName, $searchBy, $query);
        return $userData;
    }
	
}
