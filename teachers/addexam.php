<?php 
include('../config.php');

//Below code to add exam details

if (isset($_POST["addexm"])) {
    $exname = mysqli_real_escape_string($conn, $_POST["exname"]);
    $nq = mysqli_real_escape_string($conn, $_POST["nq"]);
    $desp = mysqli_real_escape_string($conn, $_POST["desp"]);
    $subt = mysqli_real_escape_string($conn, $_POST["subt"]);
    $extime = mysqli_real_escape_string($conn, $_POST["extime"]);
    $subject = mysqli_real_escape_string($conn, $_POST["subject"]);

      $sql = "INSERT INTO exm_list (exname, nq, desp, subt, extime, subject) VALUES ('$exname', '$nq', '$desp', '$subt', '$extime', '$subject')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
          header("Location: exams.php");
      } else {
        echo "<script>alert('Adding exam failed.');</script>";
        header("Location: exams.php");
    }
    }

// ********************************************

//Below code to add question to database

if (isset($_POST["addqp"])) {
    $nq = mysqli_real_escape_string($conn, $_POST["nq"]);
    $exid = mysqli_real_escape_string($conn, $_POST["exid"]);
    for ($i = 1; $i <= $nq; $i++) {
        $q = mysqli_real_escape_string($conn, $_POST['q' . $i]);
        $qstn_type = isset($_POST['qstn_type' . $i]) ? mysqli_real_escape_string($conn, $_POST['qstn_type' . $i]) : null;
        $a = mysqli_real_escape_string($conn, $_POST['a' . $i]);

        // Initialize options to null
        $o1 = $o2 = $o3 = $o4 = null;

        // Check if options are set and assign them
        if (isset($_POST['o1' . $i])) {
            $o1 = mysqli_real_escape_string($conn, $_POST['o1' . $i]);
        }
        if (isset($_POST['o2' . $i])) {
            $o2 = mysqli_real_escape_string($conn, $_POST['o2' . $i]);
        }
        if (isset($_POST['o3' . $i])) {
            $o3 = mysqli_real_escape_string($conn, $_POST['o3' . $i]);
        }
        if (isset($_POST['o4' . $i])) {
            $o4 = mysqli_real_escape_string($conn, $_POST['o4' . $i]);
        }

        // Handle multiple-choice questions
        if ($qstn_type === 'multiple_choice') {
            $a = implode(',', array_map('mysqli_real_escape_string', array_fill(0, count(explode(',', $a)), $conn), explode(',', $a)));
        }

        $sql = "INSERT INTO qstn_list (exid, qstn, qstn_o1, qstn_o2, qstn_o3, qstn_o4, qstn_ans, sno, qstn_type) 
                VALUES ('$exid', '$q', '$o1', '$o2', '$o3', '$o4', '$a', '$i', '$qstn_type')";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo "<script>alert('Updating questions failed for question $i.');</script>";
            header("Location: exams.php");
            exit();
        }
    }
      if ($result) {
          header("Location: exams.php");
      } else {
        echo "<script>alert('Updating questions failed.');</script>";
        header("Location: exams.php");
    }
    }

// ********************************************



?>