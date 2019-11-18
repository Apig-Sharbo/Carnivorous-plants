<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Database Control</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

<?php

$dbcon = mysqli_connect("localhost", "root", "", "test");

if (!$dbcon) {
    echo "<p>Connection to mysqli NOT successful</p>";
    exit();
}

$plantname = null;         /*db row names as variables*/
$scientificname = null;

$plantnameErr = "";       /*for errors*/
$scientificnameErr = "";

$sub_search = null;    /*for buttons*/
$sub_insert = null;
$sub_delete = null;
$sub_print = null;


if (isset($_POST['sub_search']))
    $sub_search = $_POST["sub_search"];

if (isset($_POST['sub_insert']))
    $sub_insert = $_POST["sub_insert"];

if (isset($_POST['sub_delete']))
    $sub_delete = $_POST["sub_delete"];

if (isset($_POST["sub_print"]))
    $sub_print = $_POST["sub_print"];

/*--------------------------------------------------------------------------search button start------------------------------------------------------------*/


if ($sub_search == "Search") {
    $q2 = 0;
    $ser_que = "Select * FROM coursetable WHERE ";
    $rq2 = "";

    if (!empty($_POST["plant_name_input"]) && !empty($_POST["scientific_name_input"])) {
        $q2 = 3;
        $plantname = $_POST["plant_name_input"];
        $scientificname = $_POST["scientific_name_input"];
    } else
        if (!empty($_POST["scientific_name_input"])) {
            $q2 = 2;
            $scientificname = $_POST["scientific_name_input"];
        } else
            if (!empty($_POST["plant_name_input"])) {
                $q2 = 1;
                $plantname = $_POST["plant_name_input"];
            }


    switch ($q2) {
        case 1:
        {
            $rq2 = $rq2 . "plant_name like'%$plantname%'";
            break;
        }
        case 2:
        {
            $rq2 = $rq2 . "sci_plant_name='$scientificname'";
            break;
        }
        case 3:
        {
            $rq2 = $rq2 . "plant_name='$plantname' AND sci_plant_name='$scientificname'";
            break;
        }

    }

}


/*--------------------------------------------------------------------------search button end------------------------------------------------------------*/


/*--------------------------------------------------------------------------insert button start------------------------------------------------------------*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && ($sub_insert == "Insert" || $sub_search == "Search" || $sub_delete == "Delete")) {
    if (empty($_POST["plant_name_input"]) && empty($_POST["scientific_name_input"]) && $sub_print != "Print All") {
        $plantnameErr = "*Plant name is required";
        $scientificnameErr = "*Scientific name is required";
    }

    if (empty($_POST["plant_name_input"]) && isset($_POST['sub_insert'])) {
        $plantnameErr = "*Plant name is required";
    } else {
        $plantname = test_input($_POST["plant_name_input"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $plantname)) {
            $plantnameErr = "*Only letters and white space allowed";
        }
    }

    if (empty($_POST["scientific_name_input"]) && isset($_POST['sub_insert'])) {
        $scientificnameErr = "*Scientific name is required";
    } else {
        $scientificname = test_input($_POST["scientific_name_input"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $scientificname)) {
            $scientificnameErr = "*Only letters and white space allowed";
        }
    }

}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($sub_insert == "Insert") {
    if (!empty($_POST["plant_name_input"]) && !empty($_POST["scientific_name_input"])) {
        $ins = "Insert into coursetable values('$plantname','$scientificname')";
        $res1 = mysqli_query($dbcon, $ins);
    }
}
/*--------------------------------------------------------------------------insert button end------------------------------------------------------------*/

/*--------------------------------------------------------------------------delete button start------------------------------------------------------------*/

