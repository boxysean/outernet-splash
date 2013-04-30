<?php

include_once "../lib/config.php";
include_once "../lib/ldap.php";

session_start();

$ldapconfig = array();
$ldapconfig['host'] = 'localhost';
$ldapconfig['port'] = NULL;
$ldapconfig['basedn'] = 'ou=people, dc=outerwebs, dc=nodomain';

$result = array();

function ldap_authenticate($user, $pass) {
    global $ldapconfig;
    
    $ds = ldap_connect($ldapconfig['host'], $ldapconfig['port']);
    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    $r = ldap_search($ds, $ldapconfig['basedn'], 'cn=' . $user);

    if ($r) {
      $r = ldap_get_entries($ds, $r);
      if ($r[0]) {
        if (ldap_bind($ds, $r[0]['dn'], $pass)) {
          return $r[0];
        }
      }
    }

    return false;
}

$name = array_key_exists("username", $_REQUEST) ? $_REQUEST["username"] : NULL;
$pass = array_key_exists("password", $_REQUEST) ? $_REQUEST["password"] : NULL;

if (!isset($name) && !isset($pass)) {
    $result["error"] = "Please enter your username and password!";
} elseif( empty($name) ) {
    $result["error"] = "Please enter username!";
} elseif( empty($pass) ) {
    $result["error"] = "Please enter password!";
} elseif(ldap_authenticate($name, $pass)) {
    // Authentication successful - Set session
    $_SESSION['auth'] = 1;
    $_SESSION['username'] = $name;
    $_SESSION['password'] = $pass;

    session_write_close();

    session_name("osclass");
    session_start();

    mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    mysql_select_db(DB_NAME);
    $res = mysql_query("select pk_i_id from oc_t_user where s_username = '$name'");
    $row = mysql_fetch_assoc($res);

    $_SESSION["userId"] = $row["pk_i_id"]; //osclass id lookup
    $_SESSION["userName"] = $name;

    $ldap = LDAP::getConnection();
    $ldap->bindAnonymously();

    $_SESSION["userEmail"] = $ldap->getInternalEmail($name);
    $_SESSION["userPhone"] = $ldap->getPhone($name);

    $ldap->unbind();

    session_write_close();

    $result["message"] = "Logged in!";
    $result["success"] = 1;
} else {
    $result["error"] = "Incorrect username or password!";
}

header('Content-type: application/json');
echo json_encode($result);

?>
