<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="styles/bootstrap-2.3.1.css">
        <link rel="stylesheet" href="styles/main.css">
        <script src="components/modernizr/modernizr.js"></script>
    </head>
    <body>
        <header>
        <div class="jumbotron shadow container">
            <div class="row">
                <div class="span6">
                    <a href="/"><img src="./images/outernet.png" id="logo" /></a>
                </div>
                <div class="offset3 span3" id="menubar">
                    <div id="menubar-container">

<?php
/* user is not logged in */
if (!array_key_exists('auth', $_SESSION) && $_SESSION['auth'] != 1) {
?>

                        <div class="btn-group">
                            <button class="btn-large dropdown-toggle login-toggle" data-toggle="dropdown">Login <span class="caret"></span></button>
                            <div class="dropdown-menu login-form">
                                <form action="actions/login.php" name="login-form" id="login-form">
                                    <p><label for="username">User name</label></p>
                                    <p><input name="username" type="text" id="username" /></p>
                                    <p><label for="password">Password</label></p>
                                    <p><input name="password" type="password" id="password" /></p>
                                    <p><button class="btn btn-primary" type="submit">Submit</button></p>
                                </form>
                            </div>
                        </div>
                        <a href="index.php?v=register">Register</a>
    
<?php
/* user is logged in */
} else {
?>

                        <a id="logout" href="actions/logout.php">Logout</a>
                        <a href="profile.html">Profile</a>
    
<?php
}
?>
                    </div>
                </div>
            </div>
        </div>
        </header>

