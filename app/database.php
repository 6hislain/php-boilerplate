<?php
include_once('config.php');

function escape($value = '') // * escape quotes
{
  $connect = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $result = $connect->real_escape_string($value);
  $connect->close();
  return $result;
}

function dbQuery($sql = '', $show_id = false) // * execute query (insert, update, delete)
{
  $connect = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if ($connect->connect_error) die($connect->connect_error);
  if ($connect->query($sql) !== true) echo $connect->error . '<br>' . $sql;
  else {
    if ($show_id) {
      $last_id = $connect->insert_id;
      $connect->close();
      return $last_id;
    } else {
      $connect->close();
      return true;
    }
  }
  $connect->close();
}

function dbInsertMany($sql = '', $show_id = false) // * insert multiple rows
{
  $connect = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if ($connect->connect_error) die($connect->connect_error);
  if ($connect->multi_query($sql) !== true) echo $connect->error . '<br>' . $sql;
  else {
    if ($show_id) {
      $last_id = $connect->insert_id;
      $connect->close();
      return $last_id;
    } else {
      $connect->close();
      return true;
    }
  }
  $connect->close();
}

function dbSelect($sql = '') // * select (group, order, where, limit)
{
  $connect = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if ($connect->connect_error) die($connect->connect_error);
  $result = $connect->query($sql);
  if ($result->num_rows > 0) {
    $rows = [];
    while ($row = $result->fetch_assoc()) {
      array_push($rows, $row);
    }
    $connect->close();
    return $rows;
  } else {
    $connect->close();
    return [];
  }
  $connect->close();
}
