<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    include ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/ashesisupportcenter/views/header.php');
    require($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/controllers/crud.php');

    if(isset($_POST['assign'])){
        $_SESSION['request_id'] = $_POST['reqId'];
        // changeStatus($_POST['reqId'], "In-progress");
    }
viewUser("staff");
function viewUser($role){
    require ($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/db/dbConnection.php');

    $sql = "SELECT user_id, f_name, l_name, email, is_admin FROM user WHERE is_admin='$role'";
    $result = $conn->query($sql);
    echo "<div class='container'><center><h3>Here is the list of staff</h3></center><div>";
    if ($result->num_rows > 0){
        echo "<div class=homebg' data-stellar-background-ratio='0.5'>
    <div class='container midownshift'>
        <ul class='list-group'>

        ";while($row = $result->fetch_assoc())
            {

          echo "<form method='POST'>

            <li class='list-group-item list-group-item-light'>
                <div class='row'>
                    <div class=col-lg-3>
                        <img src='images/profile.png' alt='...' class='img-thumbnail'>
                    </div>
                    <input type='hidden' id='custId' name='user_id' value='". $row["user_id"]. "'>

                    <div class='col-lg-8'>
                        <h6>". $row['f_name']. " ". $row['l_name'] ."</h6>

                        <input class='btn btn-success' type='submit' name='submit' value='assign'></button>
                    </div>
                </div>

            </li>
            </form>
            ";}
            echo"
        </ul>
        </div>
        </div>
        ";

        // return TRUE;
    }else{
        // return FALSE;
    }


    if(isset($_POST['submit'])){
        changeStatus($_SESSION['request_id'], "In-progress");
        assigneStaff($_POST['user_id'], $_SESSION['request_id']);

    }

    $conn->close();
}
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>

</html>
