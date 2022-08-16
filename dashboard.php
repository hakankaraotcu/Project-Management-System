<?php

session_start();
include("connection.php");
include("functions.php");

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management System</title>
    <link rel="stylesheet" href="Main2.css">
    <link rel="stylesheet" href="colors.css">
    <link rel="stylesheet" href="grid.css">
    <link rel="stylesheet" href="spacing.css">
    <link rel="stylesheet" href="text.css">
    <script src="https://kit.fontawesome.com/de4dd1ef2c.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script>
        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawCurveTypes);

        function drawCurveTypes() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'X');
            data.addColumn('number', 'Todo');
            data.addColumn('number', 'In Progress');
            data.addColumn('number', 'Review');
            data.addColumn('number', 'Done');

            var todoMon = document.querySelector('input[name="todoNumMon"]');
            var inprogressMon = document.querySelector('input[name="inprogressNumMon"]');
            var reviewMon = document.querySelector('input[name="reviewNumMon"]');
            var doneMon = document.querySelector('input[name="doneNumMon"]');
            var todoTue = document.querySelector('input[name="todoNumTue"]');
            var inprogressTue = document.querySelector('input[name="inprogressNumTue"]');
            var reviewTue = document.querySelector('input[name="reviewNumTue"]');
            var doneTue = document.querySelector('input[name="doneNumTue"]');
            var todoWed = document.querySelector('input[name="todoNumWed"]');
            var inprogressWed = document.querySelector('input[name="inprogressNumWed"]');
            var reviewWed = document.querySelector('input[name="reviewNumWed"]');
            var doneWed = document.querySelector('input[name="doneNumWed"]');
            var todoThu = document.querySelector('input[name="todoNumThu"]');
            var inprogressThu = document.querySelector('input[name="inprogressNumThu"]');
            var reviewThu = document.querySelector('input[name="reviewNumThu"]');
            var doneThu = document.querySelector('input[name="doneNumThu"]');
            var todoFri = document.querySelector('input[name="todoNumFri"]');
            var inprogressFri = document.querySelector('input[name="inprogressNumFri"]');
            var reviewFri = document.querySelector('input[name="reviewNumFri"]');
            var doneFri = document.querySelector('input[name="doneNumFri"]');
            var todoSat = document.querySelector('input[name="todoNumSat"]');
            var inprogressSat = document.querySelector('input[name="inprogressNumSat"]');
            var reviewSat = document.querySelector('input[name="reviewNumSat"]');
            var doneSat = document.querySelector('input[name="doneNumSat"]');
            var todoSun = document.querySelector('input[name="todoNumSun"]');
            var inprogressSun = document.querySelector('input[name="inprogressNumSun"]');
            var reviewSun = document.querySelector('input[name="reviewNumSun"]');
            var doneSun = document.querySelector('input[name="doneNumSun"]');

            const days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
            const d = new Date();
            let day = days[d.getDay() - 1];
            data.addRows([
                [days[d.getDay()], parseInt(todoThu.value),parseInt(inprogressThu.value),parseInt(reviewThu.value),parseInt(doneThu.value)],[days[d.getDay() + 1], parseInt(todoFri.value),parseInt(inprogressFri.value),parseInt(reviewFri.value),parseInt(doneFri.value)],[days[d.getDay() + 2], parseInt(todoSat.value),parseInt(inprogressSat.value),parseInt(reviewSat.value),parseInt(doneSat.value)],[days[d.getDay() + 3], parseInt(todoSun.value),parseInt(inprogressSun.value),parseInt(reviewSun.value),parseInt(doneSun.value)],[days[d.getDay() - 3], parseInt(todoMon.value),parseInt(inprogressMon.value),parseInt(reviewMon.value),parseInt(doneMon.value)],[days[d.getDay() - 2], parseInt(todoTue.value),parseInt(inprogressTue.value),parseInt(reviewTue.value),parseInt(doneTue.value)],[days[d.getDay() - 1], parseInt(todoWed.value),parseInt(inprogressWed.value),parseInt(reviewWed.value),parseInt(doneWed.value)]
            ]);

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data);
        }

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var ongoing = document.querySelector('input[name="ongoingNum"]');
            var finished = document.querySelector('input[name="finishedNum"]');
            var onhold = document.querySelector('input[name="onholdNum"]');

            var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Ongoing',     parseInt(ongoing.value)],
            ['OnHold',      parseInt(onhold.value)],
            ['Finished', parseInt(finished.value)]
            ]);
            
            var options = {
                colors:['#3466CC', '#DC3912', '#0F9618']
            }


            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
    <script>
        $(document).ready(function(){
            $(".messages .icon_wrap").click(function(){
                $(this).parent().toggleClass("active");
                $(".profile").removeClass("active");
                $(".notifications").removeClass("active");
            });
            
            $(".profile .icon_wrap").click(function(){
                $(this).parent().toggleClass("active");
                $(".messages").removeClass("active");
                $(".notifications").removeClass("active");
            });

            $(".notifications .icon_wrap").click(function(){
                $(this).parent().toggleClass("active");
                $(".messages").removeClass("active");
                $(".profile").removeClass("active");
            });
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="logo_content">
                <div class="logo">
                    <i class="fa-solid fa-copyright"></i>
                    <div class="logo_name">ProjectName</div>
                </div>
            </div>
            <ul class="nav_list">
                <li>
                    <a href="dashboard.php">
                        <i class="fa-solid fa-house"></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li>
                    <a href="projects.php">
                        <i class="fa-solid fa-briefcase"></i>
                        <span class="links_name">Projects</span>
                    </a>
                    <span class="tooltip">Projects</span>
                </li>
                <li>
                    <a href="tasks.php">
                        <i class="fa-solid fa-list-check"></i>
                        <span class="links_name">Tasks</span>
                    </a>
                    <span class="tooltip">Tasks</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-clock"></i>
                        <span class="links_name">Timesheet</span>
                    </a>
                    <span class="tooltip">Timesheet</span>
                </li>
                <li>
                    <a href="users.php">
                        <i class="fa-solid fa-users"></i>
                        <span class="links_name">Users</span>
                    </a>
                    <span class="tooltip">Users</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span class="links_name">Calendar</span>
                    </a>
                    <span class="tooltip">Calendar</span>
                </li>
                <li>
                    <a href="notes.php">
                        <i class="fa-solid fa-clipboard"></i>
                        <span class="links_name">Notes</span>
                    </a>
                    <span class="tooltip">Notes</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-comment-dots"></i>
                        <span class="links_name">Chat</span>
                    </a>
                    <span class="tooltip">Chat</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-gear"></i>
                        <span class="links_name">Workspace Settings</span>
                    </a>
                    <span class="tooltip">Workspace Settings</span>
                </li>
            </ul>
        </div>
        <div class="header">
            <div class="navbar-bg"></div>
            <div class="navbar_left">
                <div class="bars">
                    <div class="icon_wrap">
                        <i class="fa-solid fa-bars" id="menuBtn"></i>
                    </div>
                </div>
            </div>
            <div class="navbar_right">
                <div class="messages">
                    <div class="icon_wrap">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="message_dd" id="notification_dd">
                        <ul class="message_ul">
                            <li class="success">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Success</p>
                                </div>
                            </li>
                            <li class="failed">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Failed</p>
                                </div>
                            </li>
                            <li class="success">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Success</p>
                                </div>
                            </li>
                            <li class="failed">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Failed</p>
                                </div>
                            </li>
                            <li class="success">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Success</p>
                                </div>
                            </li>
                            <li class="show_all">
                                <p class="link">Show All Messages</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="notifications">
                    <div class="icon_wrap">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div class="notification_dd" id="notification_dd">
                        <ul class="notification_ul">
                            <li class="success starbucks">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Success</p>
                                </div>
                            </li>
                            <li class="failed baskin_robbins">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Failed</p>
                                </div>
                            </li>
                            <li class="success mcd">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Success</p>
                                </div>
                            </li>
                            <li class="failed pizza_hut">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Failed</p>
                                </div>
                            </li>
                            <li class="success kfc">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Success</p>
                                </div>
                            </li>
                            <li class="show_all">
                                <p class="link">Show All Notifications</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="profile">
                    <?php
                    if(isset($_SESSION['user'])){
                        ?>
                            <div class="icon_wrap">
                                <img src="person1.png" alt="profile_pic">
                                <span class="name"><?= $_SESSION['user']['userFirstName']," ", $_SESSION['user']['userLastName'] ?></span>
                                <?php
                                if(isset($error)){
                                    foreach($error as $error){
                                        echo '<span class="error-msg">'.$error.'</span>';
                                    }
                                }
                                ?>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                        <?php
                    }
                    else{
                        echo "Something went wrong";
                    }
                    ?>
                    <div class="profile_dd" id="profile_dd">
                        <ul class="profile_ul">
                            <li class="profile_li">
                                <a class="profile" href="#" style="text-align: center;">
                                    <?= $_SESSION['user']['role'] ?>
                                </a>
                            </li>
                            <li>
                                <a class="profile" href="#">
                                    <span class="picon">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a class="settings" href="#">
                                    <span class="picon">
                                        <i class="fa-solid fa-gear"></i>
                                    </span>
                                    Settings
                                </a>
                            </li>
                            <li>
                                <a class="logout" href="logout.php">
                                    <span class="picon">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    </span>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main_content" style="min-height: 821px;">
            <section class="section">
                <h2 class="section-title">Projects</h2>
                <div class="row">
                    <div class="col-12">
                        <div class="card widget-inline">
                            <div class="card-body p-0">
                                <div class="row no-gutters">
                                    <div class="col-sm-6 col-xl-3 animated">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body text-center">
                                                <i class="fa-solid fa-briefcase text-muted" style="font-size: 37px;"></i>
                                                <h3>
                                                    <?php
                                                    $row = manyToManyProjectCount("Users","UsersProjects","Projects",$_SESSION['user']['userId']);
                                                    $rowNum = $row->fetchColumn();
                                                    if($rowNum > 0){
                                                        ?>
                                                        <span><?= $rowNum ?></span>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <span>0</span>
                                                        <?php
                                                    }
                                                    ?>
                                                </h3>
                                                <p class="text-muted font-15 mb-0">Total Projects</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-3 animated">
                                        <div class="card shadow-none m-0 border-left">
                                            <div class="card-body text-center">
                                                <i class="fa-solid fa-list-check text-muted" style="font-size: 37px;"></i>
                                                <h3>
                                                    <?php
                                                    $row = manyToManyTaskCount("Users","UsersTasks","Tasks",$_SESSION['user']['userId']);
                                                    $rowNum = $row->fetchColumn();
                                                    if($rowNum > 0){
                                                        ?>
                                                        <span><?= $rowNum ?></span>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <span>0</span>
                                                        <?php
                                                    }
                                                    ?>
                                                </h3>
                                                <p class="text-muted font-15 mb-0">Total Tasks</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-3 animated">
                                        <div class="card shadow-none m-0 border-left">
                                            <div class="card-body text-center">
                                                <i class="fa-solid fa-users text-muted" style="font-size: 37px;"></i>
                                                <h3>
                                                    <span>0</span>
                                                </h3>
                                                <p class="text-muted font-15 mb-0">Members</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-3 animated">
                                        <div class="card shadow-none m-0 border-left">
                                            <div class="card-body text-center">
                                                <i class="fa-solid fa-bug text-muted" style="font-size: 37px;"></i>
                                                <h3>
                                                    <span>0</span>
                                                </h3>
                                                <p class="text-muted font-15 mb-0">Bugs</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card animated">
                            <div class="card-header">
                                <h4>Tasks Overview</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                    $todoMon = fillChart("Tasks", 1, "Monday");
                                    $todoNumMon = $todoMon->fetchColumn();
                                    $inprogressMon = fillChart("Tasks", 2, "Monday");
                                    $inprogressNumMon = $inprogressMon->fetchColumn();
                                    $reviewMon = fillChart("Tasks", 3, "Monday");
                                    $reviewNumMon = $reviewMon->fetchColumn();
                                    $doneMon = fillChart("Tasks", 4, "Monday");
                                    $doneNum = $doneMon->fetchColumn();
                                    $todoTueMon = fillChart("Tasks", 1, "Tuesday");
                                    $todoNumTue = $todoTueMon->fetchColumn();
                                    $inprogressTue = fillChart("Tasks", 2, "Tuesday");
                                    $inprogressNumTue = $inprogressTue->fetchColumn();
                                    $reviewTue = fillChart("Tasks", 3, "Tuesday");
                                    $reviewNumTue = $reviewTue->fetchColumn();
                                    $doneTue = fillChart("Tasks", 4, "Tuesday");
                                    $doneNumTue = $doneTue->fetchColumn();
                                    $todoWed = fillChart("Tasks", 1, "Wednesday");
                                    $todoNumWed = $todoWed->fetchColumn();
                                    $inprogressWed = fillChart("Tasks", 2, "Wednesday");
                                    $inprogressNumWed = $inprogressWed->fetchColumn();
                                    $reviewWed = fillChart("Tasks", 3, "Wednesday");
                                    $reviewNumWed = $reviewWed->fetchColumn();
                                    $doneWed = fillChart("Tasks", 4, "Wednesday");
                                    $doneNumWed = $doneWed->fetchColumn();
                                    $todoThu = fillChart("Tasks", 1, "Thursday");
                                    $todoNumThu = $todoThu->fetchColumn();
                                    $inprogressThu = fillChart("Tasks", 2, "Thursday");
                                    $inprogressNumThu = $inprogressThu->fetchColumn();
                                    $reviewThu = fillChart("Tasks", 3, "Thursday");
                                    $reviewNumThu = $reviewThu->fetchColumn();
                                    $doneThu = fillChart("Tasks", 4, "Thursday");
                                    $doneNumThu = $doneThu->fetchColumn();
                                    $todoFri = fillChart("Tasks", 1, "Friday");
                                    $todoNumFri = $todoFri->fetchColumn();
                                    $inprogressFri = fillChart("Tasks", 2, "Friday");
                                    $inprogressNumFri = $inprogressFri->fetchColumn();
                                    $reviewFri = fillChart("Tasks", 3, "Friday");
                                    $reviewNumFri = $reviewFri->fetchColumn();
                                    $doneFri = fillChart("Tasks", 4, "Friday");
                                    $doneNumFri = $doneFri->fetchColumn();
                                    $todoSat = fillChart("Tasks", 1, "Saturday");
                                    $todoNumSat = $todoSat->fetchColumn();
                                    $inprogressSat = fillChart("Tasks", 2, "Saturday");
                                    $inprogressNumSat = $inprogressSat->fetchColumn();
                                    $reviewSat = fillChart("Tasks", 3, "Saturday");
                                    $reviewNumSat = $reviewSat->fetchColumn();
                                    $doneSat = fillChart("Tasks", 4, "Saturday");
                                    $doneNumSat = $doneSat->fetchColumn();
                                    $todoSun = fillChart("Tasks", 1, "Sunday");
                                    $todoNumSun = $todoSun->fetchColumn();
                                    $inprogressSun = fillChart("Tasks", 2, "Sunday");
                                    $inprogressNumSun = $inprogressSun->fetchColumn();
                                    $reviewSun = fillChart("Tasks", 3, "Sunday");
                                    $reviewNumSun = $reviewSun->fetchColumn();
                                    $doneSun = fillChart("Tasks", 4, "Sunday");
                                    $doneNumSun = $doneSun->fetchColumn();
                                ?>
                                <div class="mt-3" style="height: 320px;">
                                    <input type="hidden" name="todoNumMon" value="<?= $todoNumMon ?>">
                                    <input type="hidden" name="inprogressNumMon" value="<?= $inprogressNumMon ?>">
                                    <input type="hidden" name="reviewNumMon" value="<?= $reviewNumMon ?>">
                                    <input type="hidden" name="doneNumMon" value="<?= $doneNumMon ?>">
                                    <input type="hidden" name="todoNumTue" value="<?= $todoNumTue ?>">
                                    <input type="hidden" name="inprogressNumTue" value="<?= $inprogressNumTue ?>">
                                    <input type="hidden" name="reviewNumTue" value="<?= $reviewNumTue ?>">
                                    <input type="hidden" name="doneNumTue" value="<?= $doneNumTue ?>">
                                    <input type="hidden" name="todoNumWed" value="<?= $todoNumWed ?>">
                                    <input type="hidden" name="inprogressNumWed" value="<?= $inprogressNumWed ?>">
                                    <input type="hidden" name="reviewNumWed" value="<?= $reviewNumWed ?>">
                                    <input type="hidden" name="doneNumWed" value="<?= $doneNumWed ?>">
                                    <input type="hidden" name="todoNumThu" value="<?= $todoNumThu ?>">
                                    <input type="hidden" name="inprogressNumThu" value="<?= $inprogressNumThu ?>">
                                    <input type="hidden" name="reviewNumThu" value="<?= $reviewNumThu ?>">
                                    <input type="hidden" name="doneNumThu" value="<?= $doneNumThu ?>">
                                    <input type="hidden" name="todoNumFri" value="<?= $todoNumFri ?>">
                                    <input type="hidden" name="inprogressNumFri" value="<?= $inprogressNumFri ?>">
                                    <input type="hidden" name="reviewNumFri" value="<?= $reviewNumFri ?>">
                                    <input type="hidden" name="doneNumFri" value="<?= $doneNumFri ?>">
                                    <input type="hidden" name="todoNumSat" value="<?= $todoNumSat ?>">
                                    <input type="hidden" name="inprogressNumSat" value="<?= $inprogressNumSat ?>">
                                    <input type="hidden" name="reviewNumSat" value="<?= $reviewNumSat ?>">
                                    <input type="hidden" name="doneNumSat" value="<?= $doneNumSat ?>">
                                    <input type="hidden" name="todoNumSun" value="<?= $todoNumSun ?>">
                                    <input type="hidden" name="inprogressNumSun" value="<?= $inprogressNumSun ?>">
                                    <input type="hidden" name="reviewNumSun" value="<?= $reviewNumSun ?>">
                                    <input type="hidden" name="doneNumSun" value="<?= $doneNumSun ?>">
                                    <div id="chart_div" style="height: 100%; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card animated">
                            <div class="card-header">
                                <h4>Project Status</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                    $ongoing = fillChart1("Projects", 1);
                                    $ongoingNum = $ongoing->fetchColumn();
                                    $finished = fillChart1("Projects", 2);
                                    $finishedNum = $finished->fetchColumn();
                                    $onhold = fillChart1("Projects", 3);
                                    $onholdNum = $onhold->fetchColumn();
                                    $percentageOngoing = calPercentage($ongoingNum, $ongoingNum + $finishedNum + $onholdNum);
                                    $percentageFinished = calPercentage($finishedNum, $ongoingNum + $finishedNum + $onholdNum);
                                    $percentageOnhold = calPercentage($onholdNum, $ongoingNum + $finishedNum + $onholdNum);
                                ?>
                                <div class="my-4">
                                    <input type="hidden" name="ongoingNum" value="<?= $ongoingNum ?>">
                                    <input type="hidden" name="finishedNum" value="<?= $finishedNum ?>">
                                    <input type="hidden" name="onholdNum" value="<?= $onholdNum ?>">
                                    <div id="piechart" style="width: 100%; height: 100%;"></div>
                                </div>
                                <div class="row text-center mt-2 py-2">
                                    <div class="col-4">
                                        <i class="fa-solid fa-list-check text-success mt-3 h3"></i>
                                        <h3 class="font-weigth-normal">
                                            <span><?= $percentageOngoing ?>%</span>
                                        </h3>
                                        <p class="text-muted mb-0">Ongoing</p>
                                    </div>
                                    <div class="col-4">
                                        <i class="fa-solid fa-list-check text-success mt-3 h3"></i>
                                        <h3 class="font-weigth-normal">
                                            <span><?= $percentageFinished ?>%</span>
                                        </h3>
                                        <p class="text-muted mb-0">Finished</p>
                                    </div>
                                    <div class="col-4">
                                        <i class="fa-solid fa-list-check text-success mt-3 h3"></i>
                                        <h3 class="font-weigth-normal">
                                            <span><?= $percentageOnhold ?>%</span>
                                        </h3>
                                        <p class="text-muted mb-0">OnHold</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card animated">
                            <div class="card-header">
                                <h4>Tasks</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                    $doneTask = getDoneTask("Tasks", 4);
                                    $doneTaskNum = $doneTask->fetchColumn();
                                ?>
                                <p>
                                    <b><?= $doneTaskNum ?></b>
                                    Tasks completed out of <?= $rowNum ?>
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-centered table-hover mb-0 animated">
                                        <tbody>
                                            <?php
                                            $tasks = getTasks("Users","UsersTasks","Tasks","Projects", "TaskPriority", "Milestones", "TaskStatus", $_SESSION['user']['userId']);
                                            foreach($tasks as $task){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="font-14 my-1">
                                                            <a href="task.php?id=<?= $task['project_id'] ?>" class="text-body"><?= $task['task_title'] ?></a>
                                                        </div>
                                                        <span class="text-muted font-13">Due in 1 day</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted font-13">Status</span>
                                                        <br>
                                                        <span class="badge badge-primary"><?= $task['taskStatus_status'] ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted font-13">Project</span>
                                                        <div class="font-14 mt-1 font-weight-normal"><?= $task['project_name'] ?></div>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted font-13">Assigned to</span>
                                                        <div class="font-14 mt-1 font-weight-normal">
                                                            <span class="badge badge-secondary"><?= $task['first_name'] ?></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                This website made by Hakan Karaotcu
            </div>
        </footer> 
    </div>
    <script>
        let btn = document.querySelector("#menuBtn");
        let sidebar = document.querySelector(".sidebar");

        btn.onclick = function(){
            sidebar.classList.toggle("active");
        }
    </script>
</body>
</html>