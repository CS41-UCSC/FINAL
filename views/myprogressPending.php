<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../Co-WMS/style/myprogressPending_style.css">
    <link rel="stylesheet" href="../Co-WMS/style/navbar_style.css"> -->
    <link rel="stylesheet" href="../style/myprogressPending_style.css?<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="../style/navbar_style.css?<?php echo time(); ?>" type="text/css">
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
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressCompleted">Completed</a></li>
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressApproved">Approved</a></li>
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressAccepted" >In Progress</a></li>
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressOverdue">Overdue</a></li>
            <li><a href="http://localhost/FINAL/Member/showpage_myprogressPending" class="activelink">Pending</a></li>
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

                <div class="flex-container1">
                    <div class="text">Pending Tasks</div>
                    
                </div>
                 
                <table class="table">
                    <thead>
                        <tr>
                        <th>Task Id</th>
                        <th>Task Name</th>
                        <th>Assigned On</th>
                        <th>Due On</th>
                        <th>Required Time</th>
                        <th>View</th>
                        <th>Accept</th>
                        <th>Remark</th>
                        <th>View Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <!-- <tr>
                            <td data-label="Task Id">3</td>
                            <td data-label="Task Name">Collect verify the all the customer details</td>
                            <td data-label="Assigned On">10/07/2021</td>
                            <td data-label="Due On">12/07/2021</td>
                            <td data-label="Required Time">5 hrs</td>
                            <td data-label="View">
                                <button class="button" data-modal="modalOne1"><i class="fa fa-eye fa-2x" style="color:gray;" aria-hidden="true"></i></button>
                            </td>
                            <td data-label="Accept"><a href="#"><i class="fa fa-check-circle-o fa-2x" style="color:gray;"  aria-hidden="true"></i></a></td>
                            <td data-label="Remark"><button class="button" data-modal="modalOne"><i class="fa fa-pencil-square-o fa-2x"  aria-hidden="true"></i></button></td>
                        </tr> -->
                        
                            <?php
                            $result = $this->users;
                            // print_r($result);
                            foreach ($result as $row) {
                                echo '<tr>';
                                echo '<td>' . $row['TaskID'] . '</td>';
                                echo '<td>' . $row['TaskName'] . '</td>';
                                echo '<td>' . $row['AssignedTime'] . '</td>';
                                echo '<td>' . $row['DueDate'] . '</td>';
                                echo '<td>' . $row['RequiredTime'] . '</td>';
                                echo '<td data-label="View"><button  class="button" data-modal="modalOne1'.$row['TaskID'].'"><i class="fa fa-eye fa-2x" style="color:gray;" aria-hidden="true"></i></button></td>';
                                echo '<form action="http://localhost/FINAL/Member/acceptTask/'.$row['TaskID'].'" onsubmit="return submitForm(this);"  method="post">';
                                    echo '<td data-label="Accept"><button type="submit"><i class="fa fa-check-circle-o fa-2x" style="color:gray;"  aria-hidden="true"></i></button></td>';
                                echo '</form>';
                                echo '<td data-label="Remark"><button class="button" data-modal="modalOne'.$row['TaskID'].'"><i class="fa fa-pencil-square-o fa-2x"  aria-hidden="true"></i></button></td>';
                                echo '<td data-label="View Remark"><button  class="button" data-modal="modalOne2'.$row['TaskID'].'"><i class="fa fa-commenting fa-2x" style="color:gray;" aria-hidden="true"></i></button></td>';
                                echo '</tr>';

                            }

                            ?>
                        

                    
                    </tbody>
                </table>
                <!-- vvnvnbnb -->
                <?php
                $result = $this->users;
                foreach ($result as $row) {
                echo '<div id="modalOne'.$row['TaskID'].'" class="modal">';
                    echo '<div class="modal-content">';
                        echo '<div class="contact-form">';
                            echo '<a class="close">&times;</a>';    
                            





                                //echo '<form action="myprogressPending/sendRemark/'.$row['TaskID'].'/'.$row['AssignedTo'].'" method="post">';
                                echo '<form action="http://localhost/FINAL/Member/sendRemark/'.$row['AssignedTo'].'" method="post">';
                                echo '<input type="hidden" value='.$row['TaskID'].' name="taskId">';
                                echo '<h3>Remark</h3>';
                                echo '<div class="message">'."Message".'</div>';
                                echo '<div>';
                                    echo '<input rows="8" name="remark" required></input>';
                                echo '</div>';
                                // if($row['TaskID'] == $i){
                                //     echo '<button type="submit">Send</button>';
                                //     break;
                                // }
                                echo '<button type="submit">Send</button>';
                                echo '</form>';
                                
                            
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                } ?>

                <!-- View Remark hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh-->

                <?php

                $result = $this->user2;
                // $res = false;
                foreach ($result as $row) {
                echo '<div id="modalOne2'.$row['TaskID'].'" class="modal">';
                    echo '<div class="modal-content1">';

                                echo '<a class="close">&times;</a>';
                                echo '<p> View Previous Remark <br>';
                                echo '</p>';

                                echo '<table class="table">';
                                echo '<thead>';
                                  echo '<tr>';
                                    echo '<th>Remark Id</th>';
                                    echo '<th>Employee Id</th>';
                                    echo '<th>Task ID</th>';
                                    echo '<th>Remark</th>';
                                    echo '<th>Added date</th>';
                                    echo '<th>Remark Status</th>';
                                    echo '<th>Accessed Date</th>';
                                    echo '<th>Accessed By</th>';
                                    
                                  echo '</tr>';
                                echo '</thead>';

                                echo '<tbody>';

                                foreach ($result as $row1) {
                                    if($row['TaskID']==$row1['TaskID'] && $_SESSION['login_user']==$row['EmpID']){
                                        // $res = true;
                                        echo '<tr>';
                                        echo '<td>' . $row1['RemarkID'] . '</td>';
                                        echo '<td>' . $row1['EmpID'] . '</td>';
                                        echo '<td>' . $row1['TaskID'] . '</td>';
                                        echo '<td>' . $row1['Remark'] . '</td>';
                                        echo '<td>' . $row1['AddedDate'] . '</td>';
                                        echo '<td>' . $row1['RStatus'] . '</td>';
                                        echo '<td>' . $row1['AccessedDate'] . '</td>';
                                        echo '<td>' . $row1['AccessedBy'] . '</td>';   
                                        echo '</tr>';
                                    }
                                    
                                }
                                // if(!$res){
                                //     echo "No Remarks";
                                // }

                                echo '</tbody>';
                                echo '</table>';


                    
                                // echo '<a class="close">&times;</a>';
                                // echo '<p> View Previous Remark <br>';
                                // echo '</p>';
                                
                   
                        
                     echo '</div>';
                echo '</div>';
               }
                ?>
                

                <!-- View Remark hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh-->

                <?php
                $result = $this->users;
                foreach ($result as $row) {
                echo '<div id="modalOne1'.$row['TaskID'].'" class="modal">';
                    echo '<div class="modal-content1">';
                    
                                echo '<a class="close">&times;</a>';
                                echo '<p>Task Id :' . $row['TaskID'].'<br>';
                                echo $row['TaskName'].'<br>';
                                echo 'Assigned on :'. $row['AssignedTime'] .'<br>';
                                echo 'Due On :'. $row['DueDate'] .'<br>';
                                echo 'Required Time :'. $row['RequiredTime'] .'<br><br>';
                                // if($row['TaskID'] == $i){
                                //     break;
                                // }
                
                
                    
                            $result1 = $this->users1;
                            //$i = 0;
                            echo 'Sub Tasks : <br>';
                            foreach ($result1 as $row1) {
                            //$i = $i + 1;
                            // echo '<form action="myprogressPending/subTask/'.$row['TaskID'].'" method="post">';
                                if($row['TaskID']==$row1[1]){
                                    echo 'Sub Task '.' :'.$row1[2]. '<br>';
                                    echo '</p>';
                                }
                            // echo '</form>';
                            }
                    

                   
                        
                     echo '</div>';
                echo '</div>';
                }
                ?>
            </div>
        </div>
    </main>

    <!-- <footer class="footer">
        <label for="" class="footer-data">© 2021, All rights reserved by CO - WMS <br>
                        No: 23, Flower Avenue, Colombo 7, Sri Lanka.</label>
    </footer> -->

    <script>
        function submitForm(form){
            swal({
                title: "Are you sure ?",
                text: "This task accepted.",
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

    <!-- vvnvnbnb -->
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