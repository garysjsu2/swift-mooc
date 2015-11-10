<?php
/**
 * File: header.php
 * @author Khan Ly <khantly@yahoo.com>
 */
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 2 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Note there is no responsive meta tag here -->

    <link rel="icon" href="favicon.ico">

    <title>MOOC Mashup</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/non-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Header -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
          <a class="navbar-brand" href="index.php">MOOC Mashup</a>
        </div>
        <!-- Note that the .navbar-collapse and .collapse classes have been removed from the #navbar -->
        <div id="navbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="view.php">Courses</a></li>
            <li><a href="#search">Course Search</a></li>
            <li><a href="#myCourses">My Courses</a></li>
            <li><a href="#profile">Profile</a></li>
            <li><a href="#dashboard">User Dashboard</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="" data-toggle="modal" data-target="#myRegister">Register</a></li>
            <li><a href="" data-toggle="modal" data-target="#myLogin">Login</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <!-- End Header -->
    
    <!-- Search -->
         <form class="form-inline" role="form" style="text-align:center;">
            <div class="form-group">
               <select class="form-control">
                  <option>title</option>
                  <option>professor</option>
                  <option>university</option>
               </select>
            </div>
            <div class="form-group">
               <input type="text" class="form-control" size="50" placeholder="Search Query">
            </div>
            <button type="submit" class="btn btn-default">search</button>
            <div class="form-group">
               <a data-toggle="collapse" href="#advancedSearch" aria-expanded="false" aria-controls="advancedSearch">advanced search</a>
            </div>
         </form>
         <br />
    <!-- End Search -->

    <!-- Advanced Search -->
<div class="collapse" id="advancedSearch">
  <div class="container well" style="text-align: center;">
<!---->
<label class="checkbox-inline">
  <input type="checkbox" id="inlineCheckbox2" value="option2" checked> edX
</label>
<label class="checkbox-inline">
  <input type="checkbox" id="inlineCheckbox3" value="option3" checked> NovoEd
</label>
<br />
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked> Both
</label>
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Paid
</label>
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Free
</label>
<!---->
  </div>
</div>
    <!-- End Advanced Search -->
  
  <!--- Register --->
<div class="modal fade" id="myRegister" tabindex="-1" role="dialog" aria-labelledby="Register">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="Register">Register</h4>
      </div>
      <div class="modal-body">
<!----->
<form>
  <div class="form-group">
    <label for="Username">Username</label>
    <input type="username" class="form-control" id="Username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="Email">Email address</label>
    <input type="email" class="form-control" id="Email" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="Password">Password</label>
    <input type="password" class="form-control" id="Password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="Password2">Retype Password</label>
    <input type="password2" class="form-control" id="Password2" placeholder="Retype Password">
  </div>
  <button type="submit" class="btn btn-default">Register</button>
</form>
<!----->
      </div>
    </div>
  </div>
</div>
  <!--- End Register --->
  <!--- Login --->
<div class="modal fade" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="Login">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="Login">Login</h4>
      </div>
      <div class="modal-body">

<!----->
<form class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>
<!----->
      </div>
    </div>
  </div>
</div>
  <!--- End Login --->


  <div class="container">
