<?php

class Connection {

    private $config;

    public function __construct() {
        $data = include 'includes/config.php';
        $this->config = $data['database'];
    }

    public function save($sql) {
        try {

           $pdo = new PDO("{$this->config['driver']}:host={$this->config['host']};dbname={$this->config['dbname']}","{$this->config['user']}","{$this->config['passwd']}");
           $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $stmt = $pdo->prepare($sql);
           $result = $stmt->execute();
      
      
        } catch (PDOException $e) {
           $result = $e;
        }  
        return $result;
      }
      
      public function prepare($twitters) {
      
        $i = 1;
        $sql = "insert into twitter.ranking (name,screen_name,followers_count) values";
        foreach ($twitters as $twitter) {
           $sql .= "(
      
                 '{$twitter['name']}',
                 '{$twitter['screen_name']}',
                 '{$twitter['followers_count']}'
           )";
           $sql .= ($i == count($twitters)) ? ";" : ",";
           $i++;  
        }
        return $sql;
      }
}
