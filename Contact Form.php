<?php include 'include/header.php';
$msg = '';
$msgClass = '';

?>
<nav class="navbar">
  <div class="container">
    <div class="navbar-header">
      <a href="about.php" class="nav-brand">
        About</a>
    </div>
  </div>
</nav>
<?php
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

if (filter_has_var(INPUT_POST, 'submit')) {
  if (!empty($email) && !empty($name) && !empty($message)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      $msg = 'Please use a valid Email';
      $msgClass = 'alert-danger';
    } else {
      //Passed
      $toEmail = 'joshnjenga066@gmail.com';
      $subject = 'Contact form request from ' . $name;
      $body = "<h2>Contact Request</h2>
      <h4>Name</h4><p>." . $name . "</p>
      <h4>Email</h4><p>." . $email . "</p>
      <h4>Message</h4><p>." . $message . "</p>
      ";

      $header = "MIME-Version: 1.0" . "\r\n";
      $header .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
      $header .= "From: " . $name . " <" . $email . ">" . "\r\n";

      if (mail($toEmail, $subject, $body, $header)) {
        $msg = 'Email sent';
        $msgClass = 'Alert-success';
      } else {
        $msg = 'Not sent';
        $msgClass = "alert-danger";
      }
    }
  } else {
    $msg = "Fill all sections";
    $msgClass = 'alert-danger';
  }
} ?>
<div class="container">
  <?php
  if ($msg != ''): ?>
    <div class="alert <?php echo $msgClass; ?>">
      <?php echo $msg; ?>
    </div>
  <?php endif; ?>
  <form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control"
        value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>">
    </div>
    <div class="form-group">
      <label for="message">Message</label>
      <textarea name="message" class="form-control" id="message" cols="30" rows="10"><?php
      echo isset($_POST['message']) ? $message : ''; ?></textarea>
    </div>
    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
  </form>
</div>
<?php include 'include/footer.php'; ?>