<?php
   
include_once ("../source/database.php";)

function GetQueryResultsAssoc($result)
{
    $results=[];
    if($result)
    {

        for ($i=0; $i < $result->num_rows; $i++)
        {

            $row = $result->fetch_assoc();
            array_push($results,$row);
        }
    }
}