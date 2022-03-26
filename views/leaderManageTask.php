<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/leaderManageTask.css?<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="../style/nav_style.css" type="text/css">
    <script language="javascript" src="../resource/navigation.js"></script>
    <link rel="stylesheet" href="../style/notification_style.css?<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <title>Document</title>
</head>

<body class="preload" onload='setbutton("<?php echo $_SESSION["memberaccess"] ?>","<?php echo $_SESSION["myprofile"] ?>","<?php echo $_SESSION["manageraccess"] ?>","<?php echo $_SESSION["leaderaccess"] ?>","<?php echo $_SESSION["hraccess"] ?>","<?php echo $_SESSION["adminaccess"] ?>")'>

    <?php

    $result = $this->task;

    if (!empty($_SESSION['addTask'])) {

        if ($_SESSION['addTask'] == "yes") {
            echo '<script>swal("Success!","New task created successfully", "success")</script>';
            $_SESSION['addTask'] = NULL;
        } else if ($_SESSION['addTask'] == "no") {
            echo '<script>swal("Failed!", "Try Again!" ,"error")</script>';
            $_SESSION['addTask'] = NULL;
        }
    }


    ?>

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

            <a href="http://localhost/Co-WMS/admin/adminHome" class="nav-link" id="manage_access">
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
            <a href="http://localhost/Co-WMS/myProgressAccepted" class="nav-link" id="my_progress">
                <i class="fa fa-user fa-lg"><span>My Progress</span></i>
            </a>
            <a href="http://localhost/FINAL/Task/showpage_teamProgress" class="nav-link" id="t_progress">
                <i class="fa fa-users fa-lg"><span>Team Progress</span></i>
            </a>
            <a href="http://localhost/Co-WMS/employeeWorkProgress" class="nav-link" id="emp_progress">
                <i class="fa fa-users fa-lg"><span>Employee Progress</span></i>
            </a>
            <a href="http://localhost/FINAL/Task/showpage_deptManageTask" class="nav-link nav-link-active" id="manage_task_dpt">
                <i class="fa fa-tasks fa-lg"><span>Manage Tasks</span></i>
            </a>
            <a href="http://localhost/Co-WMS/leaderManageTask" class="nav-link" id="manage_task_leader">
                <i class="fa fa-tasks fa-lg"><span>Manage Tasks</span></i>
            </a>
            <a href="http://localhost/Co-WMS/manageEmployee" class="nav-link" id="manage_emp">
                <i class="fa fa-pencil-square-o fa-lg"><span>Manage Employee</span></i>
            </a>
            <a href="http://localhost/Co-WMS/leave/myleaveApproved" class="nav-link" id="my_leave">
                <i class="fa fa-list-alt fa-lg"><span>My Leave</span></i>
            </a>
            <a href="http://localhost/Co-WMS/leave/teamLeave" class="nav-link" id="t_leave">
                <i class="fa fa-list-alt fa-lg"><span>Team Leave</span></i>
            </a>
            <a href="http://localhost/Co-WMS/leave/dptleaveApproved" class="nav-link" id="d_leave">
                <i class="fa fa-list-alt fa-lg"><span>Department Leave</span></i>
            </a>
            <a href="http://localhost/Co-WMS/leave/empLeave" class="nav-link" id="emp_leave">
                <i class="fa fa-list-alt fa-lg"><span>Employee Leave</span></i>
            </a>
            <a href="http://localhost/FINAL/login/logout" class="nav-link" id="logout">
                <i class="fa fa-list-alt fa-lg"><span>Logout</span></i>
            </a>
        </div>

        <div class="nav-overlay"></div>
    </nav>

    <main id="main">

        <div class="item1" id="item1">
            <a href="showpage_leaderManageTask" class="activelink">
                <span>Add Task</span>
            </a>
            <a href="showpage_leaderAssignTasksTeam" class="">
                <span>Task Progress</span>
            </a>
        </div>

        <div class="container" id="container">

            <div class="item2">

                <h3>Team - <span class="team-name-title"> <?php echo $result[0][1] ?> </span> </h3>
                <h3>Remaining Tasks </h3>
                <div class="searching">

                    <input type="text" id="search" name="search" class="searchbar" placeholder="Searching" onkeyup="search()">

                </div>

                <div class="result">


                    <table id="mytable">

                        <col id="tid">
                        <col id="teamid">
                        <col id="team">
                        <col id="task">
                        <col id="del">
                        <col id="edit">

                        <thead>
                            <tr>
                                <!--<th>Task ID</th>-->
                                <!--<th>Team ID</th>-->
                                <!--<th>Team Name</th>-->
                                <th>Task Title</th>
                                <th>More</th>
                                <th>Delete</th>
                                <th>Edit</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = 0;
                            foreach ($result as $row) {
                                echo '<tr id= ' . $i . '>';
                                echo '<td class="row-data" hidden>' . $row['3'] . '</td>';
                                echo '<td class="row-data" hidden>' . $row['0'] . '</td>';
                                echo '<td class="row-data" hidden>' . $row['1'] . '</td>';
                                echo '<td class="row-data" >' . $row['2'] . '</td>';
                                echo '<td><button type="button" class="view"  onclick="subtaskshow();"  ><i class="fa fa-list fa-lg"></i></button></td>';
                                echo '<td><button type="button" class="minus" onclick="deleteshow();"><i class="fa fa-minus-circle fa-lg"></i></button></td>';
                                echo '<td><button type="button" class="pen" onclick="editshow();"><i class="fa fa-pencil fa-lg"></i></button></td>';
                                echo '</tr>';

                                $i = $i + 1;
                            }

                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="item3">

                <h3>Add new task</h3>
                <form method="POST" class="data-form" id="data-form" name="addform">

                    <!--<label for="dep" >Team ID </label>-->
                    <!--<input type="text" name="tid" id="tid" value=""><br>-->
                    <select name="tid" id="tid" hidden>
                        <?php
                        $res = $this->deptteams;

                        foreach ($res as $row) {
                            echo '<option value=" ' . $row[0] . ' ">' . $row[1] . '</option>';
                        }

                        ?>
                    </select><br>
                    <label for="task">Task title</label>
                    <input type="text" name="tname" value=""><br>
                    <h4>Sub Tasks</h4>
                    <label for=""></label><input type="text" name="sub1" value=""><br>
                    <label for=""></label><input type="text" name="sub2" value=""><br>
                    <label for=""></label><input type="text" name="sub3" value=""><br>
                    <label for=""></label><input type="text" name="sub4" value=""><br>

                    <div class="btn"><input type="submit" value="Save Changes" class="button" onclick="addtask()"></div>

                </form>
            </div>

        </div>


    </main>

    <div class="popup" id="editForm">

        <form action="" method="POST" class="form-popup" id="form-popup" name="editform">

            <label for="Tname">Task ID</label>
            <input type="text" name="ttid" id="ttid" value="" readonly><br>
            <label for="Tname">Team ID</label>
            <input type="text" name="tteam" id="tteam" value="">
            <select name="team" id="stteam">
                <?php
                $i = 0;
                foreach ($res as $row) {
                    echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                    $i = $i + 1;
                } ?>

            </select><br>
            <label for="task">Task title</label>
            <input type="text" name="ttitle" id="ttitle" value=""><br>

            <div class="btn"><input type="submit" value="Save Changes" class="button" onclick="EditTask();">
                <button type="button" class="button" onclick="closeForm()">Close</button>
            </div>

        </form>

    </div>

    <div class="popup" id="deleteForm">

        <form method="POST" class="form-popup" id="form-popup" name="deletedata">

            <h4>Do you want to delete?</h4>
            <h4 id="title" style="color: darkblue; font-weight:normal;"></h4>
            <div class="btnd">
                <input type="text" id="delid" name="delid" value="" hidden>
                <input type="submit" value="Yes" class="yes" onclick="deleteTask()">
                <button type="button" class="no" value="" onclick="closedelete()">No</button>
            </div>

        </form>

    </div>

    <div class="popup" id="subtaskForm">

        <div class="form-popup">
            <div class="btnx">
                <button type="button" class="buttonx" onclick="closesubtaskview()">X</button>
            </div>
            <h4 id="taskname"></h4>
            <div class="subtasks" id="subtasks" style="color: darkblue; font-weight:normal;">

            </div>
        </div>

    </div>



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
        var del;

        function editshow() {

            var rowId = event.target.parentNode.parentNode.parentNode.id;

            //this gives id of tr whose button was clicked
            var data = document.getElementById(rowId).querySelectorAll(".row-data");

            /*returns array of all elements with 
            "row-data" class within the row with given id*/

            var tid = data[0].innerHTML;
            var name = data[1].innerHTML;
            var title = data[3].innerHTML;
            var select = document.getElementById("stteam");
            var input = document.getElementById("tteam");

            document.getElementById("ttid").value = tid;
            document.getElementById("tteam").value = name;
            document.getElementById("ttitle").value = title;
            select.onchange = function() {
                input.value = select.value;
            }

            document.getElementById("editForm").style.display = "block";
            document.getElementById("container").style.filter = "grayscale(100%)";


        }

        function deleteshow() {

            var rowId = event.target.parentNode.parentNode.parentNode.id;
            var data = document.getElementById(rowId).querySelectorAll(".row-data");
            del = data[0].innerHTML;

            document.getElementById("title").innerHTML = data[3].innerHTML
            document.getElementById("deleteForm").style.display = "block";
            document.getElementById("container").style.filter = "grayscale(100%)";


        }

        function closeForm() {
            document.getElementById("editForm").style.display = "none";
            document.getElementById("container").style.filter = "none";

        }

        function closedelete() {
            document.getElementById("deleteForm").style.display = "none";
            document.getElementById("container").style.filter = "none";

        }

        function addtask() {

            document.addform.action = "leaderAddTask";

        }

        function EditTask() {

            document.editform.action = "EditTask";

        }

        function deleteTask() {

            document.getElementById("delid").value = del;

            document.deletedata.action = "DeleteTask";

        }

        function subtaskshow() {

            var rowId = event.target.parentNode.parentNode.parentNode.id;
            var data = document.getElementById(rowId).querySelectorAll(".row-data");
            id = data[0].innerHTML;

            document.getElementById("taskname").innerHTML = data[3].innerHTML;

            var data = new FormData();

            data.append("taskid", id);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "showsubtaskview");

            xhr.onload = function() {

                let search = JSON.parse(this.response);

                let res = document.getElementById("subtasks");
                res.innerHTML = ""

                if (search !== null) {

                    for (let s of search) {
                        res.innerHTML += s.SubTaskName + "<br>"
                    }
                }else{
                    res.innerHTML = "No sub-tasks"
                }
            };

            xhr.send(data);

            document.getElementById("subtaskForm").style.display = "block";

            document.getElementById("container").style.filter = "grayscale(100%)";

        }

        function closesubtaskview() {

            document.getElementById("subtaskForm").style.display = "none";
            document.getElementById("container").style.filter = "none";

        }

        function search() {

            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("mytable");

            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {

                for (j = 0; j < 4; j++) {

                    td = tr[i].getElementsByTagName("td")[j];

                    if (td) {
                        txtValue = td.textContent || td.innerText;

                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }

            }
        }
    </script>

</body>

</html>