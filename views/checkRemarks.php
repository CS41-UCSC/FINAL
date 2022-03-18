<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/checkRemarks_style.css?<?php echo time(); ?>" type="text/css">
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
            <a href="http://localhost/FINAL/login/logout" class="nav-link" id="logout">
                <i class="fa fa-list-alt fa-lg"><span>Logout</span></i>
            </a>
        </div>

        <div class="nav-overlay"></div>
    </nav>

    <main>


        <div class="container" id="container">

            <?php
            $name = $this->tname;
            $result = $this->users;

            echo '<div class="item1">';
            echo '<h3>' . $name . '</h3>';
            echo '</div>';

            foreach ($result as $row) {

                echo '<div class="item2">';
                echo '<label for="" class="empid">' . $row[1] . '</label><br>';
                echo '<label for="" class="adddate">' . $row[4] . '</label><br>';
                echo '<label for="" class="remarks">' . $row[3] . '</label><br>';

                echo '<div class="status">';

                if ($row[5] == "Accept") {
                    echo '<input type="radio" id="stts" name="astts" checked>';
                    echo '<label for="" class="accept" >Accept</label>';
                    echo '<input type="radio" id="stts" name="astts" disabled>';
                    echo '<label for="" class="reject">Reject</label><br>';
                } else if ($row[5] == "Reject") {
                    echo '<input type="radio" id="stts" name="rstts" disabled>';
                    echo '<label for="" class="accept" >Accept</label>';
                    echo '<input type="radio" id="stts" name="rstts" checked>';
                    echo '<label for="" class="reject">Reject</label><br>';
                } else {
                    echo '<input type="radio" id="astts" name="' . $row[0] . '" >';
                    echo '<label for="" class="accept" >Accept</label>';
                    echo '<input type="radio" id="rstts" name="' . $row[0] . '">';
                    echo '<label for="" class="reject">Reject</label><br>';
                }

                echo '<input type="button" id="' . $row[0] . '" value="Save" class="btn" onclick="editRemark();" >';

                echo '</div>';

                echo '<label for="" class="accdate">' . $row[6] . '</label><br>';

                echo '</div>';
            }

            ?>
            
        </div>

        <div class="remark">
            <script>
                document.write('<a href="' + document.referrer + '" class="backbtn" >Go Back</a>');
            </script>
        </div>

    </main>

    <script>
        function editRemark() {

            var id = event.target.id;

            var x = document.getElementById("astts").checked;
            var y = document.getElementById("rstts").checked;

            var st;

            if (x == true)
                st = "Accept";
            else if (y == true)
                st = "Reject";

            window.location.href = "http://localhost/FINAL/Task/editRemarks?RemarkID=" + id + "&Status=" + st;
        }
    </script>