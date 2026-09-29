<?php

namespace Repository;

use DateTime;
use Entity\CreatedAtInterface;
use Entity\EntityInterface;
use InvalidArgumentException;
use PDO;

abstract class AbstractRepository
{

    protected PDO $pdo;

    protected string $table;

    /** @var array<class-string, AbstractRepository> une instance par classe de repository */
    private static array $instances = [];

    protected static int $nbInstances = 1;
    protected int $currentInstance = 0;

    protected function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=mariadb;dbname=db_fakeddit;port=3306",
            "root",
            "root"
        );

        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->currentInstance = AbstractRepository::$nbInstances;
        AbstractRepository::$nbInstances++;
    }

    public static function getInstance(): self
    {
        if (!isset(static::$instances[static::class])) {
            static::$instances[static::class] = new static();
        }
        return static::$instances[static::class];
    }

    public function findAll(): array
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

    public function findBy(array $param, array $orderBy = [], ?int $limit = null, ?int $offset = null): array
    {
        $bindValues = [];
        $sql = "SELECT * FROM $this->table";

        if (count($param) > 0) {
            $conditions = [];
            foreach ($param as $key => $value) {
                $this->assertValidColumn($key);
                $conditions[] = "$key = :value_$key";
                $bindValues['value_' . $key] = $value;
            }
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        if (count($orderBy) > 0) {
            $orders = [];
            foreach ($orderBy as $column => $direction) {
                $this->assertValidColumn($column);
                $direction = strtoupper($direction);
                if (!in_array($direction, ['ASC', 'DESC'], true)) {
                    throw new InvalidArgumentException("Direction de tri invalide : $direction");
                }
                $orders[] = "$column $direction";
            }
            $sql .= " ORDER BY " . implode(', ', $orders);
        }

        if ($offset !== null && $limit === null) {
            throw new InvalidArgumentException("Un offset nécessite une limite");
        }

        if ($limit !== null) {
            $sql .= " LIMIT :limit";
            $bindValues['limit'] = $limit;

            if ($offset !== null) {
                $sql .= " OFFSET :offset";
                $bindValues['offset'] = $offset;
            }
        }

        $sql .= ";";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($bindValues);
        $assocArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $objects = [];
        foreach ($assocArray as $row) {
            $objects[] = $this->createObjectByAssocArray($row);
        }

        return $objects;
    }

    public function findById(int $id): object | null
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id" => $id]);
        $assocArray = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$assocArray) {
            return null;
        }
        return $this->createObjectByAssocArray($assocArray);
    }

    public function update(object $object): object|null
    {
        if (!($object instanceof EntityInterface)) {
            var_dump("Je ne sais pas gérer cet objet !");
            return null;
        }

        $contents = $this->getAssocArrayByObject($object);

        $params = [];
        $strQuery = "UPDATE {$this->table} SET ";
        foreach ($contents as $key => $value) {
            $strQuery .= "{$key} = :{$key},";
            $params[":{$key}"] = $value;
        }
        $strQuery = rtrim($strQuery, ",");
        $strQuery .= " WHERE id = {$object->getId()}";

        $query = $this->pdo->prepare($strQuery);
        foreach ($params as $key => $value) {
            $query->bindValue($key, $value);
        }

        if (true === $query->execute()) {
            return $this->findById($object->getId());
        }

        return null;
    }

    public function create(object $object): object|null
    {
        if (!($object instanceof EntityInterface)) {
            var_dump("Je ne sais pas gérer cet objet !");
            return null;
        }

        if ($object->getId() !== null) {
            return $this->update($object);
        }

        $this->handleCreatedAt($object);
        $contents = $this->getAssocArrayByObject($object);

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
                return $this->findById($lastId);
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

    /**
     * Vérifie qu'un nom de colonne ne contient que des caractères autorisés (évite l'injection SQL)
     *
     * @param string $column
     * @return void
     */
    private function assertValidColumn(string $column): void
    {
        if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $column)) {
            throw new InvalidArgumentException("Nom de colonne invalide : $column");
        }
    }

    final protected function handleCreatedAt(object $object): void
    {
        if ($object instanceof CreatedAtInterface) {
            $object->setCreatedAt(new DateTime());
        }
    }

    /**
     * Return the instanced object from the array
     *
     * @param array $array
     * @return object
     */
    abstract protected function createObjectByAssocArray(array $array): object;

    /**
     * Return an array with database column name as key and their values from object
     *
     * @param object $object
     * @return array
     */
    abstract protected function getAssocArrayByObject(object $object): array;

}