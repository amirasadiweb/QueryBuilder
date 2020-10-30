<?php

require __DIR__. '\\..\\'."/vendor/autoload.php";
class QueryBuilder
{
    private $db;
    private $collection;
   // private static $instance;


//    public static function getInstance()
//    {
//        if (!isset(self::$instance)){
//            self::$instance = new self();
//        }
//
//        return self::$instance;
//
//    }
    
    
    public function __construct($dbname)
    {
        $this->db= new MongoDB\Client("mongodb://localhost:27017");
        $this->db=$this->db->$dbname;
        return $this->db;
    }

    public function selCollection($collection)
    {
        $this->collection=$this->db->$collection;
        return $this->collection;
    }

    public function show()
    {
        $result=$this->collection->find();
        foreach ($result as $value)
        {
            echo $value['name'].'<br/>';
        }

    }

    public function delete($id)
    {
        $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
    }

    public function insert($name,$company,$country,$email)
    {
        $this->collection->insertOne
        (
            [
                "name"=>$name,
                "company"=>$company,
                "country"=>$country,
                "email"=>$email
            ]

        );
    }

    public function update($id,$cloumn,$newValue)
    {
        $this->collection->updateOne(['_id' => new \MongoDB\BSON\ObjectID($id)],
            ['$set' => [$cloumn => $newValue]]);



    }


}