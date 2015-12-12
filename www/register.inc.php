<table class="table">
<tr>
  <td>

<form class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="post">
  <div class="form-group">
    <label for="FirstName" class="col-sm-2 control-label">First Name</label>
    <div class="col-sm-10">
      <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" value="<?php echo $firstname;?>"> <label class="control-label has-error" for="inputError1"><?php echo $firstnameErr;?></label>
    </div>
  </div>
  <div class="form-group">
    <label for="LastName" class="col-sm-2 control-label">Last Name</label>
    <div class="col-sm-10">
      <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name" value="<?php echo $lastname;?>"> <label class="control-label has-error" for="inputError1"><?php echo $lastnameErr;?></label>
    </div>
  </div>
  <div class="form-group">
    <label for="Email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="type" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $email;?>"> <label class="control-label has-error" for="inputError1"><?php echo $emailErr;?><br /><?php echo $emailexistsErr;?></label>
    </div>
  </div>
  <div class="form-group">
    <label for="Password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password"> <label class="control-label has-error" for="inputError1"><?php echo $passwordErr;?></label>
    </div>
  </div>
  <div class="form-group">
    <label for="Password2" class="col-sm-2 control-label">Confirm Password</label>
    <div class="col-sm-10">
      <input type="password" name="password2" class="form-control" id="password2" placeholder="Confirm Password"> <label class="control-label has-error" for="inputError1"><?php echo $password2Err;?> <br /><?php echo $passwordmismatchedErr; ?></label>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" value="Register" class="btn btn-default">Register</button>
    </div>
  </div>
</form>
	
  </td>
</tr>
</table>