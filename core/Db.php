<?php

namespace app\core;


use PDO;

class Db
{
    protected $config;

    public function __construct(
        $driver,
        $host,
        $login,
        $password,
        $database,
        $charset = 'utf8'
    )
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }


    /**
     * @var $connection PDO
     */
    private $connection = null;

    private function getConnection()
    {
        if (is_null($this->connection)) {
            $this->connection = new PDO($this->prepareDSNString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    private function query($sql, $params)
    {
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);

        return $pdoStatement;
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    public function queryObject($sql, $params, $class)
    {
        $pdoStatement = $this->query($sql, $params);
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class);
        return $pdoStatement->fetch();
    }

    public function execute($sql, $params)
    {
        $this->query($sql, $params);
        return true;
    }

    private function prepareDSNString()
    {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    public function queryOne($sql, $params = [])
    {
        return $this->queryAll($sql, $params)[0];
    }

    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function __toString()
    {
        return "DB";
    }
}
