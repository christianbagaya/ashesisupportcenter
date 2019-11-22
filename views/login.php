<?php if(!isset($_SESSION))
    {
        session_start();
    }?>
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
        include("header.php")
    ?>

    <div class="container">
        <form method = "POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter email" name = "email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name= "password">
            </div>
            <div class="form-group form-check">
                <p>Not registered? sign up <a href="register.php">here</a></p>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>


<?php

        require($_SERVER['CONTEXT_DOCUMENT_ROOT']. '/ashesisupportcenter/controllers/crud.php');

        if(isset($_POST["submit"])){
            $email = $_POST["email"];
            $password = $_POST["password"];



            $record = login($email, $password);
            if($record->num_rows <= 0){
                echo "<br><div class='container'><div class='alert alert-danger'>
  Wrong email or password, please try again!
</div></div>";
            }else{
                while($row = $record->fetch_assoc())
               {
                echo $row["user_id"];
                $_SESSION["user_id"]= $row["user_id"];
                $_SESSION["role"] = $row["is_admin"];

                if($row["is_admin"]=="student"){
                    header("Location: postcomplaint.php");
                }

                if($row["is_admin"]=="admin"){
                    header("Location: admin.php");
                }

                if($row["is_admin"]== "staff"){
                    header("Location: staff.php");
                }

            }

        }
    }
?>

</body>
</html>
