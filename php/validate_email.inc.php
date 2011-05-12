<?php
/**
 * File: validate_email.inc.php
 * Description: Check if a email address is valid
 * Author: Christian Torres <chtorrez at gmail dot com>
 * Date: 2011-05-12
 * Timestamp: 1305222141
 *
 * @author Christian Torres <chtorrez at gmail dot com>
 * @category libraries
 * @package clov3r
 * @version 1.0
 */
function checkEmail($email) {
  if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/" , $email)) {
    list($username,$domain)=preg_split('/@/',$email);
    $checked = checkdnsrr($domain,'MX');
    return $checked;
  }
  return false;
}
