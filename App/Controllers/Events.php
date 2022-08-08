<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;
/**
 * User controller
 *
 */
class Events extends \Core\Controller
{

/**
  * Display the user's events page
  *
  * @return void
  */
  public function viewAction()
  {
      $userData = $this->showEventsData();

      View::renderTemplate('Events/index.html', ['eventsData'=> $userData]);
  }

  /**
   * Function to call for events details of a user
   * Sends user ID and client data to User model
   *
   * @return void
   */
  private function showEventsData()
  {
      $user = new User;
   
      $id = $_SESSION['user_id'];
      $tableName='event_details';
      $searchBy='client_id';
      $query = 'event_num, ins_cat, ins_number, event_date,	status';
    
      $userData = $user->getClientData($id, $tableName, $searchBy, $query);
      return $userData;
  }

}