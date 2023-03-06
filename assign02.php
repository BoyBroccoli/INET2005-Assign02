<!--  form layout -->
<?php
    $house_num = $prop_length = $prop_width = $grass_type = $num_of_trees = $total_cost = "";
?>

<form action="assign02.php" method="post">
    <p>Enter House Number: <input type="number" min="0" name="house_num" /></p>

    <p>Enter property length (feet): <input type="number" min="0" name="prop_length" /></p>

    <p>Enter property width (feet): <input type="number" min="0" name="prop_width" /></p>

    <p>Choose type of grass: <input type="radio" name="grass_type"
    <?php if (isset($grass_type) && $grass_type =="fescue")?>
    value="fescue">fescue

    <input type="radio" name="grass_type"
    <?php if (isset($grass_type) && $grass_type =="bentgrass")?>
    value="bentgrass">bentgrass

    <input type="radio" name="grass_type"
    <?php if (isset($grass_type) && $grass_type =="campus")?>
    value="campus">campus

    <p>Enter the number of trees: <input type="number" min="0" name="num_of_trees" /></p>

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
            $error_message .= "<li>Error: You forgot to enter house number!</li>";
        } 
        elseif($_POST['house_num'] <= 0)
        {
            $error_message .= "<li> Error: House Number must be greater than 0!";
        }
        else
        {
            $house_num = test_input($_POST['house_num']);
        }

        // validating propLength
        if(empty($_POST['prop_length']))
        {
            $error_message .= "<li>Error: You forgot to enter property length!</li>";
        } 
        elseif($_POST['prop_length'] <= 0)
        {
            $error_message .= "<li> Error: Property Length must be greater than 0!";
        }
        else 
        {
            $prop_length = test_input($_POST['prop_length']);
        }

        // Validating propertyWidth
        if(empty($_POST['prop_width']))
        {
            $error_message .="<li>Error: You forgot to enter Property Width!</li>";
        }
        elseif($_POST['prop_width'] <= 0)
        {
            $error_message .= "<li> Error: Property Width must be greater than 0";
        }
        else
        {
            $prop_width = test_input($_POST['prop_width']);
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
        elseif($_POST['num_of_trees'] < 0)
        {
            $error_message .= "<li> Error: Number of trees must be 0 or greater!";
        }
        else
        {
            $num_of_trees = test_input($_POST['num_of_trees']);

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
    echo "Total cost for house " . $house_num . " is: " . calculate_price($prop_length,$prop_width,$grass_type, $num_of_trees);
    // echo "<br>";
    // echo $house_num;
    // echo "<br>";
    // echo $prop_length;
    // echo "<br>";
    // echo $prop_width;
    // echo "<br>";
    // echo $grass_type;
    // echo "<br>";
    // echo $num_of_trees;
    // echo "<br>";
?>

<!-- Validation Function -->
<?php
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }
?>

<!-- Calculate Price Function -->
<?php
    function calculate_price($prop_length, $prop_width,$grass_type, $num_of_trees)
    {
        $total_cost = 0;
        $grass_cost= 0;
        $base_labour = 1000;
        $tree_price = $num_of_trees * 100;
        $surface = $prop_length * $prop_width;
        if($surface > 5000)
        {
            $surface += 500;
        }

        if($grass_type == "fescue")
        {
            $grass_cost = .05;
        }
        elseif($grass_type == "bentgrass")
        {
            $grass_cost = .02;
        }
        else
        {
            $grass_cost = .01;
        }
        
        $total_cost =($surface * $grass_cost) + $tree_price + $base_labour;
        return "$" . number_format((float)$total_cost, 2, '.','');

    }
?>