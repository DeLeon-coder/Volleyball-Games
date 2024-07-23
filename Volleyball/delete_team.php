<?php
//This page deletes a team

//Check for a valid user ID, through GET or POST
if((isset($_GET['id'])) && (is_numeric
($GET['id']))) {//}