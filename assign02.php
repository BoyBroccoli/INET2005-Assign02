<!--  form layout -->

<form action="assign02.php" method="post">
    <p>Enter House Number: <input type="number" name="house_num" /></p>

    <p>Enter property length: <input type="number" name="prop_length" /></p>

    <p>Enter property width: <input type="number" name="prop_width" /></p>

    <p>Choose type of grass: <input type="radio" name="grass_type"
    <?php if (isset($grass_type) && $grass_type =="fescue")?>
    value="fescue">fescue
    <input type="radio" name="grass_type"
    <?php if (isset($grass_type) && $grass_type =="bentgrass")?>
    value="bentgrass">bentgrass
    <input type="radio" name="grass_type"
    <?php if (isset($grass_type) && $grass_type =="campus")?>
    value="campus">campus

    <p>Enter the number of trees: <input type="number" name="num_of_trees" /></p>

    <p><input type="submit" name="landscape_form" value="submit"/></p>
</form>

<!-- Retriving the data -->
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $error_message = "";

        // validating houseNum
        if(empty($_POST['house_num']))
        {
            $error_message .= "<li>You forgot to enter house number!</li>";
        } 
        else
        {
            $house_num = $_POST['house_num'];
        }

        // validating propLength
        if(empty($_POST['prop_length']))
        {
            $error_message .= "<li>You forgot to enter property length!</li>";
        } 
        else 
        {
            $prop_length = $_POST['prop_length'];
        }

        // Validating propertyWidth
        if(empty($_POST['prop_width']))
        {
        }
        else
        {
            $prop_width = $_POST['prop_width'];
        }

        // Validating grassType
        if(empty($_POST['grass_type']))
        {
            $error_message .= "<li>You must choose a grass type!</li>";
        }
        else
        {
            $grass_type = $_POST['grass_type'];
        }

        if(empty($_POST['num_of_trees']))
        {
            $error_message .= "<li>You must enter a number of trees!</li>";

        }
        else
        {
            $num_of_trees = $_POST['num_of_trees'];

        }

        if(!empty($error_message))
        {
            echo "<p>There was an error with the form!:</p>\n";
            echo "<ul>" . $error_message . "</ul>\n";
        }
    }
?>

<!-- Displaying inputs -->
<?php
    echo "<h2> Input was:</h2>";
    echo $house_num;
    echo "<br>";
    echo $prop_length;
    echo "<br>";
    echo $prop_width;
    echo "<br>";
    echo $grass_type;
    echo "<br>";
    echo $num_of_trees;
    echo "<br>";
?>
