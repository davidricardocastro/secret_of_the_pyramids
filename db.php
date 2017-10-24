<?php

class db 
{
    // database connection information
    protected static $host = 'localhost';
    protected static $username = 'root';
    protected static $password = 'rootroot';
    protected static $database = 'secretpyramid';

    protected static $pdo = null;

    /**
     * return the pdo object for the connection
     *
     * if the connection has been made, it will just
     * return the object, if not, it will first connect
     * and then return it
     * @return pdo connection
     */
    public static function pdo()
        {
            if(static::$pdo === null)
            {

            // connect to the database
            try 
                {
                    // store the connection (PDO) into static::$pdo
                    static::$pdo = new PDO(
                    // 'mysql:dbname=database_name;host=locahost;charset=utf8'
                    'mysql:dbname='.static::$database.';host='.static::$host.';charset=utf8', 
                    static::$username,
                    static::$password
                    );

                    // set error reporting
                    static::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } 
            catch (PDOException $e) 
                {
                    // if something went wrong, just print out the error message            
                    echo 'Connection failed: ' . $e->getMessage();
                    }

            }

         return static::$pdo;   
        }

    /**
        *runs a SQL query and returns the statement
        *
        *@param $sql - SQL string
        *@param $substitutions - array of values to substitute for ?
        *@return PDOStatement object
        */ 
    public static function query($sql, $substitutions = [])
        {
            // get PDO connection object
            $pdo = static::pdo();

            // prepare a statement out of SQL
            $statement = $pdo->prepare($sql);

            // we run the query and keep the outcome (true or false)
            // we supply the substitutions for ?s
            $outcome = $statement->execute($substitutions);

            // if there was an error
            if($outcome === false)
                {
                    //print the error and exit
                    static::exitWithError();
                }
            
            // return the statement (pointing to the result)
            return $statement;

        }

        /**
         * a way of outputting erros
         */
    protected function exitWithError()
     {
        // print a <h1>
        echo '<h1>MySQL error:</h1>';
        
        // dump information about the error
        var_dump(static::pdo()->errorInfo());
        
        // end execution
        exit();
        }
}
