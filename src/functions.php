<?php

namespace PhpLang {
function each(&$container) {
  if (!is_array($container) && !is_object($container)) {
    trigger_error("Variable passed to each() is not an array or object", E_USER_WARNING);
    return null;
  }
  $key = \key($container);
  if ($key === null) {
    return false;
  }
  $value = $container[$key];
  $ret = [
    1 => $value,
    'value' => $value,
    0 => $key,
    'key' => $key,
  ];
  next($container);
  return $ret;
}
} // namespace PhpLang

namespace {

if (!function_exists('each')) {
  function each(&$arr) {
    return \PhpLang\each($arr);
  }
}

} // empty namespace
