<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    if($_SESSION["user_id"]== NULL || $_SESSION["role"]!= "student"){

        header("Location: login.php");
    }
    include ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/ashesisupportcenter/views/header.php');
?>
    <div class="container">
        <div class="jumbotron">
            <h3>Send your compaints to us!</h3>
            <hr>

            <form class="was-validated" method="POST">
              <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp"
                    placeholder="complaint title" name="title" required>

              <div class="mb-3">
                <label for="validationTextarea">Details</label>
                <textarea class="form-control is-invalid" id="validationTextarea" placeholder="Enter the complaint details" name="description" required></textarea>
                <div class="invalid-feedback">
                  Please enter a message in the textarea.
                </div>
              </div>

              <button type="submit" class="btn btn-primary" name="SubmitClicked">Submit</button>

            </form>
        </div>
        <a href="#" class="btn btn-primary" name="SubmitClicked">Go to dashboard</a> <br>

      </div>
    </div>

<?php

    require ('viewComplaints.php');

    if (isset($_POST['title'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
       postComplaint($title, $description);
    }

    specificView($_SESSION["user_id"]);

    function postComplaint($title, $description)
    {

        // require ($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/db/dbConnection.php');

        $servername = "cs.ashesi.edu.gh";
        $username = "esther_oduro";
        $password = "esther_oduro";
        $dbname = "webtech_fall2019_esther_oduro";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }

        $user_id = $_SESSION['user_id'];


        //Post the stuff into the database
        $postSQL = "insert into request (user_id, subject, decription, status) values( $user_id, '$title', '$description', 'Pending')";

        //$dummy = mysqli->query($conn, $postSQL);
        if ($conn->query($postSQL) === TRUE) {
            echo "<br><div class='container'><div class='alert alert-success'>
  complaint successfully sent!
</div></div>";
        } else {
            echo "Error: " . $postSQL . "<br>" . $conn->error;
            echo "<br><div class='container'><div class='alert alert-danger'>
  Internal error, please try again!
</div></div>";
die("Connection failed: " . $conn->connect_error);
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
