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
ORDER BY date DESC
LIMIT 10
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
    before,
    after,
    date
)VALUES(
    :before,
    :after,
    :date
)
EOF;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':before', $param['before'], PDO::PARAM_STR);
            $stmt->bindParam(':after', $param['after'], PDO::PARAM_STR);
            $stmt->bindParam(':date', $param['date'], PDO::PARAM_STR);
            $stmt->execute();
        }catch(Exception $e){
            $this->logging($e->getMessage());
        }
    }
}
