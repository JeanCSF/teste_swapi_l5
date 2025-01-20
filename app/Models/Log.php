<?php

namespace app\Models;

use app\Config\Database;

class Log
{
    private $conn;
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function save(string $request)
    {
        $sql = "INSERT INTO logs (`datetime`, `request`) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);

        $this->conn->begin_transaction();
        $datetime = date("Y-m-d H:i:s");
        $stmt->bind_param(
            "ss",
            $datetime,
            $request
        );
        $stmt->execute();
        $this->conn->commit();

        $stmt->close();
    }

    public function update(array $data)
    {
        $this->conn->begin_transaction();
        foreach ($data as $rowData) {
            $ramal = $rowData['ramal'];

            $sql = "UPDATE info_ramais SET ";
            $updates = array();

            foreach ($rowData as $key => $value) {
                if ($value !== null && $key !== 'ramal') {
                    $updates[] = "$key = '$value'";
                }
            }

            if (!empty($updates)) {
                $sql .= implode(', ', $updates);
                $sql .= " WHERE ramal = ?";

                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("s", $ramal);
                $stmt->execute();
            }
        }
        $this->conn->commit();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM info_ramais";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->get_result();
    }
}
