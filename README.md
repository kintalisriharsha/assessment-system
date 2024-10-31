<h1> Assessment Platform</h1>
<br>
<h3>student</h3>
<br>
<span>1 . Messages </span>
<br>
<span>2 . Exams</span>
<br>
<span>3. Results</span>
<br>
<span>4 . Help</span>
<br>
<h3>Teacher</h3>
<br>
<span>1 . Send messages </span>
<br>
<span>2 . Add Exams</span>
<br>
<span>3. View Results</span>
<br>
<span>4 . Manage Students</span>
<br>
<span>4 . Help</span>
<br>
<h3>Admin</h3>
<br>
<span>Logs</span>
<br>
<span>Previlages</span>

<h2>Running the Project with XAMPP</h2>

<h3>Prerequisites</h3>
<ul>
    <li><a href="https://www.apachefriends.org/index.html">XAMPP</a> installed on your machine.</li>
</ul>

<h3>Steps to Run the Project</h3>
<ol>
    <li>
        <strong>Start XAMPP:</strong>
         <ul>
            <li>Open XAMPP Control Panel.</li>
            <li>Start the <code>Apache</code> and <code>MySQL</code> modules.</li>
        </ul>
    </li>
    <li>
        <strong>Clone the Repository:</strong>
        <ul>
            <li>Clone this repository to your local machine.</li>
        </ul>
    </li>
    <li>
        <strong>Move Project to XAMPP Directory:</strong>
        <ul>
            <li>Copy the project folder to the <code>htdocs</code> directory inside your XAMPP installation directory (e.g., <code>C:\xampp\htdocs\your_project</code>).</li>
        </ul>
    </li>
    <li>
        <strong>Create the Database:</strong>
        <ul>
            <li>Open your web browser and go to <a href="http://localhost/phpmyadmin">http://localhost/phpmyadmin</a>.</li>
            <li>Click on the <code>Databases</code> tab.</li>
            <li>Create a new database (e.g., <code>examportal</code>).</li>
        </ul>
    </li>
    <li>
        <strong>Import the Database:</strong>
        <ul>
            <li>Select the newly created database.</li>
            <li>Click on the <code>Import</code> tab.</li>
            <li>Click on <code>Choose File</code> and select the <code>db/db_eval.sql</code> file from the project directory.</li>
            <li>Click <code>Go</code> to import the database schema and data.</li>
        </ul>
    </li>
    <li>
        <strong>Configure the Project:</strong>
        <ul>
            <li>Open the <code>config.php</code> file in the project directory.</li>
            <li>Update the database configuration settings if necessary (e.g., database name, username, password).</li>
        </ul>
    </li>
     <li>
        <strong>Access the Project:</strong>
        <ul>
            <li>Open your web browser and go to <a href="http://localhost/your_project">http://localhost/your_project</a>.</li>
        </ul>
    </li>
</ol>

<h3>Additional Notes</h3>
<ul>
    <li>Ensure that the <code>config.php</code> file has the correct database credentials.</li>
    <li>If you encounter any issues, check the XAMPP Control Panel for error messages and ensure that the <code>Apache</code> and <code>MySQL</code> services are running.</li>
</ul>
