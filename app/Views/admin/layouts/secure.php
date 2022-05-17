<?php

function isConnect()
{
    if(!isset($_SESSION['id']))
    throw new Exception("Vous n'êtes pas administrateur");
}