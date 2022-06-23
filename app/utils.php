<?php

function textField($fieldValue, $withSemicolon = true) {
  $value = "NULL";
  if (!empty($fieldValue)) {
    $value = '"'.$fieldValue.'"';
  }
  return $value . ($withSemicolon ? ';' : '');
}

function numField($fieldValue, $withSemicolon = true) {
  $value = "NULL";
  if (!empty($fieldValue)) {
    $value = $fieldValue;
  }
  return $value . ($withSemicolon ? ';' : '');
}

function nullField($withSemicolon = true) {
  return "NULL" . ($withSemicolon ? ';' : '');
}