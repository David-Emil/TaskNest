<?php 
    include('config/constants.php');
    //Get the listid from URL
    
    $list_id_url = $_GET['list_id'];
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
        
        <h1>TASK MANAGER</h1>
        
        <!-- Menu Starts Here -->
        <div class="menu">
        
            <a class="btn btn-success" style="color:white;" href="<?php echo SITEURL; ?>">Home</a>
            
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
            
            
            
            <a class="btn btn-secondary" style="color:white;position: absolute;left: 1500px;" href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
        </div>
        <!-- Menu Ends Here -->
        
        
        <div class="all-task">
        
            <a class="btn btn-primary" href="<?php echo SITEURL; ?>add-task.php">Add Task</a>
            
            
            <table class="tbl-full">
            
                <tr>
                    <th></th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>
                
                <?php 
                
                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                    
                    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                    
                    //SQL QUERY to display tasks by list selected
                    $sql = "SELECT * FROM tbl_tasks WHERE list_id=$list_id_url";
                    
                    //Execute Query
                    $res = mysqli_query($conn, $sql);
                    
                    if($res==true)
                    {
                        //Display the tasks based on list
                        //Count the Rows
                        $count_rows = mysqli_num_rows($res);
                        
                        if($count_rows>0)
                        {
                            //We have tasks on this list
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $task_id = $row['task_id'];
                                $task_name = $row['task_name'];
                                $priority = $row['priority'];
                                $deadline = $row['deadline'];
                                ?>
                                
                                <tr>
                                    <td>1. </td>
                                    <td><?php echo $task_name; ?></td>
                                    <td><?php echo $priority; ?></td>
                                    <td><?php echo $deadline; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update </a>
                                    
                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                                    </td>
                                </tr>
                                
                                <?php
                            }
                        }
                        else
                        {
                            //NO Tasks on this list
                            ?>
                            
                            <tr>
                                <td colspan="5">No Tasks added on this list.</td>
                            </tr>
                            
                            <?php
                        }
                    }
                ?>
                
                
            
            </table>
        
        </div>
        
        </div>
    </body>
    
</html>































