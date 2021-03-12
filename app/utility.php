<?php
session_start();
include_once('config.php');

function auth() // * grant user access
{
  if (!isset($_SESSION["user"])) header("location: ../index");
}

function guest() // * grant guest access
{
  if (isset($_SESSION["user"])) header("location: dashboard");
}

function admin() // * grant admin access
{
  auth();
  if ($_SESSION['user']['role'] === 'user') header('location: index');
}

function encrypt($message, $encode = false)
{
  $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
  $nonce = openssl_random_pseudo_bytes($nonceSize);

  $ciphertext = openssl_encrypt(
    $message,
    'aes-256-ctr',
    APP_KEY,
    OPENSSL_RAW_DATA,
    $nonce
  );

  if ($encode) {
    return base64_encode($nonce . $ciphertext);
  }
  return $nonce . $ciphertext;
}

function decrypt($message, $encoded = false)
{
  if ($encoded) {
    $message = base64_decode($message, true);
    if ($message === false) {
      throw new Exception('Encryption failure');
    }
  }

  $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
  $nonce = mb_substr($message, 0, $nonceSize, '8bit');
  $ciphertext = mb_substr($message, $nonceSize, null, '8bit');

  $plaintext = openssl_decrypt(
    $ciphertext,
    'aes-256-ctr',
    APP_KEY,
    OPENSSL_RAW_DATA,
    $nonce
  );

  return $plaintext;
}

function encode($value = '')
{
  return bin2hex(encrypt($value));
}

function decode($value = '')
{
  return decrypt(hex2bin($value));
}

function token() // * get CSRF token
{
  return encode(date('YMdH'));
}

function checkToken($value = '') // * check CSRF token
{
  return decrypt(hex2bin($value)) == date('YMdH');
}

function post($value = '') // * get $_POST value
{
  include_once('database.php');
  return escape(trim($_POST[$value]));
}

function isRequired($data = []) // * required form fields
{
  foreach ($data as $field) {
    if (empty(post($field))) array_push($_SESSION['message'], "$field is required");
  }
}

function isUnique($table = '', $data = []) // * unique database (row) values
{
  include_once('database.php');
  foreach ($data as $field) {
    $value = post($field);
    $sql = "SELECT * FROM $table WHERE $field='$value' LIMIT 1";
    if (count(dbSelect($sql))) array_push($_SESSION['message'], "$field already taken");
  }
}

function keepData($data = []) // * keep form field values into session
{
  $_SESSION['data'] = [];
  foreach ($data as $field) {
    $_SESSION['data'][$field] = post($field);
  }
}

function oldData($value = '') // * return kept data value
{
  return isset($_SESSION['data'][$value]) ? str_replace("\'", "'", $_SESSION['data'][$value]) : "";
}
