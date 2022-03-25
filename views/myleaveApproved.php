<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://localhost/FINAL/style/myleave.css?<?php echo time(); ?>" type="text/css">
	<link rel="stylesheet" href="http://localhost/FINAL/style/nav_style.css?<?php echo time(); ?>" type="text/css">
	<link rel="stylesheet" href="http://localhost/FINAL/style/notification_style.css?<?php echo time(); ?>" type="text/css">
    <!-- <link rel="stylesheet" href="http://localhost/FINAL/font-awesome-4.7.0/css/font-awesome.min.css"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script language="javascript" src="http://localhost/FINAL/resource/navigation.js?<?php echo time(); ?>">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
	</script>
	<style>
	.item4{
		height: 30vh;
	}
	</style>
    <title>CO-WMS</title>
</head>

<body class="preload" onload='setbutton("<?php echo $_SESSION["memberaccess"] ?>","<?php echo $_SESSION["myprofile"] ?>","<?php echo $_SESSION["manageraccess"] ?>","<?php echo $_SESSION["leaderaccess"] ?>","<?php echo $_SESSION["hraccess"] ?>","<?php echo $_SESSION["adminaccess"] ?>")'>
    <header class="header">
        <button class="header-button" id="btnNav" type="button">
            <i class="fa fa-bars fa-lg"></i>
        </button>
        <img src="http://localhost/FINAL/Asserts/logo.jpg" alt="" class="open-img">
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
        <div class="user-login"> <?php echo $_SESSION['login_user']; ?> </div>
        <img  class="img-rounded-circle" src="http://localhost/FINAL/Asserts/avator.jpg" alt="" />
    </header>
	<div class="page">
		<!--<div class="nav-icons">
            <a href="#" class="nav-link" id="manage_access">
                <i class="fa fa-pencil-square-o fa-lg"></i>
            </a>
            <a href="#" class="nav-link" id="dashboard">
                <i class="fa fa-tachometer fa-lg" ></i>
            </a>
			<a href="#" class="nav-link" id="d_progress">
                <i class="fa fa-tachometer fa-lg" ></i>
            </a>
            <a href="#" class="nav-link" id="my_profile">
                <i class="fa fa-user fa-lg" ></i>
            </a>
			<a href="#" class="nav-link" id="my_progress">
                <i class="fa fa-user fa-lg" ></i>
            </a>
			<a href="#" class="nav-link" id="t_progress">
                <i class="fa fa-users fa-lg" ></i>
            </a>
			<a href="#" class="nav-link" id="emp_progress">
                <i class="fa fa-users fa-lg" ></i>
            </a>
            <a href="#" class="nav-link" id="manage_task_dpt">
                <i class="fa fa-tasks fa-lg" ></i>
            </a>
			<a href="#" class="nav-link" id="manage_task_leader">
                <i class="fa fa-tasks fa-lg" ></i>
            </a>
            <a href="#" class="nav-link" id="manage_emp">
                <i class="fa fa-pencil-square-o fa-lg" ></i>
            </a>
            <a href="#" class="nav-link  nav-link-active" id="my_leave">
                <i class="fa fa-list-alt fa-lg" ></i>
            </a>
			<a href="#" class="nav-link" id="t_leave">
                <i class="fa fa-list-alt fa-lg" ></i>
            </a>
			<a href="#" class="nav-link" id="d_leave">
                <i class="fa fa-list-alt fa-lg" ></i>
            </a>
			<a href="#" class="nav-link" id="emp_leave">
                <i class="fa fa-list-alt fa-lg" ></i>
            </a>
			<a href="#" class="nav-link" id="logout">
                <i class="fa fa-sign-out fa-lg" ></i>
            </a>
        </div>-->
		<nav class="nav">
        <div class="nav-links nav-link-icons">
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
        <div class="container">
			<div class="item1">
				<div class="toplinkbar">
					<a href="#" class="toplink toplink-active" id="toplink1" ><span>Approved</span></a>
					<a href="myleavePending" class="toplink" id="toplink2"><span>Pending</span>
					<a href="myleaveRequest" class="toplink" id="toplink3"><span>Leave Request</span></a>
				</div>
			</div>
			<div class="item2">
				<?php
					$month_val = $this->month_val;
				?>
				<form class="date-filter" method="POST" action="myleaveApproved" >
					<input type="month" name="month" class="filter" value="<?php echo $month_val; ?>" id="mfilter" />
					<button type="submit" name="filterbtn" class="fabtn" id="filterbtn" >
						<i class="fa fa-filter fa-lg" ></i>
					</button>
				</form>
			</div>
			<div class="item3">
				<div class="chart">
					<canvas id="annual" >
					</canvas>
				</div>
				<div class="chart">
					<canvas id="casual" >
					</canvas>
				</div>
				<div class="chart">
					<canvas id="sick" >
					</canvas>
				</div>
			</div>
			<div class="item4">
				<table>
                <?php
					$data=$this->data;
					if(!empty($data)){
					foreach($data as $row){
						echo '<tr id= ' . $row['0'] . '>';
						echo'<td class="row-data">'.$row['LeaveType'].'</td>';
						echo '<td class="row-data">'.$row['StartDate'].' &nbsp - &nbsp '.$row['EndDate'].'</td>';
						echo '<td class="row-data">'.$row['LStatus'].'</td>';
						echo'</tr>';
					}
					}else{
						echo "No records found";
					}
				?>
				</table>
			</div>
        </div>        
    </main>
	</div>
   <footer class="footer">
        <label class="footer-data">© 2021, All rights reserved by CO - WMS <br> Sri Lanka</label>
    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", () =>{
            const nav = document.querySelector(".nav");
			const con = document.querySelector(".container");
			const navbtn = document.querySelector("#btnNav");
			const overlay = document.querySelector(".nav-overlay");

            navbtn.addEventListener("click" , () =>{
                nav.classList.add("nav-open");
                con.classList.add("containerN");
            });
			
            overlay.addEventListener("click" , () =>{
                nav.classList.remove("nav-open");
                con.classList.remove("containerN");
            });
			
        });
		
	</script>
	<script>
		var date = new Date();
		const currentmonth = ("0" + (date.getMonth() +1)).slice(-2)
		const minyear = date.getFullYear() - 1;
		const maxyear = date.getFullYear() + 1;
		var monthFilter = document.querySelector('input[type="month"]');
		monthFilter.min = `${minyear}-${currentmonth}`;
		monthFilter.max = `${maxyear}-${currentmonth}`;
	</script>
	<?php
		$taken_Annual = 0;
		$taken_Casual = 0;
		$taken_Sick = 0;

		if(!empty($this->taken_annual)){
			foreach($this->taken_annual as $count){
				if($count['0']==NULL){
					$taken_Annual = 0;
				}
				else{
					$taken_Annual = $count['0'];
				}
			}
		}

		if(!empty($this->taken_casual)){
			foreach($this->taken_casual as $count){
				if($count['0']==NULL){
					$taken_Casual = 0;
				}
				else{
					$taken_Casual = $count['0'];
				}
			}
		}

		if(!empty($this->taken_sick)){
			foreach($this->taken_sick as $count){
				if($count['0']==NULL){
					$taken_Sick = 0;
				}
				else{
					$taken_Sick = $count['0'];
				}
			}
		}

		$remain_annual = $this->annual - $taken_Annual;
		$remain_casual = $this->casual - $taken_Casual;
		$remain_sick = $this->sick - $taken_Sick;

		echo '<script>
		var xValues = ["Approved","Remaining"];
		var y1Values = ['.$taken_Annual.','.$remain_annual.']
		var y2Values = ['.$taken_Casual.','.$remain_casual.'];
		var y3Values = ['.$taken_Sick.','.$remain_sick.'];
		var barColors = ["#DC950B","#265397"];
		
		new Chart("annual",{
			type: "doughnut", data: {
				labels: xValues, datasets: [{
					backgroundColor: barColors, data: y1Values
				}]
			},
			options: {
				title: {
					display: true,
					text: "Annual"
				}
			}
		});
		
		new Chart("casual",{
			type: "doughnut", data: {
				labels: xValues, datasets: [{
					backgroundColor: barColors, data: y2Values
				}]
			},
			options: {
				title: {
					display: true,
					text: "Casual"
				}
			}
		});
		
		new Chart("sick",{
			type: "doughnut", data: {
				labels: xValues, datasets: [{
					backgroundColor: barColors, data: y3Values
				}]
			},
			options: {
				title: {
					display: true,
					text: "Sick"
				}
			}
		});
	</script>';
	?>
</body>
</html>