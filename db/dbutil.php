<?php
	class DB {
		private $pdo = null;

		function connect() {
			if($this->pdo==null) {
				$config = parse_ini_file('dbconfig.ini');
				//@dsn host+dbname
				$dsn = "mysql:host=".$config['host'].";dbname=".$config['dbname'];
				$this->pdo = new PDO( $dsn, $config['username'], $config['password']);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		}

		function  close() {
			$this->pdo = null;
		}

		function fetch($query ,$bindParams) {
			try{
				$stmt = $this->pdo->prepare($query);
				$stmt->execute($bindParams);
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			catch(PDOException $e){
			}
		}

		function select($query ,$bindParams, $className) {
			try{
				$stmt = $this->pdo->prepare($query);
				$stmt->execute($bindParams);
				$result = $stmt->fetchAll(PDO::FETCH_CLASS,$className);
				return $result;
			}
			catch(PDOException $e){
			}
		}

		function tableUpdate($query, $bindParams) {
			try {
				$stmt = $this->pdo->prepare($query);
				if($stmt->execute($bindParams)){
					return $stmt->rowCount();
				}
				else{
					return -1;
				}
			} 
			catch(PDOException $e){
			}
		}

		function insert($query, $bindParams) {
			try {
				$stmt = $this->pdo->prepare($query);
				if($stmt->execute($bindParams)){
					return $this->pdo->lastInsertId();
				}
				else{
					return -1;
				}
			} 
			catch(PDOException $e){
			}
		}

	} 
?>