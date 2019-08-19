<?php
/**
 * DB Class -
 *  author - Rshad
 *  Email - Rshad541@gmail.com
 */
 class DB
 {
   /**
    * @var PDO $_instance
    */
    private static $_instance = null;
    /**
     * @var PDO $_pdo
     */
    private $_pdo;
    /**
     * @var string $_query
     */
    private $_query;
    /**
     * @var boolean $_error
     */
    private $_error = false;
    /**
     * @var array $_result
     */
    private $_result =[];
    /**
     * @var int $_count
     */
    private $_count = 0;
    /**
     * @var int $_lastId
     */
     private $_lastId;
    /**
     * DB Constructor.
     */
    private function __construct()
    {
      try {
        $this->_pdo = new PDO("mysql:host=".Config::get('mysql/host').";dbname=".Config::get('mysql/db'),Config::get('mysql/user'),Config::get('mysql/pwd'));
      } catch (PDOException $e) {
        die($e->getMessage());
      }
    }
    /**
     * @return $_instance
     */
    public static function getInstance()
    {
      if(!isset(self::$_instance))
      {
        self::$_instance = new DB();
      }
      return self::$_instance;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return $this
     */
    public function query($sql,$params = [])
    {
      $this->_error = false;
      if($this->_query = $this->_pdo->prepare($sql))
      {
        if(count($params))
        {
          $x = 1;
          foreach($params as $param)
          {
            $this->_query->bindValue($x, $param);
            $x++;
          }
        }
        if($this->_query->execute())
        {
          $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
          $this->_count = $this->_query->rowCount();
          $this->_lastId = $this->_pdo->lastInsertId();
        }else{
          $this->_error = true;
        }
        return $this;
      }
    }
    /**
     * @param string $table
     * @param array $fields
     * @return boolean
     */
    public function insert($table, $fields)
    {
      $set = '';
      $values =[];
      foreach($fields as $field => $value)
      {
        $set .= $field . '=? ,';
        $values[] = $value;
      }
      $set = rtrim($set, ' ,');
      $sql ="INSERT INTO {$table} SET {$set}";
      if(!$this->query($sql,$values)->error())
      {
        return true;
      }
      return false;
    }
    /**
     * @param string $table
     * @param int $id
     * @param array $fields
     * @return boolean
     */
    public function update($table,$id, $fields)
    {
      $set = '';
      $values =[];
      foreach($fields as $field => $value)
      {
        $set .= $field . '=? ,';
        $values[] = $value;
      }
      $set = rtrim($set, ' ,');
      $sql ="UPDATE {$table} SET {$set} WHERE id={$id}";
      if(!$this->query($sql,$values)->error())
      {
        return true;
      }
      return false;
    }
    /**
     * @return array
     */
     public function result()
     {
       return $this->_result;
     }
     /**
      * @param string $table
      * @param int $id
      * @return boolean
      */
      public function delete($table, $id)
      {
        $sql = "DELETE FROM {$table} WHERE id={$id}";
        if(!$this->query($sql)->error())
        {
          return true;
        }
        return false;
      }
     /**
      * @return array
      */
    public function first()
    {
      return (!empty($this->_result[0])) ? $this->_result[0] : [];
    }
    /**
     * @return boolean
     */
    public function error()
    {
      return $this->_error;
    }

    /**
     * @return integer
     */
     public function count()
     {
       return $this->_count;
     }
     /**
      * @return integer
      */
      public function lastID()
      {
        return $this->_lastId;
      }
 
      /**
       * @param string $table
       * @param string|int $item
       * @return array
       */
      public function find($table, $item)
      {
        $field = (strlen($item) < 8) ? 'id' : 'username';
        $sql = "SELECT * FROM {$table} WHERE {$field} =?";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute([$item]);
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        return $data;
      }
      /**
       * @param string $table
       * @param string $field
       * @param string|int $value
       * @return array
       */
      public function getBy($table, $field, $value)
      {
        $sql = "SELECT * FROM {$table} WHERE {$field} = ? ";
        return $this->query($sql,[$value])->result();
      }

      public static function getAll($table)
      {
        $sql = "SELECT * FROM {$table}";
        return DB::getInstance()->query($sql)->result();
      }

 }
