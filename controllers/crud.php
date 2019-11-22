<?php

if(!isset($_SESSION))
    {
        session_start();
    }
$removeClicked;
// $assignedClicked = $_POST['assign'];
// $completeClicked = $_POST['complete'];
if (isset($_POST['remove'])){

    $removeClicked = $_POST['remove'];
    delete($_POST['reqId']);
}

if(isset($_POST['complete'])){
    changeStatus($_POST['reqId'], "Completed");
}

/**
 * if the admin selects assign, the status will change to In progress because it is assumed that some one is working on
 */



function delete($id){
    require ($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/db/dbConnection.php');

    $sql = "UPDATE request SET is_active = 'archived' WHERE request_id = $id";
    if ($conn->query($sql) === TRUE) {
    echo "<br><div class='container'><div class='alert alert-success'>
   successfully deleted record!
</div></div>";

    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $conn->close();
}

function changeStatus($id, $status){
    require ($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/db/dbConnection.php');

    $sql = "UPDATE request SET status='$status' WHERE request_id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $conn->close();
}

function assigneStaff($user_id, $req_id){
    require ($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/db/dbConnection.php');

    $sql = "UPDATE request SET staff_assigned='$user_id' WHERE request_id='$req_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<br><div class='container'><div class='alert alert-success'>
  Task successfully assigned!
</div></div>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $conn->close();
}

/**
 * User specific crud
 */

//  function createUser($userName, $email, $firstName, $lastName, $passwrd, $status){
//      $passwrd = md5($passwrd);
//     require ($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/db/dbConnection.php');
//     echo($passwrd);
//     $sql = "insert into user (username, email, f_name, l_name,	password, is_admin) values('$userName', '$email', '$firstName', '$lastName', '$passwrd', '$status')";

//     if ($conn->query($sql) === TRUE) {
//             echo "<br><div class='container'><div class='alert alert-success'>
//   User successfully created!
// </div></div>";
//         } else {
//             echo "Error: " . $postSQL . "<br>" . $conn->error;
//         }
//         $conn->close();
//  }


 /**
  * Key pair search to make it easier to check if a value is in the database
  */
 function search($attribute, $value){
    require ($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/db/dbConnection.php');

    $sql = "SELECT $attribute FROM user WHERE $attribute='$value'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        return TRUE;
    }else{
        return FALSE;
    }
    $conn->close();
 }


 /**
  * This function return true if the login details are correct and false otherwise.
  */

  function login($email, $passwrd){
    $passwrd = md5($passwrd);
    require ($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/db/dbConnection.php');

    $sql = "SELECT user_id, email, password, is_admin FROM user WHERE email='$email' AND password='$passwrd'";
    $result = $conn->query($sql);
    return $result;

    $conn->close();
  }




  class User{
    private $userName = null;
    private $email = null;
    private $firstName = null;
    private $lastName  =null;
    private $passwrd = null;
    private $status = null;

    function __construct($userName, $email, $firstName, $lastName, $passwrd, $mstatus){
        $this->userName =$userName;
        $this->email = $email;
        $this->firstName =$firstName;
        $this->lastName  = $lastName;
        $this->passwrd = $passwrd;
        $this->status = $mstatus;
    }

    function createUser(){
        $passwrd = md5($this->passwrd);
        require ($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/db/dbConnection.php');

        $sql = "insert into user (username, email, f_name, l_name,	password, is_admin) values('$this->userName', '$this->email', '$this->firstName', '$this->lastName', '$passwrd', '$this->status')";

        if ($conn->query($sql) === TRUE) {
                echo "<br><div class='container'><div class='alert alert-success'>
                    User successfully created!
                    </div></div>";
            } else {
                echo "Error: " . $postSQL . "<br>" . $conn->error;
            }
            $conn->close();
    }
  }
?>
