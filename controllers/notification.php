<?php

class notification extends Controller{
	
	function __construct()
	{
		parent::__construct();
		session_start();
	}
	
	function index(){
		
		if(isset($_GET['ID'])){
			
			$notData = $this->model->getdata($_GET['ID']);
			$sender = $this->model->getSenderRole($notData['0']['Sender']);

			if(!empty($notData)){
				if($notData['0']['Notype']=='Leave'){
					if(($_SESSION['emprole']=="Dept_Manager")||($_SESSION['emprole']=="HR_Manager")){
						$link= "http://localhost/CO-WMS/leave/dptleavePending";
					}
					elseif(($_SESSION['emprole']=="Team_Leader")||($_SESSION['emprole']=="Team_Member")){
						
						if((!empty($sender))&&($sender['0']['0']=="Dept_Manager")){
							$link= "http://localhost/CO-WMS/leave/myleavePending";
						}
						else{
							echo 'Unidentifined Notification';
						}
						
					}
					else{
						echo 'Unidentifined Notification';
					}
				}
				elseif($_GET['type']=='Task'){

					$notification = explode(" ",$notData['0']['Notification']);

					if(($_SESSION['emprole']=="Dept_Manager")||($_SESSION['emprole']=="HR_Manager")){
						$link= "http://localhost/CO-WMS/Task/showpage_taskProgress";
					}
					elseif(($_SESSION['emprole']=="Team_Leader")&&($sender['0']['0']=="Team_Member")){
						$link= "http://localhost/CO-WMS/Task/showpage_teamProgress";
					}
					elseif(($sender['0']['0']=="Dept_Manager")||($sender['0']['0']=="HR_Manager")){
						if($notification['1']=="assigned"){
							$link= "http://localhost/CO-WMS/Member/showpage_myprogressPending";
						}
						elseif($notification['1']=="approved"){
							$link= "http://localhost/CO-WMS/Member/showpage_myprogressCompleted";
						}
						else{
							echo 'Unidentifined Notification';
						}
					}
					elseif(($_SESSION['emprole']=="Team_Member")&&($sender['0']['0']=="Team_Leader")){
						$link= "http://localhost/CO-WMS/Member/showpage_myprogressPending";
					}
					else{
						echo 'Unidentifined Notification';
					}
				}
				elseif($_GET['type']=='Access'){
					if(($_SESSION['emprole']=="Admin")&&($sender['0']['0']=="HR_Manager")){
						$link= "http://localhost/CO-WMS/admin/adminHome";
					}
					else{
						echo 'Unidentifined Notification';
					}
				}
				else{
					echo 'Unidentifined Notification';
				}
				$this->model->changeNotStatus($_GET['ID']);
				echo '<script>window.location.replace("'.$link.'");</script>';
			}
			else{
				echo 'Unidentifined Notification';
			}
		}
		else{
			echo 'Unidentifined';
		}

	}
	
}

?>