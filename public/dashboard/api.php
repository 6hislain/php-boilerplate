<?php
include_once('../../app/utility.php');
include_once('../../app/database.php');
auth();

header('Content-Type: application/json');

if (!isset($_GET['action'])) {
  echo json_encode(['Action not found']);
  exit;
}
