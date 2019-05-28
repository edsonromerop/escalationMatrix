<?php

class Conexion {

	static public function conectarMySQL(){

		$link = new PDO("mysql:host=localhost;dbname=basededatos",
						"user",
						"pass",
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		                      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
						);

		return $link;

	}

	static public function conectarSQL($database) {
		$dsn = "sqlsrv:Server=ipserver;Database=".$database."";
		$user = 'user';
		$pass = 'pass';
		$conn = new PDO($dsn, $user, $pass);
		$conn -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		return $conn;


	}

	static public function conectarSQLB($database) {

		$dsn = "sqlsrv:Server=192.168.20.13;Database=".$database."";
		$user = 'user';
		$pass = 'pass';
		$conn = new PDO($dsn, $user, $pass);
		$conn -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		return $conn;


	}



}