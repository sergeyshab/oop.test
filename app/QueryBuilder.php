<?php

namespace App;

use Aura\SqlQuery\QueryFactory;

use PDO;

class QueryBuilder {

    private $pdo;

    private $queryFactory;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=app;charset=utf8;","root", "");
        $this->queryFactory = new QueryFactory('mysql');
    }

    public function getOne($table, $id) {

        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);

        // prepare the statment
        $sth = $this->pdo->prepare($select->getStatement());

        // bind the values and execute
        $sth->execute($select->getBindValues());

        // get the results back as an associative array
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result;

    }

    public function getAll($table) {

        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
         ->from($table);

        // prepare the statment
        $sth = $this->pdo->prepare($select->getStatement());

        // bind the values and execute
        $sth->execute($select->getBindValues());

        // get the results back as an associative array
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result;

    }

    public function insert($data, $table) {

        $insert = $this->queryFactory->newInsert();

        $insert
            ->into($table)
            ->cols($data);

        $sth = $this->pdo->prepare($insert->getStatement());

        $sth->execute($insert->getBindValues());

    }

    public function update($data, $id, $table) {

        $update = $this->queryFactory->newUpdate();

        $update
            ->table($table)
            ->cols($data)
            ->where('id = :id')
            ->bindValue('id', $id);


        // prepare the statement
        $sth = $this->pdo->prepare($update->getStatement());

        // execute with bound values
        $sth->execute($update->getBindValues());

    }

    public function delete($table, $id) {

        $delete = $this->queryFactory->newDelete();

        $delete
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);

         // prepare the statement
        $sth = $this->pdo->prepare($delete->getStatement());

         // execute with bound values
         $sth->execute($delete->getBindValues());

    }

}