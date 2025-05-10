<?php 
    include('config/constants.php');
?>

<html>
    <head>
        <title>Task Manager with PHP and MySQL</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"
        integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    </head>
    
    <body>
        
        <div class="wrapper">
    
        <center><h1>TASK MANAGER</h1></center>
        
        <a class="btn btn-info" href="<?php echo SITEURL; ?>">Home</a>
        </br>
        </br>
        <a class="btn btn-secondary" href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
        
</br>
</br>
        <h3>Add List Page</h3>
        
        <p>
        
        <?php 
        
            //Check whether the session is created or not
            if(isset($_SESSION['add_fail']))
            {
                //display session message
                echo $_SESSION['add_fail'];
                //Remove the message after displaying once
                unset($_SESSION['add_fail']);
            }
        
        ?>
        
        </p>
        
        <!-- Form to Add List Starts Here -->
        
        <form method="POST" action="">
            
            <table class="tbl-half">
                <tr>
                    <td>List Name: </td>
                    <td><input type="text" name="list_name" placeholder="Type list name here" required="required" /></td>
                </tr>
                <tr>
                    <td>List Description: </td>
                    <td><textarea name="list_description" placeholder="Type List Description Here"></textarea></td>
                </tr>
                
                <tr>
                    <td><input class="btn btn-success btn-lg" type="submit" name="submit" value="Save" /></td>
                </tr>
                
            </table>
            
        </form>
        
        <!-- Form to Add List Ends Here -->
        </div>
    </body>
</html>


<?php 

    //Check whether the form is submitted or not
    if(isset($_POST['submit']))
    {
        //echo "Form Submitted";
        
        //Get the values from form and save it in variables
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];
        
        //Connect Database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        //Check whether the database connected or not
        /*
        if($conn==true)
        {
            echo "Database Connected";
        }
        */
        
        //SElect Database
        $db_select = mysqli_select_db($conn, DB_NAME);
        
        //Check whether database is connected or not
        /*
        if($db_select==true)
        {
            echo "Database SElected";
        }
        */
        //SQL Query to Insert data into database
        $sql = "INSERT INTO tbl_lists SET 
            list_name = '$list_name',
            list_description = '$list_description'
        ";
        
        //Execute Query and Insert into Database
        $res = mysqli_query($conn, $sql);
        
        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Redirect to Manage List Page
            header('location:'.SITEURL.'manage-list.php');
            
            
        }
        else
        {
            //Failed to insert data
            //echo "Failed to Insert Data";
            
            //Create SEssion to save message
            $_SESSION['add_fail'] = "Failed to Add List";
            
            //REdirect to Same Page
            header('location:'.SITEURL.'add-list.php');
        }
        
    }

?>

































