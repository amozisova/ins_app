<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * User controller
 *
 */
class Insurances extends \Core\Controller
{

    /**
     * Show the User Details page
     *
     * @return void
     */
    public function viewAction()
    {
        $userData = $this->showInsuranceData();
        View::renderTemplate('Insurance/index.html', ['insurance' => $userData]);
    }

    private function showInsuranceData()
    {
        $user = new User;
        $id = $_SESSION['user_id'];
        $query = 'ins_number, ins_cat, startdate, enddate, ins_status';
        $tableName='insurances';
        $userData = $user->getClientData($id, $tableName, $query);
        return $userData;
    }
/*
Pojištění vozidel
Pojištění majetku a odpovědnosti
Pojištění osob
Cestovní pojištění
 */
}