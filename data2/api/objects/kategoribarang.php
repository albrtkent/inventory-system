<?php
class Kategoribarang
{

    // database connection and table name
    private $conn;
    private $table_name = "kategoribarang";

    // object properties
    public $id;
    public $kodebarang;
    public $namabarang;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // read products
    function read()
    {

        // select all query
        // $query = "SELECT
        //         c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
        //     FROM
        //         " . $this->table_name . " p
        //         LEFT JOIN
        //             categories c
        //                 ON p.category_id = c.id
        //     ORDER BY
        //         p.created DESC";
        $query = "SELECT * from " . $this->table_name;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // used when filling up the update product form
    function readOne()
    {

        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE id= ? limit 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->kodebarang = $row['kodebarang'];
        $this->namabarang = $row['namabarang'];
    }
}
