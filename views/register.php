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
    <script src="js/validation.js"></script>
   <?php

    include("header.php");

    if(!isset($_SESSION))
    {
        session_start();
    }
   ?>

    <div class="container">
        <form method="POST" onSubmit=" return callValidator()">
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
            <button type="submit" name="submit" class="btn btn-primary" value="Submit">Submit</button>
        </form>
    </div>
<?php
    if(isset($_POST['submit'])){
        require($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/controllers/crud.php');

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $userName = $firstName.".".$lastName;
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!search("email", $email)){

            $newUser = new User($userName, $email, $firstName, $lastName, $password, "student");
            $newUser->createUser();

        }else{
            echo "<div class='alert alert-danger'>
  <strong>Danger!</strong> Email has already been registered.
</div>";
        }
    }
?>

</body>
