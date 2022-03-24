<?php
    function OpenConnection()
    {
        $json = file_get_contents("connection_data.json");
        $arr = json_decode($json, true);
        global $conn;
        $conn = mysqli_connect($arr["host"], $arr["username"], $arr["password"], $arr["db_name"], $arr["port"]) or die("DB Connection Error(" . mysqli_connect_error() . ")");
    }

    function CloseConnection()
    {
        global $conn;
        if (isset($conn)) {
           mysqli_close($conn);
        }
    }
    
    function PerformQuery($query){
        global $conn;
        return mysqli_query($conn, $query);
    }
?>