if ($sub_delete == "Delete") {
    $q3 = 0;
    $del_que = "Delete FROM coursetable WHERE ";
    $rq3 = "";

    if (!empty($_POST["plant_name_input"]) && !empty($_POST["scientific_name_input"])) {
        $q3 = 3;
        $plantname = $_POST["plant_name_input"];
        $scientificname = $_POST["scientific_name_input"];
    } else
        if (!empty($_POST["scientific_name_input"])) {
            $q3 = 2;
            $scientificname = $_POST["scientific_name_input"];
        } else
            if (!empty($_POST["plant_name_input"])) {
                $q3 = 1;
                $plantname = $_POST["plant_name_input"];
            }


    switch ($q3) {
        case 1:
        {
            $rq3 = $rq3 . "plant_name='$plantname'";
            break;
        }
        case 2:
        {
            $rq3 = $rq3 . "sci_plant_name='$scientificname'";
            break;
        }
        case 3:
        {
            $rq3 = $rq3 . "plant_name='$plantname' AND sci_plant_name='$scientificname'";
            break;
        }

    }

    //echo $q2."<br>";
    $del_que = $del_que . $rq3;
    //echo $ser_que."<br>";

    $res3 = mysqli_query($dbcon, $del_que);

    /*if(mysqli_errno($dbcon)!=0)
        echo "Error dscription: ".mysqli_errno($dbcon);*/

}

/*--------------------------------------------------------------------------delete button end------------------------------------------------------------*/


?>
<a href="CoursePr.php">
    <div class="backbtn">&#x21E6 Go Back</div>
</a>
<br>
<br>

<form action="" method="POST">
    <table>

        <tr>
            <td>Plant name</td>
            <td><input type="text" style="width: 160px; font-family: sans-serif;" maxlength="20"
                       name="plant_name_input"/></td>
            <td><span class="error"><?php echo $plantnameErr; ?></span></td>
        </tr>

        <tr>
            <td>Scientific name</td>
            <td><input type="text" style="font-style: italic; width: 160px; font-family: serif;" maxlength="20"
                       name="scientific_name_input"/></td>
            <td><span class="error"><?php echo $scientificnameErr; ?></td>
        </tr>

    </table>

    <br>
    <input class="db_buttons" type=submit name="sub_search" value="Search"/>
    <input class="db_buttons" type=submit name="sub_insert" value="Insert"/>
    <input class="db_buttons" type=submit name="sub_delete" value="Delete"/>
    <input class="db_buttons" type=submit name="sub_print" value="Print All"/>

</form>
<?php /*include "Login_printbtn.php";*/ ?>
<!-- ----------------------------------------------------print button starting----------------------------------------------------------------------->
<?php
if ($sub_print == "Print All") {
    $print = "SELECT * FROM coursetable where 1";
    $res = mysqli_query($dbcon, $print);
    ?>
    <table class="class_print_table" style="margin-top: 50px; font-size: 25px;" cellspacing=0px;>
        <tr>
            <td style="color:chartreuse; padding:10px;">Plant name</td>
            <td style="color:chartreuse; padding:10px;">Scientific name</td>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            ?>
            <tr style="">
                <td style="border: 2px chartreuse solid; padding:10px;">
                    <?php print_r($row["plant_name"]); ?>
                </td>

                <td style="border:2px chartreuse solid; font-family: serif; font-style: italic; padding: 10px;">
                    <?php print_r($row["sci_plant_name"]); ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} ?>
<!-- ----------------------------------------------------print button end----------------------------------------------------------------------->

<!-- ----------------------------------------------------search button end----------------------------------------------------------------------->
<?php
if ($sub_search == "Search") {
    //echo $q2."<br>";
    $ser_que = $ser_que . $rq2;
    //echo $ser_que."<br>";

    $res2 = mysqli_query($dbcon, $ser_que);
    if (!empty($_POST["plant_name_input"]) || !empty($_POST["scientific_name_input"])) {
        ?>
        <table class="class_print_table" style="margin-top: 50px; font-size: 25px;" cellspacing=0px;>
            <tr>
                <td style="color:chartreuse; padding:10px;">Plant name</td>
                <td style="color:chartreuse; padding:10px;">Scientific name</td>
            </tr>
            <?php

            while ($row = mysqli_fetch_array($res2, MYSQLI_ASSOC)) {
                ?>
                <tr style="">
                    <td style="border: 2px chartreuse solid; padding:10px;">
                        <?php print_r($row["plant_name"]); ?>
                    </td>

                    <td style="border:2px chartreuse solid; font-family: serif; font-style: italic; padding: 10px;">
                        <?php print_r($row["sci_plant_name"]); ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
}
?>
<!-- ----------------------------------------------------search button end----------------------------------------------------------------------->
<?php mysqli_close($dbcon); ?>
</body>
</html>