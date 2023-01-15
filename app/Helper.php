<?php
namespace App;

class Helper{
    private $container;
    
    function __construct($container)
    {
        $this->container = $container;        
    }
    
    public function __get($property)
    {
        if($this->container->{$property}){
            return $this->container->{$property};
        }    
    } 
	
	public function getTemplate(){

        $empresa = $this->select("SELECT * FROM tb_empresa WHERE id = 1 LIMIT 1")[0];
      
		return ["title"=>$empresa['nome'], "empresa"=>$empresa];        
	}

    private function setParams($statement, $parameters = array())
	{
		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}
	}

	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{

		$stmt = $this->db->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

	}

	public function select($rawQuery, $params = array())
	{

		$stmt = $this->db->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}
}