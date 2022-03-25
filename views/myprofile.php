<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/myprofile_style.css" type="text/css">
    <link rel="stylesheet" href="../style/nav_style.css" type="text/css">
    <link rel="stylesheet" href="../style/notification_style.css?<?php echo time(); ?>" type="text/css">
    <script language="javascript" src="../resource/navigation.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <title>Document</title>
</head>

<body class="preload" onload='setbutton("<?php echo $_SESSION["memberaccess"] ?>","<?php echo $_SESSION["myprofile"] ?>","<?php echo $_SESSION["manageraccess"] ?>","<?php echo $_SESSION["leaderaccess"] ?>","<?php echo $_SESSION["hraccess"] ?>","<?php echo $_SESSION["adminaccess"] ?>")'>

    <?php

    $result = $this->users;

    if (!empty($_SESSION['photo'])) {
        if ($_SESSION['photo'] == "yes") {
            echo '<script>swal("Success!", "Photo added!", "success")</script>';
            $_SESSION['photo'] = null;
        } else if ($_SESSION['photo'] == "no") {
            echo '<script>swal("Failed!", "Try Again!","error")</script>';
            $_SESSION['photo'] = null;
        }
    }

    if (!empty($_SESSION['pass'])) {
        if ($_SESSION['pass'] == "yes") {
            echo '<script>swal("Success!", "Updated Password!", "success")</script>';
            $_SESSION['pass'] = null;
        } else if ($_SESSION['pass'] == "no") {
            echo '<script>swal("Failed!", "Try Again!","error")</script>';
            $_SESSION['pass'] = null;
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
        <!--<div class="notification">
            <button class="icon"><i class="fa fa-bell fa-lg"></i>
                <span class="badge">3</span>
            </button>
            <div class="list">
                <a href="#">HR-DM-001 has been Assigned as HR Manager</a>
                <a href="#">IT-TH-012 has been Terminated</a>
                <a href="#">Revoke all access from </a>
                <a href="#">10 Hours Pending to Complete</a>
            </div>
        </div>-->
        <span class="user-login"><?php echo $_SESSION['login_user'] ?></span>
        <img class="img-rounded-circle" src="../Asserts/<?php if ($result[0]['Userimg']) {
                                                                    echo $result[0]['Userimg'];
                                                                } else {
                                                                    echo 'avator.jpg';
                                                                } ?>" alt="">


    </header>

    <!-- <footer class="footer">
        <label for="" class="footer-data">© 2021, All rights reserved by CO - WMS <br>
                        No: 23, Flower Avenue, Colombo 7, Sri Lanka.</label>
    </footer> -->

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
            <a href="http://localhost/FINAL/Systemuser/showpage_myprofile" class="nav-link nav-link-active" id="my_profile">
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
            <a href="http://localhost/FINAL/Task/showpage_deptManageTask" class="nav-link" id="manage_task_dpt">
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

        <div class="container">

            <div class="item1">
                <form method="POST" enctype="multipart/form-data" name="form1">
                    <div class="img-card">

                        <img src="../Asserts/<?php if ($result[0]['Userimg']) {
                                                        echo $result[0]['Userimg'];
                                                    } else {
                                                        echo 'avator.jpg';
                                                    } ?>" alt="" id="photo">
                        <input type="file" id="file" name="image">
                        <div class="btn"><label for="file" id="uploadBtn">Choose photo</label></div>
                        <input type="submit" value="Save Changes" id="sbtbtn" onclick="checkfile();">

                    </div>
                </form>
            </div>
            <div class="item2">
                <form method="POST" class="data-form" name="form2">
                    <label for="empid">Employee ID</label>
                    <input type="text" name="empid" value="<?php echo $result[0]['EmpID'] ?>" readonly class="input-fields"><br>
                    <label for="empname">Name (with initials)</label>
                    <input type="text" name="empname" value="<?php echo $result[0]['EmpName'] ?>" readonly class="input-fields"><br>
                    <label for="empemail">Email</label>
                    <input type="text" name="empemail" value="<?php echo $result[0]['EmpEmail'] ?>" readonly class="input-fields"><br>
                    <label for="emprole">Employee Role</label>
                    <input type="text" name="emprole" value="<?php echo $result[0]['EmpRole'] ?>" readonly class="input-fields"><br>
                    <label for="emprole">Started Date</label>
                    <input type="text" name="startdate" value="<?php echo $result[1]['StartDate'] ?>" readonly class="input-fields"><br>
                    <h3>Reset Password</h3>
                    <label for="add">Current Password</label>
                    <input type="password" name="pass" id="pass" value="" class="input-fields"><br>
                    <label for="add">New Password</label>
                    <input type="password" name="cpass" id="cpass" value="" class="input-fields" onkeyup="validationc();"><br>
                    <label for="add">Confirm Password</label>
                    <input type="password" name="npass" id="npass" value="" class="input-fields" onkeyup="validationn();"><br>
                    <input type="submit" value="Save Changes" class="button" onclick="saveform();">
                </form>
            </div>
            
            <div class="item3">
                <h4>Skills and Endoresments</h4><br>
                                        
                  

                <div class="containerx">
                    <!-- <div class="hello"> -->
                        <button class="button" data-modal="modalOne"><i class="fa fa-plus" aria-hidden="true"  aria-hidden="true"></i>Add Skills   </button>
                    <!-- </div> -->
                    

                    <table class="table">
                    <thead>
                      
                    </thead>
                        <tbody>
                    
                            <?php
                                // $r = $result[0]['EmpID'];
                                
                                
                                $i=0;
                                $result = $this->users_skill;

                                
                                foreach ($result as $row){
                                    echo '<tr>';
                                        echo '<td>'. $row['skill_name'] . '</td>';
                                        // echo " ************** ";
                                        echo '<td>' . $row['percent'] . '</td>';
                                        // echo '<td data-label="Edit"><a href="manageTeamEditDelete/viewDropDownMembers?tId='.$row['TeamID'].'"><i class="fa fa-pencil fa-lg" style="color:grey;" aria-hidden="true"></i></a></td>';
                                    echo '</tr>';
                                }
                                
                                
                            
                            ?>
                        </tbody>
                    </table>
         
                    
                    
                </div>
                

                

            </div>
            
            <div id="modalOne" class="modal">
        

                    <div>
                        <form action="http://localhost/FINAL/Systemuser/setSkillData" method="post">
                        <a class="close">&times;</a>
                        <label for="skillname">Add Your skill here....</label>
                        <input type="skilltext" id="skillname" name="skillname" placeholder="Enter Your Skill Here..." required><br><br>
                        
                        
                        <div class="skills">

                            <label for="percent" class="rate" >Skill Percentage....</label><br>
                        
                            <div>
                        
                                <select name="percent" class="selection" id="percent">
                                    <option value="10%">10%</option>
                                    <option value="20%">20%</option>
                                    <option value="30%">30%</option>
                                    <option value="40%">40%</option>
                                    <option value="50%">50%</option>
                                    <option value="60%">60%</option>
                                    <option value="70%">70%</option>
                                    <option value="80%">80%</option>
                                    <option value="90%">90%</option>
                                    <option value="100%">100%</option>
                                </select><br>
                             </div>
                        </div>
                  

                       
                        
                    
                        <input type="submit" class="button2"value="Submit">
                        <!-- <input type="submit" value="Submit" class="rectan"> -->
                        </form>
                    </div>                              
            </div>
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
        res = null;
        path = null;

        const imgDiv = document.querySelector('.img-card');
        const img = document.querySelector('#photo');
        const file = document.querySelector('#file');
        const uploadBtn = document.querySelector('#uploadBtn');

        file.addEventListener('change', function() {
            const choosedFile = this.files[0];

            if (choosedFile) {

                path = "yes";
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    img.setAttribute('src', reader.result)
                });

                reader.readAsDataURL(choosedFile);
            }
        });

        function checkfile() {

            if (path == "yes")
                document.form1.action = "savephoto";

            else if (!path) {

                swal("Failed!", "Try Again!", "warning");
                event.preventDefault();
            }

        }

        function validationc() {

            var cpass = document.getElementById("cpass").value;

            var passw = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;

            if (passw.test(cpass)) {
                document.getElementById("cpass").style.border = '1px solid green';
                res = "green";
            } else {
                document.getElementById("cpass").style.border = '1px solid red';
                res = "red";
            }


        }

        function validationn() {

            var npass = document.getElementById("npass").value;

            var passw = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;

            if (passw.test(npass)) {
                document.getElementById("npass").style.border = '1px solid green';
                res = "green";
            } else {
                document.getElementById("npass").style.border = '1px solid red';
                res = "red";
            }
        }


        function saveform() {

            if (res == "green")
                document.form2.action = "saveform";

            else if (!res) {

                swal("Failed!", "Try Again!", "warning");
                event.preventDefault();
            }

        }
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

</body>

</html>
