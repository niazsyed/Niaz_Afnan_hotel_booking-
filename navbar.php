<body onload="sidebarOpener()">
<div class="topnav navshadow" id="nav">
    <a href="./index.php" class="logo">Hotel Booking</a>
    <button class="openbtn" onclick="openNav()"><i class="dripicons-menu"></i></button>
    <div class="navbar-right">
        <a href="logout.php" title="Logout"><i class="dripicons-exit"></i></a>
    </div>
</div>

<div id="mySidebar" class="sidebar dropshadow1 vertical-menu">
    <nav>
        <?php
        if($user_type=="customer"){
            echo '<a href="dashboard.php" ><i class="dripicons-home"></i> Dashboard</a>
<a href="changepassword.php"><i class="dripicons-link"></i> Change Password</a>
        <a href="book.php"><i class="dripicons-plus"></i> Book</a>';
        }
        else if($user_type=="staff"){
            echo '<a href="dashboard.php"><i class="dripicons-home"></i> Dashboard</a>
<a href="changepassword.php"><i class="dripicons-link"></i> Change Password</a>
<a href="viewusers.php"><i class="dripicons-home"></i> View Customers</a>
        <a href="book.php"><i class="dripicons-plus"></i> Book</a>
        <a href="adduser.php"><i class="dripicons-rocket"></i> Add User</a>';
        }
        else if($user_type=="admin"){
            echo '<a href="dashboard.php"><i class="dripicons-briefcase"></i> Dashboard</a>
        <a href="changepassword.php"><i class="dripicons-link"></i> Change Password</a>
        <a href="viewusers.php"><i class="dripicons-link"></i> View Users</a>
        <a href="addroom.php"><i class="dripicons-link"></i> Add Room</a>
        <a href="addroomdesc.php"><i class="dripicons-link"></i> Add Room Desc</a>
        <a href="addroomtype.php"><i class="dripicons-document"></i> Add Room Type</a>
        <a href="addbed.php"><i class="dripicons-link"></i> Add Bed Type</a>
        <a href="adduser.php"><i class="dripicons-rocket"></i> Add User</a>';
        }

        ?>
    </nav>
</div>