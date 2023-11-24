<?php
session_start();

$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'siste_reportes'
) or die();
