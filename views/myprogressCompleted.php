<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/myprogressCompleted_style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/navbar_style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="http://localhost/FINAL/style/notification_style.css?<?php echo time(); ?>" type="text/css">
    <script language="javascript" src="../resource/navigation.js?<?php echo time(); ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>

<body class="preload" onload='setbutton("<?php echo $_SESSION["memberaccess"] ?>","<?php echo $_SESSION["myprofile"] ?>","<?php echo $_SESSION["manageraccess"] ?>","<?php echo $_SESSION["leaderaccess"] ?>","<?php echo $_SESSION["hraccess"] ?>","<?php echo $_SESSION["adminaccess"] ?>")'>
    <header class="header">
        <button class="header-button" id="btnNav" type="button">
            <i class="fa fa-bars fa-lg"></i>
        </button>
        <img src="../Asserts/logo.jpg" alt="" class="open-img">
        <label for="" class="date"> <?php 
                                        $day;
                                        if(date("d") == 1){
                                            $day = "st ";
                                        }elseif(date("d") == 2){
                                            $day = "nd ";
                                        }elseif(date("d") == 3){
                                            $day = "rd ";
                                        }else{
                                            $day = "th ";
                                        }

                                        echo "Today, " . date("d") . $day .date("M") . " " . date("Y") . "<br>"; 
                                        
                                    ?>
        </label>
        <div class="notification" >
		<button class="icon"><i class="fa fa-bell fa-lg" ></i>
                    <?php
                        $notificationsCount = $this->notificationCount['0']['0'];
                        if($notificationsCount == 0){
                            echo '';
                        }
                        else{
                            echo '<span class="badge">'.$notificationsCount.'</span>';
                        }
                    ?>
			</button>
			<div class="list" >
                <?php
                    $notifications = $this->notifications;
                    if(!empty($notifications)){
                        foreach($notifications as $row){
                            echo '<a href="http://localhost/FINAL/notification?ID='.$row['NotID'].' ">'.$row['Notification'].'</a>';
                        }
                    }
                ?>
			</div>
		</div>
        <span class="user-login"><?php echo $_SESSION['login_user'] ?></span>
        <img class="img-rounded-circle" src="../Asserts/<?php if ($_SESSION['user_img']) {echo $_SESSION['user_img'];} else {echo 'avator.jpg';} ?>" alt="">

    

    </header>
    <nav class="nav">
        <div class="nav-links">
            <!--<div class="nav-bar">
                <button class="nav-header-button" type="button">
                    <i class="fa fa-bars fa-lg"></i>
                </button>
                <img src="../Asserts/logo.jpg" alt="" class="close-img">
            </div>-->

            <a href="http://localhost/FINAL/admin/adminHome" class="nav-link" id="manage_access">
                <i class="fa fa-pencil-square-o fa-lg"><span>Manage Access</span></i>
            </a>
            <a href="http://localhost/FINAL/Systemuser/showpage_landingpage" class="nav-link" id="dashboard">
                <i class="fa fa-tachometer fa-lg"><span>Dashboard</span></i>
            </a>
            <a href="http://localhost/FINAL/Systemuser/showpage_landingpage" class="nav-link" id="d_dashboard">
                <i class="fa fa-tachometer fa-lg"><span>Dashboard</span></i>
            </a>
            <a href="http://localhost/FINAL/Task/showpage_teamProgress" class="nav-link" id="d_progress">
                <i class="fa fa-tachometer fa-lg"><span>Department Progress</span></i>
            </a>
            <a href="http://localhost/FINAL/Systemuser/showpage_myprofile" class="nav-link" id="my_profile">
                <i class="fa fa-user fa-lg"><span>My Profile</span></i>
            </a>
            <a href="http://localhost/FINAL/Member/showpage_myProgressAccepted" class="nav-link nav-link-active" id="my_progress">
                <i class="fa fa-user fa-lg"><span>My Progress</span></i>
            </a>
            <a href="http://localhost/FINAL/Task/showpage_teamProgress" class="nav-link" id="t_progress">
                <i class="fa fa-users fa-lg"><span>Team Progress</span></i>
            </a>
            <a href="http://localhost/FINAL/HRmanager/showpage_employeeWorkProgress" class="nav-link " id="emp_progress">
                <i class="fa fa-users fa-lg"><span>Employee Progress</span></i>
            </a>
            <a href="http://localhost/FINAL/Task/showpage_deptManageTask" class="nav-link " id="manage_task_dpt">
                <i class="fa fa-tasks fa-lg"><span>Manage Tasks</span></i>
            </a>
            <a href="http://localhost/FINAL/Task/showpage_deptManageTask" class="nav-link" id="manage_task_leader">
                <i class="fa fa-tasks fa-lg"><span>Manage Tasks</span></i>
            </a>
            <a href="http://localhost/FINAL/HRmanager/showpage_manageEmployee" class="nav-link " id="manage_emp">
                <i class="fa fa-pencil-square-o fa-lg"><span>Manage Employee</span></i>
            </a>
            <a href="http://localhost/FINAL/leave/myleaveApproved" class="nav-link" id="my_leave">
                <i class="fa fa-list-alt fa-lg"><span>My Leave</span></i>
            </a>
            <a href="http://localhost/FINAL/leave/teamLeave" class="nav-link" id="t_leave">
                <i class="fa fa-list-alt fa-lg"><span>Team Leave</span></i>
            </a>
            <a href="http://localhost/FINAL/leave/dptleaveApproved" class="nav-link" id="d_leave">
                <i class="fa fa-list-alt fa-lg"><span>Department Leave</span></i>
            </a>
            <a href="http://localhost/FINAL/leave/empLeave" class="nav-link" id="emp_leave">
                <i class="fa fa-list-alt fa-lg"><span>Employee Leave</span></i>
            </a>
            <a href="http://localhost/FINAL/login/logout" class="nav-link" id="logout">
                <i class="fa fa-list-alt fa-lg"><span>Logout</span></i>
            </a>
        </div> 
        <div class="nav-overlay"></div>   
    </nav>
                            
    <nav>
    <input id="nav-toggle" type="checkbox"> 
        <ul class="links">
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressCompleted" class="activelink">Completed</a></li>
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressApproved">Approved</a></li>
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressAccepted" >In Progress</a></li>
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressOverdue">Overdue</a></li>
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressPending">Pending</a></li>
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>
    
    <main>
        <div class="container">
            <div class="flex-container">
               <!-- <div class="text">Completed Tasks</div>  -->
                <!-- <div>1</div> -->
                    <div class="flex-container1">
                        <div class="text">Completed Tasks</div>
                        <?php
                            echo '<form action="http://localhost/FINAL/Member/sortDate" method="post">';
                            echo '<div>';
                                echo '<input type="date" id="myDate" name="startDate" value="'.$this->cur_date.'">';
                            echo '</div>';
                            echo '<div>';
                                echo '<input type="date" id="myDate" name="endDate" value="'.$this->cur_date.'">';
                            echo '</div>';
                            echo '<div>';
                                echo '<button type="submit" name="submit" class="rectan">Search</button>';
                            echo '</div>';
                            echo '</form>';
                        ?>
                    </div>
                <table class="table">
                    <thead>
                        <tr>
                        <th>Task Id</th>
                        <th>Sub Task Id</th>
                        <th>Task Name</th>
                        <th>Sub Task Name</th>
                        <th>Done On</th>
                        <th>Approved On</th>
                        <th>Covered Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td data-label="Task Id">1</td>
                            <td data-label="Task Name">Design the solution</td>
                            <td data-label="Done On">10/07/2021</td>
                            <td data-label="Approved On">13/07/2021</td>
                            <td data-label="Covered Hours">5 hrs</td>
                        </tr> -->
                        <?php
                        $result = $this->users;
                        // print_r($result);
                        foreach ($result as $row) {
                            echo '<tr>';
                            echo '<td>' . $row['TaskID'] . '</td>';
                            echo '<td>' . $row['SubTaskID'] . '</td>';
                            echo '<td>' . $row['TaskName'] . '</td>';
                            echo '<td>' . $row['SubTaskName'] . '</td>';
                            echo '<td>' . $row['CompletedDate'] . '</td>';
                            echo '<td>' . $row['ApprovedDate'] . '</td>';
                            echo '<td>' . $row['RequiredTime'] . '</td>';
                            echo '</tr>';
                        }

                        ?>
 
                    </tbody>
                </table>
    
            </div>
        </div>
    </main>

    <!-- <footer class="footer">
        <label for="" class="footer-data">© 2021, All rights reserved by CO - WMS <br>
                        No: 23, Flower Avenue, Colombo 7, Sri Lanka.</label>
    </footer> -->
    <script>
        document.addEventListener("DOMContentLoaded", () =>{
            const nav = document.querySelector(".nav");
            const con = document.querySelector(".container");

            document.querySelector("#btnNav").addEventListener("click" , () =>{
                nav.classList.add("nav-open");
                con.classList.add("containerN");
            });

            document.querySelector(".nav-overlay").addEventListener("click" , () =>{
                nav.classList.remove("nav-open");
                con.classList.remove("containerN");
            });
        });
    </script>
</body>
</html>