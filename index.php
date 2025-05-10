<?php 
    include('config/constants.php');
?>

<html>

    <head>
        <title>Task Manager with PHP and MySQL</title>
        <link rel="stylesheet" href="css/style.css" />
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
        <div class="p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
            <figure class="text-center">
                <blockquote class="blockquote">
                <p>Time is the scarcest resource, and unless it is managed, nothing else can be managed.</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                Peter Drucker
                </figcaption>
            </figure>
        </div>
</br>

    <!-- Menu Starts Here -->
    <div class="menu">
        <?php 
            
            //Comment Displaying Lists From Database in ourMenu
            $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
            
            //SELECT DATABASE
            $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
            
            //Query to Get the Lists from database
            $sql2 = "SELECT * FROM tbl_lists";
            
            //Execute Query
            $res2 = mysqli_query($conn2, $sql2);
            
            //CHeck whether the query executed or not
            if($res2==true)
            {
                //Display the lists in menu
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $list_id = $row2['list_id'];
                    $list_name = $row2['list_name'];
                    ?>
                    
                    <a class="btn btn-primary" style="color:white;" href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                    
                    <?php
                    
                }
            }
            
        ?>
        
        
        
        <a class="btn btn-secondary" style="position: absolute;left: 1500px; color:white" href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
    </div>
    <!-- Menu Ends Here -->
    
    <!-- Tasks Starts Here -->
    
    <p>
        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            
            
            if(isset($_SESSION['delete_fail']))
            {
                echo $_SESSION['delete_fail'];
                unset($_SESSION['delete_fail']);
            }
        
        ?>
    </p>
    
    <div class="all-tasks">
        
        <a class="btn btn-success" href="<?php SITEURL; ?>add-task.php">Add Task</a>
        
        <table class="tbl-full">
        
            <tr>
                <th></th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Actions</th>
                <th>Done</th>
            </tr>
            
            <?php 
            
                //Connect Database
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                
                //Select Database
                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                
                //Create SQL Query to Get DAta from Databse
                $sql = "SELECT * FROM tbl_tasks";
                
                //Execute Query
                $res = mysqli_query($conn, $sql);
                
                //CHeck whether the query execueted o rnot
                if($res==true)
                {
                    //DIsplay the Tasks from DAtabase
                    //Dount the Tasks on Database first
                    $count_rows = mysqli_num_rows($res);
                    
                    //Create Serial Number Variable
                    $sn=1;
                    
                    //Check whether there is task on database or not
                    if($count_rows>0)
                    {
                        //Data is in Database
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $task_id = $row['task_id'];
                            $task_name = $row['task_name'];
                            $priority = $row['priority'];
                            $deadline = $row['deadline'];
                            ?>
                            
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a class="btn btn-warning" href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update </a>
                                    <a class="btn btn-danger" href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Done</a>
                                </td>
                            </tr>
                            
                            <?php
                        }
                    }
                    else
                    {
                        //No data in Database
                        ?>
                        
                        <tr>
                            <td colspan="5">No Task Added Yet.</td>
                        </tr>
                        
                        <?php
                    }
                }
            
            ?>
            
            
        
        </table>
    
    </div>
    
    <!-- Tasks Ends Here -->
    </div>
    </body>

</html>