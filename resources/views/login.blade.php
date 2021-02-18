<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Login</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=URL::to('/')?>/resources/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?=URL::to('/')?>/resources/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Plugin CSS -->
    <link href="<?=URL::to('/')?>/resources/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet"> 
    <!-- Custom styles for this template -->
    <link href="<?=URL::to('/')?>/resources/css/sb-admin.css" rel="stylesheet">
    <style>
    h2 {color: white; }
    p {color: red;}
    </style>
</head>

<body>
 <div class="container">

      <form class="form-signin" action="<?=URL::to('/')?>/login" method="POST">
        @csrf
        <h2 class="form-signin-heading">Please sign in</h2>
        <p><?php
            if ($error == 1) { echo "Too Many Login Attempts"; }
            if ($error == 2) { echo "Invalid Login Credentials."; }
        ?></p> 
        <input type="username" name="username" class="form-control" placeholder="Username" required autofocus> 
        <input type="password" name="password" class="form-control" placeholder="Password" required> 
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign in">
      </form>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript -->
    <script src="<?=URL::to('/')?>/resources/vendor/jquery/jquery.min.js"></script>
    <script src="<?=URL::to('/')?>/resources/vendor/tether/tether.min.js"></script>
    <script src="<?=URL::to('/')?>/resources/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?=URL::to('/')?>/resources/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?=URL::to('/')?>/resources/vendor/chart.js/Chart.min.js"></script>
    <script src="<?=URL::to('/')?>/resources/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?=URL::to('/')?>/resources/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?=URL::to('/')?>/resources/js/sb-admin.min.js"></script>

</body>

</html>
