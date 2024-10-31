<?php
date_default_timezone_set('Asia/Kolkata');
session_start();
if (!isset($_SESSION["uname"])) {
  header("Location: ../login_student.php");
}

include '../config.php';
error_reporting(0);
$exid = $_POST['exid'];

if (!isset($_POST["edit_btn"])) {
  header("Location: exams.php");
}

if (isset($_POST["edit_btn"])) {
  $sql = "SELECT * FROM exm_list WHERE exid='$exid'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $ogtime = $row['extime'];
  $subt = $row['subt'];
  $cmtime = date("Y-m-d H:i:s");

  $letters = array('-', ' ', ':');
  $ogtime = str_replace($letters, '', $ogtime);
  $cmtime = str_replace($letters, '', $cmtime);
  if ($ogtime > $cmtime) {
    header("Location: exams.php");
  }
  if ($cmtime > $subt) {
    echo "<script>st();</script>";
  }
}

$sql = "SELECT qid, qstn, qstn_o1, qstn_o2, qstn_o3, qstn_o4, qstn_type FROM qstn_list WHERE exid='$exid'";
$result = mysqli_query($conn, $sql);

$details = "SELECT * FROM exm_list WHERE exid='$exid'";
$res = mysqli_query($conn, $details);
while ($rowd = mysqli_fetch_array($res)) {
  $nq = $rowd['nq'];
  $exname = $rowd['exname'];
  $desp = $rowd['desp'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Exams</title>
  <link rel="stylesheet" href="css/dash.css">
  <link rel="stylesheet" href="css/examportal_styles.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  $td = $subt;
  ?>
  <script type="text/javascript">
    function st() {
      document.getElementById("form1").submit();
    }
    //set the date we are counting down to 
    var count_id = "<?php echo $td; ?>";
    var countDownDate = new Date(count_id).getTime();
    //Update the count down every 1 second 
    var x = setInterval(function() {
      //Get today's date and time 
      var now = new Date().getTime();
      //Find the distance between now and the count down date 
      var distance = countDownDate - now;
      //Time calculations for days, hours, minutes and seconds 
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      document.getElementById("time").innerHTML = "Timer: " + hours + "h " + minutes + "m " + seconds + "s";
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("form1").submit();
      }
    }, 1000);
  </script>
</head>

<body>
  <div class="sidebar active">
    <div class="logo-details">
      <i class='bx bx-diamond'></i>
      <span class="logo_name">Welcome</span>
    </div>
    <ul class="nav-links">
      <li>
        <a>
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="exams.php" class="active">
          <i class='bx bx-book-content'></i>
          <span class="links_name">Exams</span>
        </a>
      </li>
      <li>
        <a>
          <i class='bx bxs-bar-chart-alt-2'></i>
          <span class="links_name">Results</span>
        </a>
      </li>
      <li>
        <a>
          <i class='bx bx-message'></i>
          <span class="links_name">Messages</span>
        </a>
      </li>
      <li>
        <a>
          <i class='bx bx-cog'></i>
          <span class="links_name">Settings</span>
        </a>
      </li>
      <li>
        <a>
          <i class='bx bx-help-circle'></i>
          <span class="links_name">Help</span>
        </a>
      </li>
      <li class="log_out">
        <a>
          <i class='bx bx-log-out-circle'></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu-alt-right sidebarBtn'></i>
        <span class="dashboard">Student Dashboard</span>
      </div>
    </nav>

    <div class="home-content">
      <div class="stat-boxes">
        <div class="recent-stat box">
          <div>
            <h3>Exam name: <?php echo $exname ?><?php echo '
          <p id="time"style="float:right"></p>'; ?></h3>
          </div>
          <span style="font-size: 17px;">Description: <?php echo $desp ?></span>
          <br><br><br>
          <form action="submit.php" id="form1" method="post">
            <div class="radio-container">
              <?php
              if (mysqli_num_rows($result) > 0) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '
                  <div class="question-container" id="question' . $i . '">
                    <input type="hidden" name="qid' . $i . '" value="' . $row['qid'] . '">
                    <div class="question-header">
                      <span class="question-number">Q' . $i . '.</span>
                      <span class="question-text">' . $row['qstn'] . '</span>
                    </div>';
              
                  if ($row['qstn_type'] == 'single_choice') {
                    echo '<div class="options-container single-choice">';
                    $options = array($row['qstn_o1'], $row['qstn_o2'], $row['qstn_o3'], $row['qstn_o4']);
                    foreach ($options as $index => $option) {
                      echo '
                      <div class="option-item">
                        <input type="radio" id="o' . ($index + 1) . $i . '" name="o' . $i . '" value="' . $option . '" />
                        <label class="option-label" for="o' . ($index + 1) . $i . '">
                          <span class="option-text">' . $option . '</span>
                        </label>
                      </div>';
                    }
                    echo '</div>';
                  } 
                  else if ($row['qstn_type'] == 'multiple_choice') {
                    echo '<div class="options-container multiple-choice">';
                    $options = array($row['qstn_o1'], $row['qstn_o2'], $row['qstn_o3'], $row['qstn_o4']);
                    foreach ($options as $index => $option) {
                      echo '
                      <div class="option-item">
                        <input type="checkbox" id="o' . ($index + 1) . $i . '" name="o' . $i . '[]" value="' . $option . '" />
                        <label class="option-label" for="o' . ($index + 1) . $i . '">
                          <span class="option-text">' . $option . '</span>
                        </label>
                      </div>';
                    }
                    echo '</div>';
                  }
                  echo '</div>';
                  $i++;
                }
              }
              ?>
            </div>
            <div class="button-container">
              <input type="hidden" name="exid" value="<?php echo $exid; ?>" />
              <input type="hidden" name="nq" value="<?php echo $nq; ?>" />
              <button type="reset" class="rbtn">Reset all</button>
              <button type="button" class="prev-btn" onclick="prevQuestion()">Previous</button>
              <button type="button" class="next-btn" onclick="nextQuestion()">Next</button>
              <input type="submit" name="ans_sub" value="Submit" class="btn" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <div class="full-screen-modal" id="fullScreenModal">
    <div class="modal-content">
        <div class="warning-icon">⚠️</div>
        <h2>Exam Guidelines</h2>
        <p>Please read the following instructions carefully before starting the exam:</p>
        <ul>
            <li>You must remain in full-screen mode throughout the exam</li>
            <li>Switching tabs or windows is not permitted</li>
            <li>The exam will auto-submit if you exit full-screen mode</li>
            <li>Right-clicking and keyboard shortcuts are disabled</li>
            <li>Ensure you have a stable internet connection</li>
        </ul>
        <button id="startFullScreenBtn">Start Exam in Full Screen</button>
    </div>
  </div>
  <script>
    var inputs = document.querySelectorAll("input[type=radio]:checked"),
      x = inputs.length;
    document.querySelector("button[type=reset]").addEventListener("click", function(event) {
      const inputs = document.querySelectorAll("input[type=radio]:checked, input[type=checkbox]:checked");
    inputs.forEach(input => input.checked = false);
    });

    var currentQuestion = 1;
    var totalQuestions = <?php echo $nq; ?>;

    function showQuestion(questionNumber) {
      document.querySelectorAll('.question-container').forEach(function(question) {
        question.style.display = 'none';
      });
      document.getElementById('question' + questionNumber).style.display = 'block';
    }

    function nextQuestion() {
      if (currentQuestion < totalQuestions) {
        currentQuestion++;
        showQuestion(currentQuestion);
      }
    }

    function prevQuestion() {
      if (currentQuestion > 1) {
        currentQuestion--;
        showQuestion(currentQuestion);
      }
    }

    // Initialize by showing the first question
    showQuestion(currentQuestion);

    function showModal(){
      document.getElementById('fullScreenModal').style.display = 'flex';
    }

    function hideModal(){
      document.getElementById('fullScreenModal').style.display = 'none';
    }

    function enterFullScreen(){
      const elem = document.documentElement;
      if(elem.requestFullscreen){
        elem.requestFullscreen();
      } else if(elem.mozRequestFullScreen){
        elem.mozRequestFullScreen();
      } else if(elem.webkitRequestFullscreen){
        elem.webkitRequestFullscreen();
      } else if(elem.msRequestFullscreen){
        elem.msRequestFullscreen();
      }
    }
    // Show the modal when the page loads
    document.addEventListener('DOMContentLoaded', function() {
      showModal();
      const startFullScreenBtn = document.getElementById('startFullScreenBtn');
      let tabSwitchCount = 0;
      startFullScreenBtn.addEventListener('click', function() {

        enterFullScreen();
        hideModal();
        showQuestion(1);
        startFullScreenBtn.textContent = "Start Exam in full screen";
      });

      function handleFullScreenChange(){
        if(!document.fullscreenElement && 
          !document.mozFullScreenElement && 
          !document.webkitFullscreenElement && 
          !document.msFullscreenElement){
          alert("Warning: Exiting full-screen mode during exam is not allowed!");
          showModal();
          startFullScreenBtn.textContent = "Please Enter into Full screen";
        }
      }

      // Add full-screen change event listeners
      document.addEventListener('fullscreenchange', handleFullScreenChange);
      document.addEventListener('mozfullscreenchange', handleFullScreenChange);
      document.addEventListener('webkitfullscreenchange', handleFullScreenChange);
      document.addEventListener('MSFullscreenChange', handleFullScreenChange);

      // Prevent tab switching
      document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'hidden') {
          showModal();
          if (tabSwitchCount > 2) {
          alert("You have switched tabs more than 2 times. Submitting the exam automatically");
          document.getElementById('form1').submit();
        }
        else{
          showModal();
          startFullScreenBtn.textContent = "Please Enter into Full screen";
        }
          tabSwitchCount++;
        }
      });

      // Disable right-click
      document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
      });

      // Disable keyboard shortcuts
      document.addEventListener('keydown', function(e) {
        if ((e.altKey && e.key === 'Tab') ||
          (e.key === 'Meta') ||
          (e.altKey && e.key === 'F4') ||
          (e.ctrlKey && e.key === 'w')) {
          e.preventDefault();
          showModal();
          startFullScreenBtn.textContent = "Please Enter into Full screen";
        }
      });
    });
  </script>
</body>

</html>