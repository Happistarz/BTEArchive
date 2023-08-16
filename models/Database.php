<?php
# CRUD Database

define(
  "TYPE_PROJET",
  array(
    0 => 'COMMUNE',
    1 => 'PROJET',
    2 => 'WARP'
  )
);

define(
  "ETAT",
  array(
    1 => "Démarrage",
    2 => "En cours",
    3 => "Avancé",
    4 => "Terminé",
  )
);

define('PROJET_TABLE', 'PROJET');


define('WARP_TABLE', "WARPS");
/**
 * Connexion class
 * 
 * @property PDO $db
 * @property string $host
 * @property string $username
 * @property string $password
 * @property string $dbname
 * 
 */
class Connexion
{
  private $host;
  private $username;
  private $password;
  private $dbname;
  private $db;

  public function __construct()
  {
    $this->host = 'localhost';
    $this->username = 'mat';
    $this->password = 'root';
    $this->dbname = 'btearchive';
    $this->connect();
  }
  /**
   * Connect to the database
   */
  private function connect()
  {
    try {
      $this->db = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }
  /**
   * Create a new record
   * 
   * @param string $table
   * @param array $data
   * @return int
   */
  public function create($table, $data)
  {
    $columns = implode(', ', array_keys($data));
    $values = implode(', ', array_fill(0, count($data), '?'));

    $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";

    try {
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array_values($data));
      return $this->db->lastInsertId();
    } catch (PDOException $e) {
      die("Create operation failed: " . $e->getMessage());
    }
  }

  /**
   * Read records
   * 
   * @param string $table
   * @param array $conditions
   * @param string $orderBy
   * @param int $limit
   * @return array
   */
  public function read($table, $conditions = "1=1", $orderBy = null, $limit = null)
  {
    $where = ' WHERE ' . $conditions;
    $params = [];


    $order = '';
    if ($orderBy) {
      $order = " ORDER BY {$orderBy}";
    }

    $lim = '';
    if ($limit) {
      $lim = " LIMIT {$limit}";
    }

    $sql = "SELECT * FROM {$table}{$where}{$order}{$lim}";

    echo $sql;
    try {
      $stmt = $this->db->prepare($sql);
      $stmt->execute($params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Read operation failed: " . $e->getMessage());
    }
  }
  /**
   * Update records
   * 
   * @param string $table
   * @param array $data
   * @param array $conditions
   * @return bool
   */
  public function update($table, $data, $conditions)
  {
    $set = [];
    $params = [];

    foreach ($data as $field => $value) {
      $set[] = "{$field} = ?";
      $params[] = $value;
    }

    $where = '';
    $conditionsArr = [];

    foreach ($conditions as $field => $value) {
      $conditionsArr[] = "{$field} = ?";
      $params[] = $value;
    }

    $setStr = implode(', ', $set);
    $whereStr = implode(' AND ', $conditionsArr);

    $sql = "UPDATE {$table} SET {$setStr} WHERE {$whereStr}";

    try {
      $stmt = $this->db->prepare($sql);
      return $stmt->execute($params);
    } catch (PDOException $e) {
      die("Update operation failed: " . $e->getMessage());
    }
  }
  /**
   * Delete records
   * 
   * @param string $table
   * @param array $conditions
   * @return bool
   */
  public function delete($table, $conditions)
  {
    $where = '';
    $params = [];

    foreach ($conditions as $field => $value) {
      $whereArr[] = "{$field} = ?";
      $params[] = $value;
    }

    $whereStr = implode(' AND ', $whereArr);

    $sql = "DELETE FROM {$table} WHERE {$whereStr}";

    try {
      $stmt = $this->db->prepare($sql);
      return $stmt->execute($params);
    } catch (PDOException $e) {
      die("Delete operation failed: " . $e->getMessage());
    }
  }

  /**
   * Count records
   * 
   * @param string $table
   * @param string $key
   * @param string $value
   * @return int
   */
  public function count($table, $key = 1, $value = 1)
  {
    $sql = "SELECT COUNT(*) FROM {$table} WHERE {$key} = {$value}";

    try {
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      return $stmt->fetchColumn();
    } catch (PDOException $e) {
      die("Count operation failed: " . $e->getMessage());
    }
  }

  public function close()
  {
    $this->db = null;
  }
}
?>