<?php 
session_start();
if (!isset($_SESSION["fname"])){
	header("Location: ../login_Admin.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>About&help</title>
    <link rel="stylesheet" href="css/dash.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-diamond'></i>
      <span class="logo_name">Welcome</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="dash.php">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="userManagement.php">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">User Management</span>
          </a>
        </li>
        <li>
          <a href="Assessment_config.php">
            <i class='bx bx-book-content' ></i>
            <span class="links_name">Configuration</span>
          </a>
        </li>
        <li>
          <a href="sys_monitoring.php">
          <i class='bx bxs-bar-chart-alt-2'></i>
            <span class="links_name">System Monitoring</span>
          </a>
        </li>
        <li>
          <a href="reports.php">
            <i class="bx bxs-report"></i>
            <span class="links_name">Reports</span>
          </a>
        </li>
        <!-- <li>
          <a href="message.php">
            <i class='bx bx-message' ></i>
            <span class="links_name">Messages</span>
          </a>
        </li> -->
        <li>
          <a href="settings.php">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Settings</span>
          </a>
        </li>
        <li>
          <a href="help.php"  class="active">
            <i class='bx bx-help-circle' ></i>
            <span class="links_name">Help</span>
          </a>
        </li>
        <li class="log_out">
          <a href="../logout_admin.php">
            <i class='bx bx-log-out-circle' ></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Admin Dashboard</span>
      </div>
      <div class="profile-details">
      <img src="<?php echo $_SESSION['img'];?>" alt="pro">
        <span class="admin_name"><?php echo $_SESSION['fname'];?></span>
      </div>
    </nav>

    <div class="home-content">

      <div class="stat-boxes">
        <div class="recent-stat box" style="width:100%">
        <div class="title"><b>How to use</b></div>
          <br><br>
          <h4>Q1. How to logout?</h4>
          <p>Ans: Click on the logout button at the left bottom on the navigation bar.</p><br>
          <h4>Q2. How to edit my profile details?</h4>
          <p>Ans: Click on the settings option from the left navigation bar. After filling the required columns, click on update.</p><br>
          <h4>Q3. How to manage user accounts?</h4>
          <p>Ans: Go to the 'User Management' option from the left navigation bar. Here, you can create, modify, or delete user accounts.</p><br>
          <h4>Q4. How to schedule and configure assessments?</h4>
          <p>Ans: Navigate to the 'Assessment Configuration' section from the left navigation bar. Use the interface to schedule assessments, set parameters, and configure proctoring settings.</p><br><h4>Q5. How to monitor system performance and proctoring?</h4>
          <p>Ans: Access the 'System Monitoring' dashboard from the left navigation bar. This page provides a real-time view of system health, proctoring alerts, and ongoing assessments.</p><br>
          <h4>Q6. How to generate and review reports?</h4>
          <p>Ans: Go to the 'Reports' section from the left navigation bar. Use the tools provided to generate various reports, including assessment performance, user activity, and system compliance.</p><br>
          <h4>Q7. How to manage security and data privacy?</h4>
          <p>Ans: Click on the 'Security Settings' option from the left navigation bar. Here, you can configure security protocols, manage access controls, and review audit logs.</p><br>
          <h4>Q8. How to access help and support?</h4>
          <p>Ans: Navigate to the 'Help & Support' section from the left navigation bar. This page provides FAQs, guides, and contact support options.</p><br>
      </div>
    </div>
  </section>

<script src="../js/script.js"></script>


</body>
</html>

