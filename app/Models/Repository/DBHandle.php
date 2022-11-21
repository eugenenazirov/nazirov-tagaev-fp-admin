<?php

namespace App\Models\Repository;

use PDO;
use PDOException;

class DBHandle
{
    protected function connect()
    {
        try {
            $username = "admin";
            $password = "kol3sa-upgrade-2022-admin$!";
            $dbh = new PDO('mysql:host=localhost;dbname=mailings', $username, $password);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
