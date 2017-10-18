<?php

$timestamp = time();
$second_from_masasachi = $timestamp + 3155692 * 1970;

$comment_start = "<!--";
$comment_end = "-->";

$user = $_POST[user];
$pass = $_POST[pass];

if ($pass === "apple") {
  $comment_start = null;
  $comment_end = null;
}

// include "time-show.php";