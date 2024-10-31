<?php
// Add these constants to your config.php
define('JDOODLE_CLIENT_ID', 'f776b2d450e4824ec07e790990b1d66b'); // Replace with your JDoodle client ID
define('JDOODLE_CLIENT_SECRET', '4623f39a5aaedb3300baf5df2901f6eb672105fd220c617ba5f6521c37801bd5'); // Replace with your JDoodle client secret
define('JDOODLE_API_URL', 'https://api.jdoodle.com/v1/execute');

// Function to execute code via JDoodle API
function executeCode($language, $code, $stdin = "") {
    $data = array(
        'clientId' => JDOODLE_CLIENT_ID,
        'clientSecret' => JDOODLE_CLIENT_SECRET,
        'script' => $code,
        'stdin' => $stdin,
        'language' => $language,
        'versionIndex' => "0"
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents(JDOODLE_API_URL, false, $context);
    
    return json_decode($result, true);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Terminal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="css/terminal_styles.css">
</head>
<body>
    <!-- Add this to your examportal.php inside the question-container div where you want the terminal -->
<div class="terminal-container">
    <div class="terminal-header">
        <select id="languageSelect" class="language-select">
            <option value="java">Java</option>
            <option value="python3">Python 3</option>
            <option value="cpp">C++</option>
            <option value="c">C</option>
            <option value="nodejs">JavaScript</option>
        </select>
        <button id="runCode" class="run-btn">Run Code</button>
    </div>
    <div class="editor-container">
        <div id="editor"></div>
    </div>
    <div class="terminal-output">
        <div class="input-section">
            <label for="stdin">Input:</label>
            <textarea id="stdin" placeholder="Enter input here..."></textarea>
        </div>
        <div class="output-section">
            <label>Output:</label>
            <pre id="output"></pre>
        </div>
    </div>
</div>

<!-- Add these scripts to your head section -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
<script>
    // Initialize ACE editor
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/python");
    editor.setFontSize(14);

    // Handle language change
    document.getElementById('languageSelect').addEventListener('change', function(e) {
        const lang = e.target.value;
        const modeMap = {
            'java': 'java',
            'python3': 'python',
            'cpp': 'c_cpp',
            'c': 'c_cpp',
            'nodejs': 'javascript'
        };
        editor.session.setMode(`ace/mode/${modeMap[lang]}`);
    });

    // Handle code execution
    document.getElementById('runCode').addEventListener('click', async function() {
        const runBtn = this;
        const output = document.getElementById('output');
        
        runBtn.disabled = true;
        runBtn.textContent = 'Running...';
        output.textContent = 'Executing code...';

        try {
            const response = await fetch('execute_code.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    language: document.getElementById('languageSelect').value,
                    code: editor.getValue(),
                    stdin: document.getElementById('stdin').value
                })
            });

            const result = await response.json();
            
            if (result.error) {
                output.textContent = `Error: ${result.error}`;
                output.classList.add('error');
            } else {
                output.textContent = result.output;
                output.classList.remove('error');
            }
        } catch (error) {
            output.textContent = `Error: ${error.message}`;
            output.classList.add('error');
        } finally {
            runBtn.disabled = false;
            runBtn.textContent = 'Run Code';
        }
    });
</script>
</body>