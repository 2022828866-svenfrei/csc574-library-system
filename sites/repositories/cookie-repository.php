<?php
define("cookieName", "currenUser");

function getCurrentUser()
{
    if (isset($_COOKIE[cookieName])) {
        return $_COOKIE[cookieName];
    }

    return null;
}

function setCurrentUser($user)
{
    setcookie(cookieName, $user);
}

function removeCurrentUser()
{
    setcookie(cookieName, "", time() - 1);
}
?>