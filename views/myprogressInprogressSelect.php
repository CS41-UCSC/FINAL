<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/myprogressInprogressSelect_style.css">
    <link rel="stylesheet" href="../style/navbar_style.css">
    <script language="javascript" src="../resource/navigation.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'> -->
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
        <div class="notification"><a href="#" ><i class="fa fa-bell fa-lg "></i></a></div>
        <span class="user-login"><?php echo $_SESSION['login_user'] ?></span>
        <img class="img-rounded-circle" src="../Co-WMS/Asserts/<?php if ($_SESSION['user_img']) {
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
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressCompleted">Completed</a></li>
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressApproved">Approved</a></li>
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressAccepted" class="activelink">In Progress</a></li>
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
        <!-- <div class="container"> -->
            
            <div class="flex-container">
                <div class="content">
                        <!-- <div class="container"> -->
                            <div id="myProgress">
                                <div id="myBar"></div>
                            </div>
                            <br>  

                                <form id="progress" action="savesubtasks" method="POST">
                                    <!-- <label for="sub">Sub Task 1</label><input id="sub" type="checkbox" class="k" value="1" /><br>
                                    <label for="sub">Sub Task 2</label><input id="sub" type="checkbox" value="1" /><br>
                                    <label for="sub">Sub Task 3</label><input id="sub" type="checkbox" value="1" /><br>
                                    <label for="sub">Sub Task 4</label><input id="sub" type="checkbox" value="1" /><br> -->
                                    
                                    <?php
                                        $result = $this->users1;
                                        
                                        $i=0;
                                        foreach($result as $row){
                                            
                                            if(! (strcmp($row[2],"Completed"))){
                                                echo '<label for="sub">'.$row[1].'</label><input id="sub" type="checkbox" name="task[]" value="'.$row[0].' " checked/><br>';
                                            }else{
                                                echo '<label for="sub">'.$row[1].'</label><input id="sub" type="checkbox" name="task[]" value="'.$row[0].'" /><br>';
                                            }
                                            
                                            $i++;
                                        }
                                    ?>

                                    <div class="btns">
                                        <div class="buttonHold">
                                            <a href="http://localhost/FINAL/Member/showpage_myprogressAccepted" class="back" ><button class="button button1">Back</a>
                                        </div>
                                        <!--<button class="button button2">Save</button>-->
                                        <input class="button button2" type="submit" value="Submit" name="submit">
                                    </div> 
                                
                                    <!-- <button class="button button2">Remark</button> -->
                                    <!-- <button class="button" data-modal="modalOne">Back</button> -->
                                    <!-- <button class="button button3">Save</button> -->
                                    <!-- <div class="buttonHold">-->
                                    <!-- <input type="button" value="Back" onclick="update()" />
                                    <input type="button" value="Update" onclick="update()" /> -->
                                    
                                    <!--</div> -->
                                    <!--<button class="button button1" onclick="back()">Back</button>-->
                                    <!-- <button class="button button2">Save</button> -->

                                    
            
                                    
                                    
                                </form>
                                
                        <!-- </div> -->
    
               </div>
            </div>
            <div class="task_view">
                <div class="details">

                    <?php
                        $i=0;
                        $result = $this->users;

                        
                        foreach ($result as $row){


                            // if($row['TaskID']==$row1[1]){
                            //     echo "<br> - Task ID  : ". $row["TaskID"]. "<br> - Task Name  : ". $row["TaskName"]. "<br> - Assigned Time  : ". " " . $row["AssignedTime"] . "<br> - DueDate  : " . " " . $row["DueDate"] . "<br> - RequiredTime  : " .  " " .$row["RequiredTime"] . "<br>";
                                
                            // }
                            
                            if($i==0){
                                echo "<br> - Task ID  : ". $row["TaskID"]. "<br> - Task Name  : ". $row["TaskName"]. "<br> - Assigned Time  : ". " " . $row["AssignedTime"] . "<br> - DueDate  : " . " " . $row["DueDate"] . "<br> - RequiredTime  : " .  " " .$row["RequiredTime"] . "<br>";
                            }
                            $i=$i+1;
                            

                        }
                        
                        
                    
                    ?>

                </div>
            </div>
    </main>
                                                                    
                        
                

    <!-- <footer class="footer">
        <label for="" class="footer-data">©️ 2021, All rights reserved by CO - WMS <br>
                        No: 23, Flower Avenue, Colombo 7, Sri Lanka.</label>
    </footer> -->
        <script>
        function update() {
            var checked = 0;
            var myBar = document.getElementById("myBar");
            //Reference the Form.
            var fruits = document.getElementById("progress");

            //Reference all the CheckBoxes in Table.
            boxes = fruits.querySelectorAll("input[type='checkbox']:checked");
            checked = boxes.length


            myBar.style.width = ((checked / 2) * 100) + "%";
            if (checked == 0) {
                alert("Please select CheckBoxe(s).");
            }
            return true;
            }

            checks = document.querySelectorAll("input[type='checkbox']");
            checks.forEach(function(box) {
            box.addEventListener("change", function(e) {
                update()
            });
            });
    </script>

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

    <script>
        let modalBtns = [...document.querySelectorAll(".button")];
        modalBtns.forEach(function(btn) {
            btn.onclick = function() {
            let modal = btn.getAttribute('data-modal');
            document.getElementById(modal)
                .style.display = "block";
            }
        });
        let closeBtns = [...document.querySelectorAll(".close")];
        closeBtns.forEach(function(btn) {
            btn.onclick = function() {
            let modal = btn.closest('.modal');
            modal.style.display = "none";
            }
        });
        window.onclick = function(event) {
            if(event.target.className === "modal") {
            event.target.style.display = "none";
            }
        }
    </script>

    <script>
        function back(){
            window.location.href="http://localhost/FINAL/Member/showpage_myprogressAccepted" 
        }
    </script>
</body>
</html>
