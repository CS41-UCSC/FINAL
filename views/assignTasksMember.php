<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/assignTasksMember_style.css?<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="../style/calander_style.css?<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="../style/nav_style.css?<?php echo time(); ?>" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script language="javascript" src="../resource/navigation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />

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
        <div class="notification"><a href="#"><i class="fa fa-bell fa-lg"></i></a></div>
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
            <a href="http://localhost/Co-WMS/landingpage" class="nav-link" id="dashboard">
                <i class="fa fa-tachometer fa-lg"><span>Dashboard</span></i>
            </a>
            <a href="http://localhost/Co-WMS/landingpage" class="nav-link" id="d_dashboard">
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
            <a href="http://localhost/Co-WMS/employeeWorkProgress" class="nav-link " id="emp_progress">
                <i class="fa fa-users fa-lg"><span>Employee Progress</span></i>
            </a>
            <a href="http://localhost/Co-WMS/deptManageTask" class="nav-link nav-link-active" id="manage_task_dpt">
                <i class="fa fa-tasks fa-lg"><span>Manage Tasks</span></i>
            </a>
            <a href="http://localhost/FINAL/Task/showpage_deptManageTask" class="nav-link" id="manage_task_leader">
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
            <a href="http://localhost/Co-WMS/logout" class="nav-link" id="logout">
                <i class="fa fa-list-alt fa-lg"><span>Logout</span></i>
            </a>
        </div>

        <div class="nav-overlay"></div>
    </nav>
    <main class="page" id="page">


        <div class="item1" id="item1">
            <a href="../TASK/showpage_deptManageTask">
                <span>Add Task</span>
            </a>
            <a href="showpage_assignTasksMembers" class="activelink">
                <span>MemberProgress</span>
            </a>
            <a href="../TASK/showpage_assignTasksTeam">
                <span>Back</span>
            </a>
        </div>

        <div class="container" id="container">

            <div class="item2">

                <!--<div class="searching">
                    <select name="search" id="search" class="searchbar" placeholder="Searching">
                        <option value=""></option>;
                        <?php
                        $res = $this->members;

                        foreach ($res as $row) {
                            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                        } ?>

                    </select><br>
                    <input type="submit" id="submitid" name="submitid" class="submitidbtn" value="Go" onclick="submitID()">

                </div>-->

                <h3 id="memberName"><?php echo $_SESSION['memberID'] ?></h3>

            </div>

            <div class="popup" id="eventpopup">

                <div class="btn" id="btn">
                    <button type="button" class="buttonx" onclick="closeviewForm()">X</button>
                </div>


            </div>

            <div class="item3">

                <div class="calander" style="padding: 20px">
                    <div class="calanderbody">

                        <div class="calender-container" id="calender"></div>

                        <style>
                            .date {
                                font-size: 0.8em;
                                color: rgba(78, 78, 78, 0.548);
                            }

                            .currentMonthday {
                                color: #000;
                            }

                            .today {
                                color: #000;
                                background-color: rgba(114, 160, 230, 0.514);
                                border: 1px solid rgba(32, 50, 212);
                                ;
                            }
                        </style>
                    </div>
                </div>


                <script src="../resource/calender.js"></script>

                <script defer>
                    let calender = new Calender("calender", "eventpopup");

                    //calender.addleaverange("2021", "11", "25", "2021", "12", "2")
                    //calender.addallEvents(2021,12,20,"logo design", "zincat comapny");
                    //calender.init();
                </script>

                <?php

                $leaveset = $this->leave;

                foreach ($leaveset as $row) {
                    $sdate = $row[0];
                    $str_arr = explode("-", $sdate);
                    $edate = $row[1];
                    $end_arr = explode("-", $edate);
                    echo '<script type="text/javascript">calender.addleaverange(\'' . $str_arr[0] . '\',\'' . $str_arr[1] . '\',
                    \'' . $str_arr[2] . '\',\'' . $end_arr[0] . '\', \'' . $end_arr[1] . '\',\'' . $end_arr[2] . '\')</script>';
                }
                
                $result = $this->tasks;

                foreach ($result as $row) {
                    $string = $row[4];
                    $str_arr = explode("-", $string);
                    $taskname = $row[1];
                    $status = $row[5];
                    echo '<script type="text/javascript">calender.addallEvents(\'' . $str_arr[0] . '\',\'' . $str_arr[1] . '\',
                    \'' . $str_arr[2] . '\',\'' . $taskname . '\', \'' . $status . '\')</script>';
                }
                ?>

                <script defer>
                    calender.init();
                </script>

            </div>

            <div class="item4">

                <h3>Progress Chart vs Hours</h3>
                <div class="chart">
                    <canvas id="myChart"></canvas>
                </div>

                <?php

                $hours = $this->chart;

                $a = 0;
                $b = 0;
                $c = 0;
                $d = 0;

                for ($i = 0; $i < count($hours); $i++) {

                    if ($hours[$i][0] == "Approved")
                        $a = $hours[$i][1];
                    elseif ($hours[$i][0] == "Completed")
                        $b = $hours[$i][1];
                    elseif ($hours[$i][0] == "InProgress")
                        $c = $hours[$i][1];
                    elseif ($hours[$i][0] == "Pending")
                        $d = $hours[$i][1];
                }

                ?>

                <script>
                    var ip = '<?php echo $c; ?>';
                    var cp = '<?php echo $b; ?>';
                    var ap = '<?php echo $a; ?>';
                    var pe = '<?php echo $d; ?>';

                    var xValues = ["Assign Taks", "Completed Tasks", "Approved Tasks", "Pending Tasks"];
                    var yValues = [pe, cp, ap, pe];
                    var barColors = ["#407294", "#01786f", "#bd6c82", "#69a8a2"];

                    new Chart("myChart", {
                        type: "bar",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                            }]
                        },
                        options: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: ""
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }]
                            }
                        }

                    });
                </script>

            </div>

            <div class="item5">

                <h4>Assign tasks to Memebrs</h4>
                <form name="assigntask" class="data-form" method="POST">
                    <label for="">Task Name</label>
                    <select name="search" id="task" class="input-fields" placeholder="Searching">
                        <option value=""></option>;
                        <?php

                        $res = $this->teamTasks;

                        foreach ($res as $row) {
                            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                        }
                        ?>

                    </select><br>
                    <!--<input type="text" name="taskname" id="task" class="input-fields"><br>-->
                    <!--<label for="" hidden></label>-->
                    <textarea rows="5" cols="50" name="desc" id="desc" class="textarea-fields" placeholder="type a task description"></textarea>
                    <label for="">Due Date</label>
                    <input type="date" name="ddate" id="ddate" class="input-fields" min=""><br>
                    <label for="">Required Hours</label>
                    <input type=" text" name="rhours" id="rhours" class="input-fields"><br>


                    <div class="btn"><input type="submit" id="submit" name="submit" class="submit" onclick="addTask()"></div>
                </form>

            </div>

            <div class="item6">

                <h4>Assigned workload</h4>
                <div class="item6-content">
                    <table id="mytable">

                        <col id="taskname">
                        <col id="assignedtime">
                        <col id="retime">
                        <col id="duedate">
                        <col id="status">

                        <tbody>
                            <thead>
                                <tr>
                                    <th>Task Name</th>
                                    <th>Assigned Time</th>
                                    <th>Required Time</th>
                                    <th>Due Date</th>
                                    <th>Task Status</th>
                                </tr>
                            </thead>

                            <?php
                            $result = $this->tasks;
                            $i = 1;
                            foreach ($result as $row) {
                                echo '<tr id= ' . $row['0']  . '>';
                                echo '<td class="row-data" >' . $row['1'] . '</td>';
                                echo '<td class="row-data">' . $row['2'] . '</td>';
                                echo '<td class="row-data">' . $row['3'] . '</td>';
                                echo '<td class="row-data">' . $row['4'] . '</td>';
                                echo '<td class="row-data" id=' . $row['5'] . '>' . $row['5'] . '</td>';
                                echo '<td><button type="button" class="minus" onclick="deleteshow();"><i class="fa fa-minus-circle fa-lg"></i></button></td>';
                                echo '</tr>';
                            }

                            ?>

                        </tbody>

                    </table>
                </div>
            </div>

        </div>

    </main>

    <div class="popupdel" id="deleteForm">

        <form method="POST" class="form-popup" id="form-popup" name="deletedata">

            <h4> Do you want to delete?</h4>
            <h5 id="delname"></h5><br>
            <div class="btnd">
                <input type="text" id="delid" name="delid" value="" hidden>
                <input type="submit" value="Yes" class="yes" onclick="deleteTask()">
                <button type="button" class="no" value="" onclick="closedelete()">No</button>
            </div>

        </form>

    </div>



    <script>
        var del;

        document.getElementById("ddate").onclick = function() {

            today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;

            var input = document.getElementById("ddate");
            input.setAttribute("min", today);
        }

        function addTask() {

            var taskname = document.getElementById("task").value;
            var desc = document.getElementById("desc").value;
            var d_date = document.getElementById("ddate").value;
            var r_hours = document.getElementById("rhours").value;

            var data = new FormData();

            data.append("taskname", taskname);
            data.append("desc", desc);
            data.append("ddate", d_date);
            data.append("rhours", r_hours);

            var xhr = new XMLHttpRequest();

            xhr.open("POST", "AssignTasksforMember", true);

            xhr.onload = function() {

                let submit = JSON.parse(this.response);

                if (submit == true) {
                    alert("Succesfully added new task to Member");
                    //window.location.reload();
                    window.location.reload(false);
                } else {
                    alert("Failed! Try Aggain");
                    //window.location.reload();
                    window.location.reload(false);
                }
            }

            xhr.send(data);
            calender.init();
        }

        function deleteshow() {

            var rowId = event.target.parentNode.parentNode.parentNode.id;
            del = rowId;

            var data = document.getElementById(rowId).querySelectorAll(".row-data");

            document.getElementById("delname").innerHTML = data[0].innerHTML;

            document.getElementById("deleteForm").style.display = "block";
            document.getElementById("container").style.filter = "none";

        }

        function closedelete() {
            document.getElementById("deleteForm").style.display = "none";
            document.getElementById("container").style.filter = "none";

        }

        function deleteTask() {

            document.getElementById("delid").value = del;

            document.deletedata.action = "DeleteAssignTask";

        }

        function closeviewForm() {
            document.getElementById("eventpopup").style.display = "none";
        }
    </script>

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

</body>

</html>