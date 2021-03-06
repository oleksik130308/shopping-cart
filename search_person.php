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

    <div class="all">

        <h1 class="main">
            Search for a Person
        </h1>
        
        <div class="mainContent">

            <section class="card">
                <h2>Dropdown Search</h2>
                <div class="flex-container">
                    <?php
                        include("scripts/connectDB.php");

                        echo "<div class=\"flex-container\">";
                            $sql = "SELECT personID, addressID, firstName, surname, status FROM person";
                            $result = mysqli_query($conn, $sql);
                            
                            echo "<form action=\"search_person.php\" method=\"get\">";
                                echo "<select name=\"Person\">";
                                while($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=\"".$row["personID"]."\">
                                    Firstname: ".$row["firstName"]." Surname: ".$row["surname"].
                                    "</option>";
                                };
                                echo "</select>";
                                echo "<input type=\"submit\" value=\"Go\" name=\"Search\" />";
                            echo "</form>";
                        
                            if(isset($_GET['Search']))
                            {
                                $personID = $_GET['Person'];
                                $sql = "SELECT personID, address.addressID,  addressOne, addressTwo, 	town, postCode,	address.status
                                        FROM person, address 
                                        WHERE personID = $personID 
                                        AND person.addressID = address.addressID";
                                echo "<div>";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<p>".$row["addressID"]."</p>";
                                    echo "<p>".$row["addressTwo"]."</p>";
                                    echo "<p>".$row["town"]."</p>";
                                    echo "<p>".$row["postCode"]."</p>";
                                };
                                echo "</div>";
                            };
                        echo "</div>";
                    ?>
                </div>
            </section>

            <section class="card">
                <h2>Search by First Name</h2>
                <div class="flex-container">
                    <form action="search_person.php" method="get">
                        <input type="input" name="firstName" value="" placeholder="First Name" />
                        <input type="submit" value="Go" name="PersonNameSearch" />
                    </form>

                    <?php
                        if(isset($_GET["PersonNameSearch"]))
                        {
                            $firstName = $_GET['firstName'];
                            $prevPage = $_SERVER['HTTP_REFERER'];

                            $sql = "SELECT firstName, secondName, surname 
                                    FROM person
                                    WHERE firstName LIKE '%$firstName%'";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)) {
                                
                                echo "<p>".$row["firstName"]."</p>";
                                echo "<p>".$row["secondName"]."</p>";
                                echo "<p>".$row["surname"]."</p>";
                            };
                        }
                    ?>
                </div>
            </section>

            <section class="card">
                <h2>Search by Surname</h2>
                <div class="flex-container">
                    <form action="search_person.php" method="get">
                        <input type="input" name="surname" value="" placeholder="Surame" />
                        <input type="submit" value="Go" name="PersonDetailSearch" />
                    </form>

                    <table>
                        <tr>
                            <th>First Name</th><th>Second Name</th><th>Surname</th>
                            <th>Address One</th><th>Address Two</th><th>Town </th>
                            <th>Post Code</th>
                        </tr>
                    <?php
                        if(isset($_GET["PersonDetailSearch"]))
                        {
                            $surname = $_GET['surname'];
                            $prevPage = $_SERVER['HTTP_REFERER'];

                            $sql = "SELECT firstName, secondName, surname, houseNumName, addressTwo, addressThree, townCity, postCode  
                                    FROM person, address
                                    WHERE surname LIKE '%$surname%'
                                    AND address.addressId = person.addressID";
                            $result = mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>".$row["firstName"]."</td><td>".$row["secondName"]."</td><td>".$row["surname"]."</td><td>".$row["addressTwo"]."</td><td>".$row["town"]."</td>
                                        <td>".$row["postCode"]."</td>
                                    </tr>";
                            };
                        }
                    ?>
                    </table>
                </div>
            </section>

        </div>
    </div>
    <?php
        include("includes/footer.php");
    ?>
   
    </body>
</html>
