

<?php

function viewAll($id=NULL)

    {
        //database connection variables
        require ($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/db/dbConnection.php');
        //write sql
        $sql = "SELECT request_id, subject, is_active, decription, status FROM request";

        $result = $conn->query($sql);



        //check if any result was returned
        if ($result->num_rows > 0)
        {
            echo "<div class='container'>
            <h4>Here are the complaints</h4><br>
            <ul class='list-group'>";


            //looping - output data of each row
            while($row = $result->fetch_assoc())
            {
                if($row["is_active"]== 'active'){
                    echo "
                    <li class='list-group-item list-group-item-light'>

                    <div class = 'row'>

                    <div class = 'col-lg-11'>
                        <form method= 'POST'>

                                <div class='row'>
                                    <div class='col-lg-6'>
                                        <h4><strong>". $row["subject"]."</strong></h4>
                                        <p>" . $row["description"]. "</p>
                                    </div>

                            ";
                            if($row["status"]== "Pending"){
                                echo" <small>Status: </small>
                            <div class='col-lg-2 text-danger'> Pending</div>

                            ";}
                            else if($row["status"]=="In-progress"){
                                echo "
                             <small>Status: </small>
                            <div class='col-lg-2 text-primary'> In Progress</div>

                            ";


                            }
                            else if($row["status"]=="Completed"){

                            echo "
                             <small>Status: </small>
                            <div class='col-lg-2 text-success'> Completed</div>
                            ";
                            }
                            echo "

                            <div class='col-lg-2'><input type = 'submit' class='btn btn-success'value = 'Mark as complete' name = 'complete'></div>

                            <div class='col-lg-1'><input type = 'submit' class='btn btn-primary'value = 'remove' name = 'remove'></div>


                        </div>

                        </form >
                    </div>

                    <div class = 'col-lg-1'>
                        <form method = 'POST' action='stafflist.php'>
                            <input type='hidden' id='custId' name='reqId' value='". $row["request_id"]. "'>
                            <div><input type = 'submit' class='btn btn-info'value = 'Assign' name = 'assign'></div>
                        </form>
                    </div>


                    </div>
                    </li>


                    ";
                }

            }

            echo "</ul>
            </div>";
        }
        else
        {
            echo "0 results";
        }

        require($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/controllers/crud.php');

        $conn->close();
    }

    function staffView($id){
        require ($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/db/dbConnection.php');
        $sql = "SELECT user_id, request_id, subject, is_active, decription, status, staff_assigned FROM request";

        $result = $conn->query($sql);

        //check if any result was returned
        if ($result->num_rows > 0 )
        {
            echo "<div class='container'>
            <h4>Here are your Tasks </h4><br>
            <ul class='list-group'>";

            //looping - output data of each row
            while($row = $result->fetch_assoc())
            {   if($id==NULL)
                {
                    echo "0 results";
                    return;

                }
               else if($row["is_active"]== 'active' && $row["staff_assigned"]== $id && $row["status"]=="In-progress"){
                    echo "
                    <form method= 'POST'>
                    <li class='list-group-item list-group-item-light'>
                        <div class='row'>
                            <div class='col-lg-7'>
                                <h4><strong>". $row["subject"]."</strong></h4>
                                <p>" . $row["description"]. "</p>
                            </div>

                            <input type='hidden' id='custId' name='reqId' value='". $row["request_id"]. "'>
                            ";if($row["status"]== "Pending"){
                                echo" <small>Status: </small>
                            <div class='col-lg-2 text-danger'> Pending</div>

                            <div class='col-lg-2'><input type = 'submit' class='btn btn-success'value = 'Mark as complete' name = 'complete'></div>

                            ";}
                            else if($row["status"]=="In-progress"){
                                echo "
                             <small>Status: </small>
                            <div class='col-lg-2 text-primary'> In Progress</div>

                            <div class='col-lg-2'><input type = 'submit' class='btn btn-success'value = 'Mark as complete' name = 'complete'></div>


                            ";


                            }
                            else if($row["status"]=="Completed"){


                            echo "
                             <small>Status: </small>
                            <div class='col-lg-2 text-success'> Completed</div>

                            <div class='col-lg-2'><input type = 'submit' class='btn btn-success'value = 'Mark as complete' name = 'complete'></div>

                            ";
                            }
                            echo "
                        </div>

                        <form >
                    ";
                }

            }
            echo "</ul>
            </div>";
        }

            echo"<br>
            <br>";




            echo "<div class='container'>
            <h4>Completed Tasks </h4><br>
            <ul class='list-group'>";

        $result = $conn->query($sql);

        //check if any result was returned
        if ($result->num_rows > 0 )
        {
            //looping - output data of each row
            while($row = $result->fetch_assoc())
            {   if($id==NULL)
                {
                    echo "0 results";
                    return;

                }
               else if($row["is_active"]== 'active' && $row["staff_assigned"]== $id && $row["status"]=="Completed"){
                    echo "
                    <form method= 'POST'>
                    <li class='list-group-item list-group-item-light'>
                        <div class='row'>
                            <div class='col-lg-8'>
                                <h4><strong>". $row["subject"]."</strong></h4>
                                <p>" . $row["description"]. "</p>
                            </div>

                            <input type='hidden' id='custId' name='reqId' value='". $row["request_id"]. "'>
                            ";if($row["status"]== "Pending"){
                                echo" <small>Status: </small>
                            <div class='col-lg-2 text-danger'> Pending</div>

                            <div class='col-lg-1'><input type = 'submit' class='btn btn-primary'value = 'remove' name = 'remove'></div>

                            ";}
                            else if($row["status"]=="In-progress"){
                                echo "
                             <small>Status: </small>
                            <div class='col-lg-2 text-primary'> In Progress</div>

                            <div class='col-lg-1'><input type = 'submit' class='btn btn-primary'value = 'remove' name = 'remove'></div>

                            ";


                            }
                            else if($row["status"]=="Completed"){


                            echo "
                             <small>Status: </small>
                            <div class='col-lg-2 text-success'> Completed</div>

                            <div class='col-lg-1'><input type = 'submit' class='btn btn-primary'value = 'remove' name = 'remove'></div>
                            ";
                            }
                            echo "
                        </div>

                        <form >
                    ";
                }

            }

            echo "</ul>
            </div>";
        }
        else
        {
            echo "0 results";
        }

        require($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/controllers/crud.php');

        $conn->close();

    }


    function specificView($id)

    {
        require ($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/db/dbConnection.php');

        //write sql
        $sql = "SELECT user_id, request_id, subject, is_active, decription, status FROM request";

        $result = $conn->query($sql);

        //check if any result was returned
        if ($result->num_rows > 0 )
        {
            echo "<div class='container'>
            <h4>Here are your complaints</h4><br>
            <ul class='list-group'>";

            //looping - output data of each row
            while($row = $result->fetch_assoc())
            {
                if($id==NULL)
                {
                    echo "0 results";
                }
                if($row["is_active"]== 'active' && $row["user_id"]== $id){
                    echo "
                    <form method= 'POST'>
                    <li class='list-group-item list-group-item-light'>
                        <div class='row'>
                            <div class='col-lg-8'>
                                <h4><strong>". $row["subject"]."</strong></h4>
                                <p>" . $row["description"]. "</p>
                            </div>

                            <input type='hidden' id='custId' name='reqId' value='". $row["request_id"]. "'>
                            ";if($row["status"]== "Pending"){
                                echo" <small>Status: </small>
                            <div class='col-lg-2 text-danger'> Pending</div>

                            <div class='col-lg-1'><input type = 'submit' class='btn btn-primary'value = 'remove' name = 'remove'></div>

                            ";}
                            else if($row["status"]=="In-progress"){
                                echo "
                             <small>Status: </small>
                            <div class='col-lg-2 text-primary'> In Progress</div>

                            <div class='col-lg-1'><input type = 'submit' class='btn btn-primary'value = 'remove' name = 'remove'></div>

                            ";


                            }
                            else if($row["status"]=="Completed"){


                            echo "
                             <small>Status: </small>
                            <div class='col-lg-2 text-success'> Completed</div>

                            <div class='col-lg-1'><input type = 'submit' class='btn btn-primary'value = 'remove' name = 'remove'></div>
                            ";
                            }
                            echo "
                        </div>

                        <form >
                    ";
                }

            }

            echo "</ul>
            </div>";
        }
        else
        {
            echo "0 results";
        }

        require($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/controllers/crud.php');

        $conn->close();
    }


?>
