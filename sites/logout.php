<?php
require("repositories/cookie-repository.php");

removeCurrentUser();
echo "<script>window.parent.location.reload();</script>"; // reload page with js command
?>