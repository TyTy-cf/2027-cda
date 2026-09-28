<?php

abstract class AbstractRepository
{

    protected PDO $pdo;

    public function __construct(string $db, protected string $table)
    {
        $this->pdo = new PDO(
            "mysql:host=mariadb;dbname=".$db.";port=3306",
            "root",
            "root"
        );
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function fetchAll(): array
    {
        $sql = "SELECT * FROM $this->table;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $assocArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $objects = [];
        foreach ($assocArray as $row) {
            $objects[] = $this->createObjectByAssocArray($row);
        }

        return $objects;
    }

    public function fetchBy(array $param, int $offset, int $limit): array
    {
        $bindValues = [];
        $sql = "SELECT * FROM $this->table";
        $strLimit = " LIMIT :offset, :limit;";

        if (count($param) > 0) {
            $sql .= " WHERE ";
            foreach ($param as $key => $value) {
                $sql .= "$key = :value_$key AND ";
                $bindValues['value_'.$key] = $value;
            }
            $sql = rtrim($sql, " AND");
        }
        $sql .= $strLimit;

        $bindValues['offset'] = $offset;
        $bindValues['limit'] = $limit;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($bindValues);
        $assocArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $objects = [];
        foreach ($assocArray as $row) {
            $objects[] = $this->createObjectByAssocArray($row);
        }

        return $objects;
    }

    public function fetchById(int $id): object
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id" => $id]);
        $assocArray = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->createObjectByAssocArray($assocArray);
    }

    public function updateById(int $id, array $contents): object|null
    {
        $params = [];
        $strQuery = "UPDATE {$this->table} SET ";
        foreach ($contents as $key => $value) {
            $strQuery .= "{$key} = :{$key},";
            $params[":{$key}"] = $value;
        }
        $strQuery = rtrim($strQuery, ",");
        $strQuery .= " WHERE id = {$id}";

        $query = $this->pdo->prepare($strQuery);
        foreach ($params as $key => $value) {
            $query->bindValue($key, $value);
        }

        if (true === $query->execute()) {
            return $this->fetchById($id);
        }

        return null;
    }

    public function create(array $contents): object|null
    {
        $params = [];
        $strQuery = "INSERT INTO {$this->table} VALUES (null, ";
        foreach ($contents as $key => $value) {
            $strQuery .= ":{$key},";
            $params[":{$key}"] = $value;
        }
        $strQuery = rtrim($strQuery, ",");
        $strQuery .= ")";

        $query = $this->pdo->prepare($strQuery);
        foreach ($params as $key => $value) {
            $query->bindValue($key, $value);
        }

        if (true === $query->execute()) {
            $lastId = $this->pdo->lastInsertId();

            if ($lastId !== false) {
                return $this->fetchById($lastId);
            }

            return null;
        }

        return null;
    }

    public function deleteById(int $id): bool
    {
        $sql = "DELETE FROM $this->table WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(["id" => $id]);
    }

    abstract protected function createObjectByAssocArray(array $array): object;

}