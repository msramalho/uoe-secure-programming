<?php
ini_set('display_errors', 'On');
session_start();

// Reload the page
function reload_page()
{
    print("<script>location.reload()</script>");
}

// Get the database
function get_db()
{
    $db = new PDO('sqlite:db/ds_service.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

// Check if user exists
function check_uniqueness($db, $username)
{
    $check = $db->prepare("SELECT * FROM users WHERE username=:name");
    $check->bindParam(':name', $username);
    $result = $check->execute();

    if ($result) {
        while ($row = $check->fetch()) {
            return False;
        }
        return True;
    }

    return False;
}


// Add a user to the database
function add_user($db, $username, $password)
{
    $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
    $insert = $db->prepare("INSERT INTO users VALUES(:name, :pass)");
    $insert->bindParam(':name', $username);
    $insert->bindParam(':pass', $hash);
    $insert->execute();

    print("<p>Created login for '{$username}'.</p>");
}

// Try and sign a user up
function signup($username, $password)
{
    try {
        $db = get_db();
        if (check_uniqueness($db, $username)) {
            //TODO: could verify that password is "secure enough"
            add_user($db, $username, $password);
        } else {
            print("<p>Username '{$username}' is already registered.</p>");
        }
    } catch (PDOException $e) {
        print($e->getMessage());
    }
}


// Create a session token
function create_token($username)
{
    // global $_SESSION;
    // setcookie("username", $username);
    // setcookie("session", md5($username));
    $_SESSION["username"] = $username;
}

// Check a session token
function check_token($username)
{
    // global $_SESSION;
    // return (md5($username) == $session);
    return isset($_SESSION["username"]);
}

// Destroy the session token
function logout()
{
    // setcookie("username", "", time() - 3600);
    // setcookie("session", "", time() - 3600);
    session_destroy();
    session_start();
}

function login($username, $password)
{
    logout();
    try {
        $db = get_db();
        $check = $db->prepare("SELECT password FROM users WHERE username=:name");
        $check->bindParam(':name', $username);
        $check->execute();
        $hash = $check->fetch();
        if(password_verify($password, $hash["password"])){
            // create_token($username);
            $_SESSION["username"] = $username;
            return True;
        }
    } catch (PDOException $e) {
        print($e->getMessage());
    }
    return False;
}

// Check if there is a user signed in
function check_signed_in()
{
    return isset($_SESSION["username"]);
    // if (isset($_COOKIE['username'], $_COOKIE['session'])) {
    //     if (check_token($_COOKIE['username'], $_COOKIE['session'])) {
    //         return True;
    //     } else {
    //         logout();
    //     }
    // }
    // return False;
}


//is there a post request
function is_post()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

//force pages to only accept post requests
function post_only()
{
    if (!is_post()) {
        echo "endpoint only accepts POST requests";
        exit();
    }
}

function echo_and_die($message)
{
    echo $message;
    exit();
}

function is_password_secure($password)
{
    return strlen($password) > 5;
}
