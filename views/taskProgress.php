<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/taskProgress_style.css?<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="../style/nav_style.css?<?php echo time(); ?>" type="text/css">
    <script language="javascript" src="../resource/navigation.js"></script>
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
            <a href="http://localhost/Co-WMS/myprofile" class="nav-link" id="my_profile">
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
            <a href="http://localhost/Co-WMS/logout" class="nav-link" id="logout">
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
                <span>Task Progress</span>
            </a>
            <a href="showpage_assignTasksTeam">
                <span>Back</span>
            </a>
        </div>

        <div class="container" id="container">

            <div class="item2">

                <input type="text" id="search" name="search" class="search" placeholder="Searching" onkeyup="search()">
                <input type="month" id="monthyear" onkeyup="searchbymonth()">

            </div>

            <div class="month">
                <label for="" id="monthname"><?php if(isset($_SESSION['monthname'])){echo $_SESSION['monthname'];} else {echo date('F');} ?></label>
            </div>

            <div class="item3">

                

                <div class="result" id="result" style="overflow-x:auto;">

                    <table id="mytable">

                        <col id="taskname">
                        <col id="asstime">
                        <col id="assto">
                        <col id="retime">
                        <col id="duedate">
                        <col id="status">
                        <col id="view">
                        <col id="edit">
                        <col id="remark">

                        <thead>
                            <tr>

                                <!--<th>Task ID</th>-->
                                <th>Task Name</th>
                                <th>Assigned Time</th>
                                <th>Assigned To</th>
                                <th>Required Time</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>View</th>
                                <th>Edit</th>
                                <th>Remarks</th>

                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            $result = $this->users;
                            $i = 1;

                            foreach ($result as $row) {

                                echo '<tr id= ' . $i++ . '>';
                                echo '<td class="row-data" hidden>' . $row['1'] . '</td>';
                                echo '<td class="row-data">' . $row['0'] . '</td>';
                                echo '<td class="row-data">' . $row['3'] . '</td>';
                                echo '<td class="row-data">' . $row['4'] . '</td>';
                                echo '<td class="row-data" style="display:none" >' . $row['5'] . '</td>';
                                echo '<td class="row-data">' . $row['6'] . '</td>';
                                echo '<td class="row-data">' . $row['7'] . '</td>';
                                echo '<td class="row-data" id=' . $row['8'] . ' >' . $row['8'] . '</td>';
                                echo '<td class="row-data" style="display:none" >' . $row['9'] . '</td>';
                                echo '<td class="row-data" style="display:none" >' . $row['10'] . '</td>';
                                echo '<td class="row-data" style="display:none" >' . $row['11'] . '</td>';
                                echo '<td class="row-data" style="display:none" >' . $row['12'] . '</td>';
                                echo '<td><button type="button" class="pen" id="viewbtn" onclick="viewshow();"><i class="fa fa-eye fa-lg"></i></button></td>';
                                echo '<td><button type="button" class="pen" id="editbtn" onclick="show();"><i class="fa fa-pencil fa-lg"></i></button></td>';
                                echo '<td><button type="button" class="pen" id="remarkbtn" onclick="viewRemarks();"><i class="fa fa-book fa-lg"></i></button></td>';
                                echo '</tr>';
                            }

                            ?>

                        </tbody>

                        <style>

                        </style>

                    </table>
                </div>

            </div>

        </div>

    </main>

    <!--edit data submit form -->

    <div class="popup" id="myForm">

        <form action="editAssignTask" method="POST" class="form-popup" id="form-popup">

            <input type="text" name="tid" id="task" value="" hidden><br>
            <input type="text" name="assignedmember" id="assignedmember" value="" hidden><br>
            <label for="task" id="lrtime">Required Time</label>
            <input type="text" name="rtime" id="rtime" value=""><br>
            <label for="task" id="lddate">Due Date</label>
            <input type="date" name="ddate" id="ddate" value="" min=""><br>
            <label for="" name="lstts">Status</label>
            <select name="stts" id="stts">

            </select>

            <div class="btn">
                <input type="submit" value="Save Changes" class="button">
                <button type="button" class="button" onclick="closeForm()">Close</button>
            </div>

        </form>

    </div>

    <!-- view click data with sub task progress .. -->

    <div class="viewdata" id="viewForm">

        <div class="data">

            <div class="btn">
                <button type="button" class="buttonx" onclick="closeviewForm()">X</button>
            </div>
            <h3 id="tname" style="color:#4169E1;font-weight:normal;text-align:center;"></h3>
            <h3 id="title" style="color:#191970;font-weight:normal;">Sub Task Progress</h3>
            <progress id="file" value="" max="100"></progress><br>
            <div id="subtasks">
                <h4 style="color:salmon;font-weight:normal;" id="topicp">Pending</h4>
                <div id="pending"></div>
                <h4 style="color:seagreen;font-weight:normal;" id="topicc">Completed</h4>
                <div id="completed"></div>
            </div>
            <div id="details"></div>

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
        function getsearch() {


        }
    </script>


    <script type="text/javascript">
        document.getElementById("ddate").onclick = function() {

            today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;

            var input = document.getElementById("ddate");
            input.setAttribute("min", today);
        }

        function viewshow() {

            var rowId = event.target.parentNode.parentNode.parentNode.id;
            var data = document.getElementById(rowId).querySelectorAll(".row-data");

            taskid = data[0].innerHTML;
            assignedmember = data[3].innerHTML;
            tname = data[1].innerHTML;

            document.getElementById("tname").innerHTML = tname;
            var data = new FormData();

            data.append("taskid", taskid);
            data.append("assignedmember", assignedmember);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "getSubTasks");

            xhr.onload = function() {

                let search = JSON.parse(this.response);

                let count = 0;
                let complete = 0;

                let progress = document.getElementById("file");

                let subtaskp = document.getElementById("pending");
                subtaskp.innerHTML = " ";

                let subtaskc = document.getElementById("completed");
                subtaskc.innerHTML = " ";

                if (search !== null) {

                    progress.style.display = "block";
                    document.getElementById("title").style.display = "block";
                    document.getElementById("topicc").style.display = "block";
                    document.getElementById("topicp").style.display = "block";

                    for (let s of search) {

                        if (s.Status == "Completed") {
                            complete++;
                            subtaskc.innerHTML += s.SubTaskName + "<br>";
                        } else if (s.Status == "Pending") {
                            subtaskp.innerHTML += s.SubTaskName + "<br>";
                        }

                        count++;

                    }

                    var res = (complete / count * 100);
                    progress.value = res;

                } else {

                    progress.style.display = "none";
                    document.getElementById("title").style.display = "none";
                    document.getElementById("topicc").style.display = "none";
                    document.getElementById("topicp").style.display = "none";

                }

                /* if (search !== null) {
                     for (let s of search) {

                         if (s.TaskID == rowId) {

                             //when status = 0 , after it when click anither view button, it also hide these tow fields. avoid it add these lines
                             progress.style.display = "block";
                             document.getElementById("title").style.display = "block";

                             var total = s.tasks;
                             var comp = s.completed;
                             var res = (comp / total * 100);
                             progress.value = res;
                             break;

                         } else {
                             progress.style.display = "none";
                             document.getElementById("title").style.display = "none";
                         }

                     }
                 }*/


            };

            xhr.send(data);

            var data = document.getElementById(rowId).querySelectorAll(".row-data");

            var acdate = data[8].innerHTML;
            var cdate = data[9].innerHTML;
            var apdate = data[10].innerHTML;
            var desc = data[11].innerHTML;

            document.getElementById("details").innerHTML = "";

            document.getElementById("details").innerHTML += '<br> Accepted Date <br>' + acdate + '<br>';
            document.getElementById("details").innerHTML += '<br> Completed Date<br>' + cdate + '<br>';
            document.getElementById("details").innerHTML += '<br> Approved Date<br>' + apdate + '<br>';
            document.getElementById("details").innerHTML += '<br> <h4 style="color:orange; font-weight:400;">Description </h4>' + desc + '<br>';
            document.getElementById("details").innerHTML += '<br>';

            document.getElementById("viewForm").style.display = "block";
            document.getElementById("container").style.filter = "grayscale(100%)";

        }

        //edit task function

        function show() {

            var rowId = event.target.parentNode.parentNode.parentNode.id;

            //this gives id of tr whose button was clicked
            var data = document.getElementById(rowId).querySelectorAll(".row-data");

            /*returns array of all elements with 
            "row-data" class within the row with given id*/

            var id = data[0].innerHTML;
            var assignedmember = data[3].innerHTML;
            var rtime = data[5].innerHTML;
            var ddate = data[6].innerHTML;
            var status = data[7].innerHTML;

            document.getElementById("task").value = id;
            document.getElementById("assignedmember").value = assignedmember;
            document.getElementById("rtime").value = rtime;
            document.getElementById("ddate").value = ddate;

            //attach click task sttaus to option tags, before that clear previous options

            select = document.getElementById('stts');
            var length = select.options.length;
            for (i = length - 1; i >= 0; i--) {
                select.options[i] = null;
            }

            var opt = document.createElement('option');
            opt.value = status;
            opt.innerHTML = status;

            select.appendChild(opt);

            //append approved and reassigne options

            var opt1 = document.createElement('option');
            opt1.value = "Approved";
            opt1.innerHTML = "Approved";
            select.appendChild(opt1);

            var opt2 = document.createElement('option');
            opt2.value = "ReAssigned";
            opt2.innerHTML = "ReAssigned";
            select.appendChild(opt2);

            document.getElementById("myForm").style.display = "block";
            document.getElementById("container").style.filter = "grayscale(100%)";

        }

        function viewRemarks() {

            var tid = event.target.parentNode.parentNode.parentNode.id;
            var data = document.getElementById(tid).querySelectorAll(".row-data");
            var name = data[1].innerHTML;

            window.location.href = "http://localhost/FINAL/Task/showpage_checkRemarks?TaskID=" + tid + "&Name=" + name;
        }

        function closeviewForm() {

            document.getElementById("viewForm").style.display = "none";
            document.getElementById("container").style.filter = "none";
            document.getElementById("file").value = 0;

        }

        function closeForm() {

            document.getElementById("myForm").style.display = "none";
            document.getElementById("container").style.filter = "none";

        }

        function searchbymonth() {

            var monthyear = document.getElementById("monthyear").value;
            window.location.href = "http://localhost/FINAL/Task/monthfilter?Date=" + monthyear;

        }

    </script>

</body>

</html>