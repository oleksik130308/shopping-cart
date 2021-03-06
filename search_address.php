<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css" />
    <title>Document</title>
</head>
<body>
    <?php
   
    ?>
<?php
    include("scripts/connectDB.php");

    echo "<div class=\"flex-container\">";
    
    $sql = "SELECT addressID,postCode, status FROM address";
    $result = mysqli_query($conn, $sql);

    echo "<form action=\"search_address.php\" method=\"get\">";
        echo "<select name=\"AddressID\">";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<option value=\"".$row["addressID"]."\">
                Address: ".", ".$row["postCode"].
                "</option>";
        };
        echo "</select>";
        echo "<input type=\"submit\" value=\"Go\" name=\"AddressSearch\" />";
    echo "</form>";

    if(isset($_GET['AddressSearch']))
    {
        $addressID = $_GET['AddressID'];
        $sql = "SELECT personID, address.addressID, firstName, secondName, surname,
                FROM person, address
                WHERE address.addressID = $addressID 
                AND person.addressID = address.addressID";

        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            echo "<p>".$row["firstName"].", ";
            echo "".$row["secondName"]." ,";
            echo "".$row["surname"]."</p>";
        };
    };

    echo "</div>";
?>
<!-- --------------------------------------------------------------------------- -->
    <div class="flex-container">
    <form action="search_address.php" method="get">
        <input type="input" name="surname" value="" placeholder="Surame" />
        <input type="submit" value="Go" name="PersonDetailSearch" />
    </form>
    
    <table>
        <tr>
            <th>First Name</th><th>Second Name</th><th>Surname</th>
            <th>Address One</th><th>Address Two</th><th>Town</th>
            <th>Post Code</th>
        </tr>
    <?php
        if(isset($_GET["PersonDetailSearch"]))
        {
            $surname = $_GET['surname'];
            $prevPage = $_SERVER['HTTP_REFERER'];
    
            $sql = "SELECT firstName, secondName, surname,  addressOne, addressTwo, town, postCode  
                    FROM person, address
                    WHERE surname LIKE '%$surname%'
                    AND address.addressId = person.addressID";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>".$row["firstName"]."</td><td>".$row["secondName"]."</td><td>".$row["surname"]."</td><td>".$row["houseNumName"]."</td>
                        <td>".$row["addressOne"]."</td><td>".$row["addressTwo"]."</td><td>".$row["town"]."</td>
                        <td>".$row["postCode"]."</td>
                    </tr>";
            };
        }
    ?>
    </table>
    </div>
    </body>
</html>