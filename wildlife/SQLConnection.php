<?php

	class SQLConnection{


		private $serverName = "localhost";
		private $userName = "root";
		private $password = "Bruteforce12";
		private $dB =  "wcv";

		//constructor
        function __construct() {

        }

        public function getServerName()
        {
            return $this->serverName;
        }

        public function setServerName($serverName)
        {
            $this->serverName = $serverName;
        }

        public function getUserName()
        {
            return $this->userName;
        }

        public function setUserName($userName)
        {
            $this->userName = $userName;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function getDB()
        {
            return $this->dB;
        }

        public function setDB($dB)
        {
            $this->dB = $dB;
        }

        public function checkConnection()
        {
            //Create connection
            $conn = new mysqli($this->getServerName(), $this->getUserName(), $this->getPassword(), $this->getDB());
            //Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                echo "Connected Successfully </br>";
            }
        }

        public function sendQuery($query)
        {
            $conn = new mysqli($this->getServerName(), $this->getUserName(), $this->getPassword(), $this->getDB());
            $conn->query($query);
        }

        public function getResult($query)
        {
            $conn = new mysqli($this->getServerName(), $this->getUserName(), $this->getPassword(), $this->getDB());
            $result = $conn->query($query);
            return $result;
        }
	}
?>
