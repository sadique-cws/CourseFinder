<?php 
$connect = mysqli_connect("localhost","root","","course_finder") or die("failed");


function insert($table, $array){
    $col = implode(",",array_keys($array));
    $rows= implode("','",array_values($array));
    global $connect;
    $query = mysqli_query($connect, "insert into $table ($col) value ('$rows')");

}

function calling($table){
    $array = [];
    global $connect;
    $query = mysqli_query($connect, "select * from $table");
    while($row = mysqli_fetch_array($query)){
        $array[]= $row;
    }
    return $array;

}

?>
