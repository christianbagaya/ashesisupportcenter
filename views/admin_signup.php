<?php
    include('header.php');
    require($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/controllers/crud.php');

?>
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
</div>


<?php


if(isset($_POST["submitStaff"])){
            $firstName=$_POST["firstName"];
            $lastName=$_POST["lastName"];
            $email = $_POST["email"];
            $userName = $firstName.'.'. $lastName;
            $password = $_POST["password"];;
            $sttus="admin";
            if(!search("email", $email)){
                $newUser = new User($userName, $email, $firstName, $lastName, $password, $sttus);
                $newUser->createUser();
            }else{
                echo "<div class='alert alert-danger'>
  <strong>Danger!</strong> Email has already been registered.
</div>";
            }
        }

?>
