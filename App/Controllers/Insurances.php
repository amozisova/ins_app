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
        $userData = $this->showInsuranceData();

        View::renderTemplate('Insurance/index.html', (array) $userData);
    }


    public function detailsAction()
    {
    
        $details = $this->showInsuranceDetails();
        //print_r($details);
        // echo $userData[0]['email'];

        /* TODO dořešit předání základních dat o pojištění + detailů 
        * možnosti: 
        *   řešit v databázi pohledem => vytvořit pohled a ten volat
        *   volat showInsuranceData a showInsuranceDetails => pak je třeba dořešit transaltor
        *   nějak uchovat obsah userData se základními daty o pojištění a k tomu zavolat showInsuranceDetails
        *   asi nejlepší volat více funkcí najednou, pro další rozšiřování - např. když budu chtít dodat další data o pojistce
        */
        
        View::renderTemplate('Insurance/details.html', (array) $details);
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


    # TODO dořešit zobrazení dat z DB tabulky payments#
 # TODO + překlady #