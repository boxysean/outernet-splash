<?php

include_once "../lib/config.php";
include_once "../lib/ldap.php";

$result = array();

if (!array_key_exists("username", $_REQUEST)) {
    $result["error"] = "Please enter a username.";
} else if (!array_key_exists("password", $_REQUEST)) {
    $result["error"] = "Please enter a password.";
} else if (!array_key_exists("password2", $_REQUEST)) {
    $result["error"] = "Please repeat the password.";
} else if ($_REQUEST["password"] != $_REQUEST["password2"]) {
    $result["error"] = "The passwords do not match.";
} else {
    $ldap = LDAP::getConnection();

    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];

    if (array_key_exists("email", $_REQUEST)) {
        $email = $_REQUEST["email"];
    } else {
        $email = "";
    }

    if (array_key_exists("phone", $_REQUEST)) {
        $phone = $_REQUEST["phone"];
    } else {
        $phone = "";
    }
    
    if (!$ldap->bindAdmin()) {
        $result["error"] = "Server error. Try again later. (#1)";
    } else if ($ldap->getUserEntry($username)) {
        $result["error"] = "That username already in use. Please pick another one.";
    } else if (!$ldap->addUserEntry($username, $password, $email, $phone)) {
        $result["error"] = "Server error. Try again later. (#2)";
    } else {
        $result["success"] = 1;
        $result["message"] = "Registration successful";
        session_start();
        $_SESSION['auth'] = 1;
        $_SESSION['username'] = $name;
        $_SESSION['password'] = $pass;
        session_write_close();
    }
}

header('Content-type: application/json');
echo json_encode($result);

?>

