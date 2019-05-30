<?php
namespace app\model;

require_once 'model.php';

use PDO;

/**
 * model result
 *
 * @author danishi
 */
class result extends model
{
    private $name   = 'result';

    public function __construct(){
        $dbms = 'sqlite';
        parent::__construct($dbms);
    }

    public function __toString():string {
        return $this->name;
    }

    /**
     * get all record set
     * @return array
     */
    public function getAll():array {
        $sql  = <<< EOF
SELECT *
FROM {$this->name}
EOF;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll();
        }catch(Exception $e){
            $this->logging($e->getMessage());
        }

        return $rs;
    }

    /**
     * insert record
     */
    public function insert(array $param) {
        $sql  = <<< EOF
INSERT INTO {$this->name}(
    name
)VALUES(
    :name
)
EOF;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':name', $param['name'], PDO::PARAM_STR);
            $stmt->execute();
        }catch(Exception $e){
            $this->logging($e->getMessage());
        }
    }
}
