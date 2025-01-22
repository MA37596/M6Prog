<?php

include_once("../source/config.php");
include_once("../source/database.php");


function GetQueryResultsAssoc($result)
{
    $results=[];
    if($result)
    {

        for ($i=0; $i< $result->num_rows; $i++)
        {
            $row = $result->fetch_assoc();

            array_push($results,$row);
        }
    }
    return $results;
}


function FindPersoon($conn,$naam)
{
    if($conn)
    {
        try
        {
            $q = "SELECT * FROM naw WHERE naam = ?";
            $stmt = $conn->prepare($q);
            $stmt->bind_param("s",$naam);
            $stmt->execute();
            $result = $stmt->get_result();


            $searchResults = GetQueryResultsAssoc($result);

            return $searchResults;
        }
        catch(Exception $ex)
        {
            echo "error during query" . $ex;
        }
    }
}



$conn = database_connect();
$searchInput = "leraar1";



$searchResults = FindPersoon($conn,$searchInput);
$conn->close();

echo json_encode($searchResults);




$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA);
$searchResults= FindPersoon($conn,$searchInput);
$conn->close();

header('Content-Type: application/json; charset=utf-8');

