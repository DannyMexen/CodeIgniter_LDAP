<?php

/**
 * "login.php" View Doc Comment
 * PHP Version PHP 7.1.8-1ubuntu1
 *
 * @category View
 * @package  None
 * @author   Display Name <dannymexen@gmail.com>
 * @license  https://choosealicense.com/licenses/mit/; MIT
 * @link     https://github.com/DannyMexen/CodeIgniter_LDAP
 */

$error_message = $messages[0];
$success_message = $messages[1];
?>
<nav class="navbar navbar-default navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
     <p class="navbar-text">CodeIgniter LDAP Login</p>
    </div>
  </div>
</nav>
<br>

<div class="col-lg-4"></div>
<div class="container well col-lg-4">
    <?php echo form_open('login'); ?>
    <fieldset>
        <legend>Enter credentials here.</legend>
        
        <?php echo validation_errors(); ?>
    
        <?php
        if ($error_message == "") {
            echo "<p class=\"text-success\">{$success_message}</p>";
        } else {
            echo "<p class=\"text-danger\">{$error_message}</p>";
        }
    ?>
    
    <!-- Username -->
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username"
         name="username" placeholder="Username">
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password"
         name="password" placeholder="Password">
  </div>

  <button type="submit" class="btn btn-primary btn-sm">Login</button>
</fieldset>
    <?php echo form_close(); ?>
</div>
<div class="col-lg-4"></div>
<?php


