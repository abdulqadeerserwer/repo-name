<?php 
    // Message Vars 
    $msg = '';
    $msgClass = '';

    // Check For Submit
    if(filter_has_var(INPUT_POST, 'submit')){
      // Get Form data
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $message = htmlspecialchars($_POST['message']);

      // Check Required Fields 
      if(!empty($name) && !empty($email) && !empty($message)) {
        // Passed
          // Check Email
          if(filter_var($email, FILTER_VALIDATE_EMAIL) === false ) {
            // Failed 
            $msg = '<h4 class="alert-heading">Warning!</h4>'.'Please enter a valid email address';
            $msgClass = 'alert alert-dismissible alert-warning';
          } else {
            // Passed
            $toEmail = 'a.qadeerserwer55@gmail.com';
            $subject = 'Contact Request From '.$name;
            $body    = '<h2>Contact Request</h2>
                        <h4>Name</h4><p>'.$name.'</p>
                        <h4>Email</h4><p>'.$email.'</p>
                        <h4>Message</h4><p>'.$message.'</p>';

            // Email Headers 
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";
            
            
            // Additional Headers
            $headers .= "From: " .$name. "<" .$email. ">". "\r\n";

            if(mail($toEmail, $subject, $body, $headers)) {
                // Email Sent
                $msg = '<h4 class="alert-heading">Sucessfully Done!</h4>'.'Your email has been sent';
                $msgClass = 'alert alert-dismissible alert-success';
            } else {
                // Failed 
                $msg = '<h4 class="alert-heading">Warning!</h4>'.'Your email was not sent';
                $msgClass = 'alert alert-dismissible alert-warning';
            }



          }
      } else {
        // Failed
        $msg = '<h4 class="alert-heading">Warning!</h4>'.'Please fill in all fields';
        $msgClass = 'alert alert-dismissible alert-warning';
      }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
  <title>Contact Form</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <a class="navbar-brand" href="index.php">Contact Form</a>
  </nav>
 

 <div class="container">
    <?php if($msg != ''): ?>
      <div class="alert mt-4 <?php echo $msgClass; ?>" > 
      <button type="button" class="close" data-dismiss="alert">&times;</button>
         <?php echo $msg; ?>
      </div>
    <?php endif; ?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <fieldset class="mt-4">
          <div class="form-group">
          <label for="Your Full Name">Name</label>
          <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $name : '' ?>" class="form-control"  placeholder="Your Full Name">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $email : '' ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleTextarea">Message</label>
          <textarea name="message" class="form-control" id="exampleTextarea" rows="3">
          <?php echo isset($_POST['message']) ? $message : '' ?>
          </textarea>
        </div>
        
        <button type="submit" name="submit" class="btn btn-outline-success">Submit</button>
      </fieldset>
</form>
</div>


<!-- Import jquery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
      $(document).ready(function () {
        $('.close').click(function(){
          $(".test").css("display", "none");
      }  

      }

</script>
  




</body>
</html>