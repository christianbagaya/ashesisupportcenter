<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>Ashesi Support Center</title>
</head>

<body>

    <?php

    if(!isset($_SESSION))
        {
            session_start();
        }
        include ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/ashesisupportcenter/views/header.php');

        $id = $_SESSION["user_id"];
        $role = $_SESSION["role"];
        if($role!= "admin"){
            require('logout.php');
            header("Location: login.php");
        }
    ?>
    <div class='container'><p> <a class='btn btn-primary' data-toggle='collapse' href='#collapseExample' role='button' aria-expanded='false' aria-controls='collapseExample'>
    Adding staff </a>
</p>
<div class='collapse' id='collapseExample'>
  <div class='card card-body'>
    <form method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstName" aria-describedby="emailHelp"
                placeholder="Enter First Name">

            <label for="exampleInputEmail1">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastName" aria-describedby="emailHelp"
                placeholder="Enter Last Name">

            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1"  name ="email" aria-describedby="emailHelp"
                placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group form-check">
            <p>Already have an account? login <a href="login.php">here</a></p>
        </div>
        <button onclick="callValidator()" type="submit" name="submitStaff" class="btn btn-primary" value="Submit">Submit</button>
    </form>
  </div>
</div></div>


    <?php

        include('viewComplaints.php');
        viewAll();

        if(isset($_POST["submitStaff"])){
            $firstName=$_POST["firstName"];
            $lastName=$_POST["lastName"];
            $email = $_POST["email"];
            $userName = $firstName.'.'. $lastName;
            $password = $_POST["password"];;
            $status="staff";
            if(!search("email", $email)){

                $newUser = new User($userName, $email, $firstName, $lastName, $password, $status);
                $newUser->createUser();
            }else{
                echo "<div class='alert alert-danger'>
  <strong>Danger!</strong> Email has already been registered.
</div>";
            }
        }
    ?>

    <!-- Footer -->
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
