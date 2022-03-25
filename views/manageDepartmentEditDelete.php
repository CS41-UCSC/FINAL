<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/manageDepartmentEditDelete_style.css">
    <link rel="stylesheet" href="../style/navbar_style.css">
    <script language="javascript" src="../resource/navigation.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script language="javascript" src="navigation.js"> -->
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
            <!--<a href="http://localhost/FINAL/Task/showpage_teamProgress" class="nav-link" id="d_progress">
                <i class="fa fa-tachometer fa-lg"><span>Department Progress</span></i>
            </a>-->
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
            <li><a href="http://localhost/FINAL/HRmanager/showpage_manageEmployee">Employees</a></li>
            <li><a href="http://localhost/FINAL/HRmanager/showpage_manageDepartment" class="activelink">Departments</a></li>
            <li><a href="http://localhost/FINAL/HRmanager/showpage_manageTeam">Teams</a></li>
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>
    
    <main>
        
            <div class="flex-container">
               
                    <div class="left">
                        <div class="form">
                            <h1>Edit Department</h1>
                            <form action=POST>
                               
                                    <label for="Name" class="name">Department Name :</label><br>
                                    <input type="box" class="input"><br>
                        
                                    <label for="ID" class="id">Department ID   : </label><br>
                                    <input type="box" class="input"><br>
                             
                                
                                    <label for="Managers" class="selection-box">Department Manager   : </label><br>
                                    
                                        <div class="select">
                                            <select name="format" id="format">
                                            <option selected disabled>Department Manager</option>
                                            <option value="manager 1">Perera A</option>
                                            <option value="manager 2">Perera B</option>
                                            <option value="manager 3">Perera C</option>
                                            <option value="manager 4">Perera D</option>
                                            <option value="manager 5">Perera E</option>
                                            </select>
                                        </div>
                                 
                               
                               
                                
                                  
                                  
            
                                
                            </form>
            
                        </div>
                        
            
                    </div>
                    <div class="right">
                        <div class="header_fixed" align="center">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Employee ID</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        
                                        <td><img src="../Asserts/image1.jpg"></td>
                                        <td>Karunaratne W.S.P.K</td>
                                        <td>AC-TM-001</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                              </label>
                                        

                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td><img src="../Asserts/image2.jpg"></td>
                                        <td>Madushani P.P.L</td>
                                        <td>AC-TM-005</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                              </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td><img src="../Asserts/image3.jfif"></td>
                                        <td>Praveena W.K</td>
                                        <td>AC-DM-001</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                              </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td><img src="../Asserts/image4.jpeg"></td>
                                        <td>Abewardane A.D</td>
                                        <td>AC-TL-004</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                              </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td><img src="../Asserts/image5.jpg"></td>
                                        <td>Kumarasinghe H.J.K</td>
                                        <td>AC-TL-004</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                              </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td><img src="../Asserts/image6.jfif"></td>
                                        <td>Fernando R</td>
                                        <td>AC-TM-010</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                              </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td><img src="../Asserts/image7.jfif"></td>
                                        <td>G.H.J.K de Silva</td>
                                        <td>AC-DM-007</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                              </label>
                                        </td>
                                    </tr>
                                    
                                    
                                    
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="btn-group">
                            <button class="button">Cancel</button>
                            <button class="button">Save</button>
                          </div>
                        
            
                    </div>
                
                
               
            </div>
             
    </main>

    <!-- <footer class="footer">
        <label for="" class="footer-data">©️ 2021, All rights reserved by CO - WMS <br>
                        No: 23, Flower Avenue, Colombo 7, Sri Lanka.</label>
    </footer> -->
    <script>
        document.addEventListener("DOMContentLoaded", () =>{
            const nav = document.querySelector(".nav");
            const con = document.querySelector(".flex-container");

            document.querySelector("#btnNav").addEventListener("click" , () =>{
                nav.classList.add("nav-open");
                con.classList.add("flex-containerN");
            });

            document.querySelector(".nav-overlay").addEventListener("click" , () =>{
                nav.classList.remove("nav-open");
                con.classList.remove("flex-containerN");
            });
        });
    </script>
</body>
</html>
