<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/AssignTasksTeam_style.css" type="text/css">
    <link rel="stylesheet" href="../style/nav_style.css" type="text/css">
    <script language="javascript" src="../resource/navigation.js"></script>
    <link rel="stylesheet" href="../style/notification_style.css?<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
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
                                    if (date("d") == 1) {
                                        $day = "st ";
                                    } elseif (date("d") == 2) {
                                        $day = "nd ";
                                    } elseif (date("d") == 3) {
                                        $day = "rd ";
                                    } else {
                                        $day = "th ";
                                    }

                                    echo "Today, " . date("d") . $day . date("M") . " " . date("Y") . "<br>";

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
        <img class="img-rounded-circle" src="../Asserts/<?php if ($_SESSION['user_img']) {
                                                            echo $_SESSION['user_img'];
                                                        } else {
                                                            echo 'avator.jpg';
                                                        } ?>" alt="">


    </header>

    <nav class="nav">
        <div class="nav-links">

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
            <a href="http://localhost/FINAL/Member/showpage_myProgressAccepted" class="nav-link" id="my_progress">
                <i class="fa fa-user fa-lg"><span>My Progress</span></i>
            </a>
            <a href="http://localhost/FINAL/Task/showpage_teamProgress" class="nav-link" id="t_progress">
                <i class="fa fa-users fa-lg"><span>Team Progress</span></i>
            </a>
            <a href="http://localhost/FINAL/HRmanager/showpage_employeeWorkProgress" class="nav-link " id="emp_progress">
                <i class="fa fa-users fa-lg"><span>Employee Progress</span></i>
            </a>
            <a href="http://localhost/FINAL/Task/showpage_deptManageTask" class="nav-link nav-link-active" id="manage_task_dpt">
                <i class="fa fa-tasks fa-lg"><span>Manage Tasks</span></i>
            </a>
            <a href="http://localhost/FINAL/Task/showpage_deptManageTask" class="nav-link" id="manage_task_leader">
                <i class="fa fa-tasks fa-lg"><span>Manage Tasks</span></i>
            </a>
            <a href="http://localhost/FINAL/HRmanager/showpage_manageEmployee" class="nav-link" id="manage_emp">
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

    <main>

        <div class="item1" id="item1">
            <a href="showpage_deptManageTask">
                <span>Add Task</span>
            </a>
            <a href="showpage_assignTasksTeam" class="activelink">
                <span>Team Progress</span>
            </a>
        </div>


        <div class="container" id="container">
            <form name="form1">
                <div class="item2">

                    <table id="mytable">

                        <col id="teamid">
                        <col id="teamname">
                        <col id="leader">
                        <col id="leadername">
                        <col id="add">

                        <thead>
                            <!--<tr>
                                    
                                    <th>Team ID</th>
                                    <th>Team Name</th>
                                    <th>Team Leader</th>
                                    <th>Add</th>
                                    
                                </tr >-->
                        </thead>
                        <tbody>
                            <!--<tr id="1">
                            <td class="row-data"></td>
                            <td class="row-data"></td>
                            <td class="row-data"></td>
                            
                            echo '<td><button type="button" class="add" onclick="show();"><i class="fa fa-plus-square fa-lg"></i></button></td>';
                        </tr>-->
                            <?php
                            $result = $this->users;
                            $res = $this->members;

                            $time = strtotime(date("Y-m-d"));
                            $month = date("F Y", $time);

                            foreach ($result as $row) {
                                echo '<tr class="team-name" id= ' . $row['0'] . '>';
                                echo '<td>' . $row['0'] . '</td>';
                                echo '<td>' . $row['1'] . '</td>';
                                echo '<td>' . $row['2'] . '</td>';
                                echo '<td>' . $row['3'] . '</td>';
                                echo '<td><a href="../Task/loadTeam/' . $row["0"] . '/' . $month . ' " class="add"><i class="fa fa-plus fa-lg"></i></a></td>';
                                echo '</tr>';

                                echo '<tr  >';
                                        echo '<td class="hname">Assigned Hours</td>';
                                        echo '<td class="hname">Progress Bar</td>';
                                        echo '<td class="hname">Emp-ID</td>';
                                        echo '<td class="hname">Emp-Name</td>';
                                        echo '<td class="hname"></td>';
                                echo '</tr>';

                                foreach ($res as $row2) {

                                    if ($row2['2'] == $row['0']) {

                                        echo '<tr id= ' . $row2['0'] . ' >';
                                        echo '<td class="subtd">' . $row2['3'] . ' h</td>';
                                        echo '<td class="subtd"><progress class="progress-bar" id="file" value=' . $row2['3'] . ' max="160"></progress></td>';
                                        echo '<td class="subtd">' . $row2['0'] . '</td>';
                                        echo '<td class="subtd">' . $row2['1'] . '</td>';
                                        echo '<td class="subtd"><a href="../Task/loadMembers/' . $row2["0"] . '/' . $row["0"] . ' " class="user"><i class="fa fa-user fa-lg"></i></a></td>';
                                        echo '</tr>';
                                    }
                                }
                            }

                            ?>

                        </tbody>

                    </table>

                </div>
            </form>
        </div>

    </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const nav = document.querySelector(".nav");
            const con = document.querySelector(".container");

            document.querySelector("#btnNav").addEventListener("click", () => {
                nav.classList.add("nav-open");
                con.classList.add("containerN");
            });

            document.querySelector(".nav-overlay").addEventListener("click", () => {
                nav.classList.remove("nav-open");
                con.classList.remove("containerN");
            });
        });
    </script>

    <script>
        function show() {


            var rowId = event.target.parentNode.parentNode.parentNode.id;
            alert(rowId);

            //this gives id of tr whose button was clicked
            var data = document.getElementById(rowId).querySelectorAll(".row-data");

            //returns array of all elements with "row-data" class within the row with given id

            var name = data[0].innerHTML;
            var title = data[1].innerHTML;

            //alert(name);

        }
    </script>


</body>

</html>