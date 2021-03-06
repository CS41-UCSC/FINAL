<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/navbar_style.css">
    <link rel="stylesheet" href="../style/manageEmployeeAdd_style.css">
    <link rel="stylesheet" href="http://localhost/FINAL/style/notification_style.css?<?php echo time(); ?>" type="text/css">
    <script language="javascript" src="../resource/navigation.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>

<body class="preload" onload='setbutton("<?php echo $_SESSION["memberaccess"] ?>","<?php echo $_SESSION["myprofile"] ?>","<?php echo $_SESSION["manageraccess"] ?>","<?php echo $_SESSION["leaderaccess"] ?>","<?php echo $_SESSION["hraccess"] ?>","<?php echo $_SESSION["adminaccess"] ?>")'>

    <?php
    

    if (!empty($_SESSION['add-emp-msg'])) {
        if ($_SESSION['add-emp-msg'] == "New record created successfully") {
            echo '<script>swal("Success!", "New record created successfully and Email sent", "success")</script>';
            $_SESSION['add-emp-msg'] = null;
        } else if ($_SESSION['add-emp-msg'] == "Fialed to add New Employee password") {
            echo '<script>swal("Failed!", "Failed Passwords Verification","error")</script>';
            $_SESSION['add-emp-msg'] = null;
        } else if ($_SESSION['add-emp-msg'] == "Fialed to add New Employee") {
            echo '<script>swal("Failed!", "Fialed to add New Employee","error")</script>';
            $_SESSION['add-emp-msg'] = null;
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
            <a href="http://localhost/FINAL/Member/showpage_myProgressAccepted" class="nav-link " id="my_progress">
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
            <a href="http://localhost/FINAL/HRmanager/showpage_manageEmployee" class="nav-link nav-link-active" id="manage_emp">
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
            <li><a href="http://localhost/FINAL/HRmanager/showpage_manageEmployee" class="activelink">Employees</a></li>
            <li><a href="http://localhost/FINAL/HRmanager/showpage_manageDepartment">Departments</a></li>
            <li><a href="http://localhost/FINAL/HRmanager/showpage_manageTeam">Teams</a></li>
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>


    <main>

        <div class="container">

            <div class="flex-container1">
                <div>Add Employee</div>

            </div>
            <form method="POST" name="form1">
                <div class="flex-container">

                    <div>
                        <label for="epmId">Employee Id :</label><br>
                        <input type="text" id="epmId" name="epmId" placeholder="Employee Id" required><br>
                    </div>
                    <div>
                        <label for="Ename">Employee name :</label><br>
                        <input type="text" id="Ename" name="Ename" placeholder="Employee Name" required><br>
                    </div>
                    <div>
                        <label for="mail">Employee Email :</label><br>
                        <input type="email" id="email" name="email" placeholder="Email Address" required onkeyup="email_validation();"><br>
                    </div>

                    <div>
                        <label for="role" id="label-role">Employee Role :</label><br>
                        <select name="role" id="role">
                            <option value="Team_Leader">Team_Leader</option>
                            <option value="Team_Member">Team_Member</option>
                            <option value="Admin">Admin</option>
                            <option value="Dept_Manager">Dept_Manager</option>
                        </select><br>
                    </div>

                    <div>
                        <?php
                        $res = $this->depts;
                        ?>
                        <label for="Dname">Department Name :</label><br>
                        <select name="dept" id="role">
                            <option value=""></option>;
                            <?php
                            $i=0;
                            foreach ($res as $row) {
                                echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                                $i=$i+1;
                            } ?>

                        </select><br>
                    </div>

                    <div>
                        <?php
                        $res = $this->teams;
                        ?>
                        <label for="Tname">Team Name :</label><br>
                        <select name="team" id="role">
                            <option value=""></option>;
                            <?php
                            $i=0;
                            foreach ($res as $row) {
                                echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                                $i=$i+1;
                            } ?>

                        </select><br>
                    </div>

                    
                    <div>
                        <label for="password">Password :</label><br>
                        <input type="password" id="cpass" name="password" placeholder="Password" required onkeyup="validationc();"><br>
                    </div>
                    <div>
                        <label for="Cpassword">Confirm Password :</label><br>
                        <input type="password" id="npass" name="Cpassword" placeholder="Confirm Password" required onkeyup="validationn();"><br>
                    </div>

                    <!-- <div>
                        <label for="Estatus">Employee Status:</label><br>
                        <input type="radio" id="click" name="click" value="active"> Active
                        <input type="radio" id="click" name="click" value="inactive"> Inactive<br>
                    </div>-->
                    <div>
                        <a href="http://localhost/FINAL/HRmanager/showpage_manageEmployee" class="back" style="color: grey;"><span><i class="fa fa-arrow-left"></i>Back</span></a>
                    </div>
                    <div>
                        <input type="submit" value="Submit" class="rectan" onclick="saveform();">
                    </div>

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
        res1 = null;
        res2 = null;
        res3 = null;

        function email_validation() {

            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

            var input_email = document.getElementById("email").value;

            if (input_email.match(mailformat)) {
                document.getElementById("email").style.border = '2px solid green';
                res1 = "yes";
            } else {
                document.getElementById("email").style.border = '2px solid red';
                res1 = "no";
            }
        }

        function validationc() {

            var cpass = document.getElementById("cpass").value;

            var passw = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;

            if (passw.test(cpass)) {
                document.getElementById("cpass").style.border = '2px solid green';
                res2 = "yes";
            } else {
                document.getElementById("cpass").style.border = '2px solid red';
                res2 = "no";
            }


        }

        function validationn() {

            var npass = document.getElementById("npass").value;

            var passw = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;

            if (passw.test(npass)) {
                document.getElementById("npass").style.border = '2px solid green';
                res3 = "yes";
            } else {
                document.getElementById("npass").style.border = '2px solid red';
                res3 = "no";
            }
        }

        function saveform() {

            if (res1 == "yes" && res2 == "yes" && res3 == "yes") {

                document.form1.action = "setEmployeeData";

            } else if (res1 == "no" || res2 == "no" || res3 == "no") {

                swal("Failed!", "Try Again!", "warning");
                event.preventDefault();
            }

        }
    </script>

</body>

</html>