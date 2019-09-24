<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
      body{ font: 14px sans-serif; }
      .wrapper{ width: 350px; padding: 20px; }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <h2>Reseteaza Parola</h2>
      <p>Completeaza campurile pentru restarea parolei.</p>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group <?php echo (!empty($new_pass_err)) ? 'has-error' : ''; ?>">
          <label>Noua Parola</label>
          <input type="password" name="new_pass" class="form-control" value="<?php echo $new_pass; ?>">
          <span class="help-block"><?php echo $new_pass_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_pass_err)) ? 'has-error' : ''; ?>">
          <label>Confirma Parola</label>
          <input type="password" name="confirm_pass" class="form-control" value="<?php echo $confirm_pass; ?>">
          <span class="help-block"><?php echo $confirm_pass_err; ?></span>
        </div>
        <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit">
        <a class="btn btn-link" href="welcome.php">Renunta</a>
       </div>
      </form>
    </div>
  </body>
</html>
