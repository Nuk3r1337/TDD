<?php

//Then make minimal code for pass
class authentication
{
    function login($username, $password) {

        if($username == johnny && $password == 1234){
            return "yay";
        }
        else {
            return "fail";
        }

    }


//Refactor code so it makes sense in business terms
public function login($username, $password)
{

    $database = new \DATABASE\Database();

    $user = $database->query("SELECT id, username, password FROM users WHERE username = :username", ['username' => $username])->fetchAssoc();

    if (!isset($user) || empty($user)) {
        return "Brugernavn eller kodeord er forkert.";
    }

    $user = $user[0];

    if (!password_verify($password, $user["password"])) {
        return "Brugernavn eller kodeord er forkert.";
    }

    // $_SESSION["test"] = true;

    $_SESSION["USER_ID"] = $user["id"];
    $_SESSION["USERNAME"] = $user["username"];
    $_SESSION["LOGIN_STATUS"] = true;

    return true;

}
