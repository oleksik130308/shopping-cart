<?php
    include("connectDB.php");

    if($_GET['submit'] == "Insert Person")
    {
        $addressID = $_GET['address'];
        $firstName = $_GET['firstName'];
        $secondName = $_GET['secondName'];
        $surname = $_GET['surname'];
        $prevPage = $_SERVER['HTTP_REFERER'];

        $sql = "INSERT INTO person (addressID, firstName, secondName, surname)
            VALUES ($addressID, '$firstName', '$secondName', '$surname')";
        if(mysqli_query($conn, $sql))
        {
            header("Location: $prevPage?Message=Success");
        }
        else
        {
            header("Location: $prevPage?Message=Fail");
        }
    }
    elseif($_GET['submit'] == "Insert Address")
    {
        
        $addressTwo = $_GET['addressTwo'];
        $postCode = $_GET['postCode'];
        $prevPage = $_SERVER['HTTP_REFERER'];

        $sql = "INSERT INTO address ( addressTwo,town, postCode)
            VALUES ( '$addressTwo', '$postCode')";
        if(mysqli_query($conn, $sql))
        {
            header("Location: $prevPage?Message=Success");
        }
        else
        {
            header("Location: $prevPage?Message=Fail");
        }
    }
?>