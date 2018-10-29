<?php

require 'db.php';

class func extends db
{
  public function blankect_query($table, $fields)
  {
    $query = $this->db->prepare('select ' . $fields . ' from ' . $table);
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }

  public function filtered_query($table, $fields, $condition)
  {
    $query = $this->db->prepare('select ' . $fields . ' from ' . $table . ' where ' . $condition);
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }

  public function val_user($user, $passwd)
  {
    $query = $this->db->prepare('select * from users where username=\'' . $user . '\'');
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $pass = base64_decode($res[0]['passwd']);
    if ($pass === $passwd) {
      return 1;
    } else {
      return 0;
    }
  }

  public function query($sql)
  {
    $query = $this->db->prepare($sql);
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }

  public function insert($sql)
  {
    $query = $this->db->prepare($sql);
    try {
      $res = $query->execute();
    } catch (PDOException $e) {
      $res = $e->getMessage();
    }
    return $res;
  }


  function get_extension($str)
  {
    return end(explode(".", $str));
  }
}
