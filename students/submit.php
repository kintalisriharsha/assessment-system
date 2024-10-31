<?php
session_start();
if (!isset($_POST["exid"])) {
    header("Location: dash.php");
}

include '../config.php';
$j = 0;
if (isset($_POST["exid"])) {
    $nq = mysqli_real_escape_string($conn, $_POST["nq"]);
    $exid = mysqli_real_escape_string($conn, $_POST["exid"]);
    $uname = mysqli_real_escape_string($conn, $_SESSION["uname"]);

    for ($i = 1; $i <= $nq; $i++) {
        $qid = mysqli_real_escape_string($conn, $_POST['qid' . $i]);
        $submitted_answer = isset($_POST['o' . $i]) ? $_POST['o' . $i] : null;

        $sql = "SELECT * FROM qstn_list WHERE exid='$exid' AND qid='$qid'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $correct_answer = $row['qstn_ans'];
            $qstn_type = $row['qstn_type'];

            if ($qstn_type == 'multiple_choice') {
                // Handle multiple choice questions
                if (is_array($submitted_answer)) {
                    // Sort both arrays to ensure consistent comparison
                    $submitted_answers = array_map('trim', $submitted_answer);
                    sort($submitted_answers);
                    
                    $correct_answers = array_map('trim', explode(',', $correct_answer));
                    sort($correct_answers);

                    // Convert to strings for comparison
                    $submitted_string = implode(',', $submitted_answers);
                    $correct_string = implode(',', $correct_answers);

                    if ($submitted_string === $correct_string) {
                        $j++;
                    }
                }
            } else if ($qstn_type == 'single_choice') {
                // Handle single choice questions
                if ($correct_answer == $submitted_answer) {
                    $j++;
                }
            }
        } else {
            error_log("No result found for Question ID: $qid");
        }
    }

    // Calculate percentage and store results
    $ptg = ($j / $nq) * 100;
    $st = 1;
    
    $sql = "INSERT INTO atmpt_list (exid, uname, nq, cnq, ptg, status) 
            VALUES ('$exid', '$uname', '$nq', '$j', '$ptg', '$st')";
    $result = mysqli_query($conn, $sql);
    
    header("Location: results.php");
}
?>