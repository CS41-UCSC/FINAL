<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/navbar_style.css?<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="../style/manageEmployee_style.css?<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="http://localhost/FINAL/style/notification_style.css?<?php echo time(); ?>" type="text/css">    
    <script language="javascript" src="../resource/navigation.js?<?php echo time(); ?>"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="sweetalert.min.js"></script>
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

    <nav class="subnav">
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
                <div class="text">All Employees</div>
                <div>

                    <input type="text" id="search" name="Ename" placeholder="Search Employee" onkeyup="search_employee();">

                </div>
                <div>
                    <form action="http://localhost/FINAL/HRmanager/showpage_manageEmployeeAdd">
                        <input type="submit" value="Add Employee" class="rectan">
                    </form>
                </div>
            </div>

            <div class="flex-container">
                <!-- <div class="text">All Employees</div>  -->

                <table class="table" id="mytable">

                    <thead>
                        <tr>
                            <th>Employee Id</th>
                            <th>Employee Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Terminate</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        $result = $this->users;
                        // print_r($result);
                        foreach ($result as $row) {
                            echo '<form action="http://localhost/FINAL/HRmanager/removeRestoreEmployee/'.$row['EmpID'].'/'.$row['EmpStatus'].'" onsubmit="return submitForm(this);" method="post">';
                            echo '<tr>';
                            echo '<td>' . $row['EmpID'] . '</td>';
                            echo '<td>' . $row['EmpName'] . '</td>';
                            echo '<td>' . $row['EmpEmail'] . '</td>';
                            echo '<td>' . $row['EmpRole'] . '</td>';
                            echo '<td>' . $row['EmpStatus'] . '</td>';
                            // echo '<td data-label="Edit"><a href="manageEmployeeEditDelete"><i class="fa fa-pencil fa-lg" style="color:grey;" aria-hidden="true"></i></a></td>';
                            echo '<td data-label="Edit"><a href="http://localhost/FINAL/HRmanager/showpage_manageEmployeeEditDelete?epmId='.$row['EmpID'].'"><i class="fa fa-pencil fa-lg" style="color:grey;" aria-hidden="true"></i></a></td>';
                            //echo '<td data-label="Terminate"><a href="#"><i class="fa fa-minus-circle fa-lg" style="color:grey;" aria-hidden="true"></i></a></td>';
                            
                            if($row['EmpStatus'] == 'Active'){
                                // echo '<td data-label="Terminate"><button type="submit" name="Active" onclick="deleteshow();"><i class="fa fa-minus-circle fa-lg" style="color:green;" aria-hidden="true"></i></button></td>';
                                // echo '<td data-label="Terminate"><button type="submit" name="Active"><i class="fa fa-minus-circle fa-lg" style="color:green;" aria-hidden="true"></i></button></td>';
                                echo '<td data-label="Terminate"><button  type="submit" name="Active"><i class="fa fa-minus-circle fa-lg" style="color:green;" aria-hidden="true"></i></button></td>';
                            }else{
                                // echo '<td data-label="Terminate"><button type="submit" name="Inactive"><i class="fa fa-window-restore fa-lg" style="color:grey;" aria-hidden="true"></i></button></td>';
                                // echo '<td data-label="Terminate"><button type="submit" name="Active"><i class="fa fa-minus-circle fa-lg" style="color:red;" aria-hidden="true"></i></button></td>';
                                echo '<td data-label="Terminate"><button type="submit" name="Active"><i class="fa fa-minus-circle fa-lg" style="color:red;" aria-hidden="true"></i></button></td>';

                            }
                            echo '</tr>';
                            echo '</form>';
                        }

                        ?>
                    </tbody>

                </table>

            </div>
        </div>
    </main>

    <!--<footer class="footer">
        <label for="" class="footer-data">© 2021, All rights reserved by CO - WMS <br>
            No: 23, Flower Avenue, Colombo 7, Sri Lanka.</label>
    </footer>-->

    <script>
        function submitForm(form){
            swal({
                title: "Are you sure ?",
                text: "This employee will be Terminate/Restore",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then(function (isOkay) {
                if (isOkay) {
                    form.submit();
                }
            });
            return false;
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

    <script>
        function search_employee() {

            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("mytable");

            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {

                td = tr[i].getElementsByTagName("td")[0];

                if (td) {
                    txtValue = td.textContent || td.innerText;
                    
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>

</html>