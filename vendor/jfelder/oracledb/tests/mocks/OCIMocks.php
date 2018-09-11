<?php

if (! class_exists('TestOCIStub')) {
    class TestOCIStub extends Jfelder\OracleDB\OCI_PDO\OCI
    {
        public function __construct($dsn = '', $username = null, $password = null, $driver_options = [], $charset = '')
        {
            $this->attributes = $driver_options + $this->attributes;
            $this->conn = 'oci8';
        }

        public function __destruct()
        {
        }
    }
}

if (! class_exists('TestOCIStatementStub')) {
    class TestOCIStatementStub extends Jfelder\OracleDB\OCI_PDO\OCIStatement
    {
        public function __construct($stmt, $conn, $sql, $options)
        {
            $this->stmt = $stmt;
            $this->conn = $conn;
            $this->sql = $sql;
            $this->attributes = $options;
        }

        public function __destruct()
        {
        }
    }
}

if (! class_exists('ProcessorTestOCIStub')) {
    class ProcessorTestOCIStub extends Jfelder\OracleDB\OCI_PDO\OCI
    {
        public function __construct()
        {
        }

        public function __destruct()
        {
        }

        public function prepare($statement, $driver_options = [], $autoIdColumn = null)
        {
        }
    }
}

if (! class_exists('ProcessorTestOCIStatementStub')) {
    class ProcessorTestOCIStatementStub extends Jfelder\OracleDB\OCI_PDO\OCIStatement
    {
        public function __construct()
        {
        }

        public function __destruct()
        {
        }

        public function bindValue($parameter, $value, $data_type = 'PDO::PARAM_STR')
        {
        }

        public function bindParam($parameter, &$variable, $data_type = 'PDO::PARAM_STR', $length = null, $driver_options = null)
        {
        }

        public function execute($input_parameters = null)
        {
        }
    }
}
