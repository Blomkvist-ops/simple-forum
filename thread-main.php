<html>
    <head>
        <title>Thread-main</title>
    </head>

    <a href = 'forum-main.php'>Forum</a >
    <a href = 'subforum-thread.php'>Subforum</a >
    <a href = 'user-main.php'>User</a >
    <a href = 'thread-main.php'>Thread</a >
    <a href = 'post-main.php'>Post</a >
    <a href = 'admin.php'>Admin</a >
    <a href = 'moderator.php'>Moderator</a >
    <a href = 'favoriteList-main.php'>FavoristList</a >
    <a href = 'tag-main.php'>Tag</a >

    <body>
        <h2>Reset</h2>
        <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

        <form method="POST" action="thread-main.php">
            <!-- if you want another page to load after the button is clicked, you have to specify that page in the action parameter -->
            <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
            <p><input type="submit" value="Reset" name="reset"></p>
        </form>

        <hr />

        <!-- <h2>Insert Values into threadTable</h2> -->
        <h2>Insert a new Thread (Insertion)</h2>
        <form method="POST" action="thread-main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            Thread ID: <input type="text" name="insId"> <br /><br />
            Title: <input type="text" name="insName"> <br /><br />
            User ID: <input type="text" name="insUserID"> <br /><br />
            Sub-forum ID: <input type="text" name="insSubForumID"> <br /><br />

            <input type="submit" value="Insert" name="insertSubmit"></p>
        </form>

        <hr />

        <h2>Delete a thread</h2>
        <form method="POST" action="thread-main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
            Thread ID to delete: <input type="text" name="deleteThreadID"> <br /><br />

            <input type="submit" value="Delete" name="deleteSubmit"></p>
        </form>

        <hr />

        <h2>Search a thread (Selection)</h2>
        <p>You can enter either thread id or title or both</p>
        <form method="POST" action="thread-main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="matchQueryRequest" name="matchQueryRequest">
            Thread ID: <input type="text" name="matchThreadID"> <br /><br />
            Title: <input type="text" name="matchThreadTitle"> <br /><br />

            <input type="submit" value="Search" name="matchSubmit"></p>
        </form>

        <hr />


        <h2>Update Thread Title (Update)</h2>
        <p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>

        <form method="POST" action="thread-main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            Thread id to update: <input type="text" name="threadIdToUpdate"> <br /><br />
            New Title: <input type="text" name="newTitle"> <br /><br />

            <input type="submit" value="Update" name="updateSubmit"></p>
        </form>

        <hr />

        <h2>Project Thread (Projection)</h2>
        <p>You can select an attribute you want to see the projection of threadTable</p>
        
        <form method="POST" action="thread-main.php">
            <input type="hidden" id="projectQueryRequest" name="projectQueryRequest">

            <input type="radio" id="threadID" name="projectWhich" value="ThreadID">
            <label for="threadID">Thread ID</label><br/><br/>
            <input type="radio" id="title" name="projectWhich" value="Title">
            <label for="title">Title</label><br/><br/>
            <input type="radio" id="userID" name="projectWhich" value="UserID">
            <label for="userID">User ID</label><br/><br/>
            <input type="radio" id="subForumID" name="projectWhich" value="SubForumID">
            <label for="subForumID">Subform ID</label><br/><br/>
            <input type="radio" id="postTime" name="projectWhich" value="ThreadPostTime">
            <label for="postTime">Thread Post Time</label><br/><br/>

            <input type="submit" value="Project" name="projectSubmit"></p>

        </form>

        <hr />

        <h2>Find the Thread History of a User (Join)</h2>
        <p>join threadTable and userTable and select the thread history of the given user</p>

        <form method="POST" action="thread-main.php">
            <input type="hidden" id="joinQueryRequest" name="joinQueryRequest">
            User ID to check thread history: <input type="text" name="userToCheck"> <br /><br />
            <input type="submit" value="Search" name="joinSubmit"></p>
        </form>

        <hr />

        <h2>Find the Users Whose threads exceed the given number (Having)</h2>
        <p>find users who have started threads more than the given number</p>

        <form method="POST" action="thread-main.php">
            <input type="hidden" id="havingQueryRequest" name="havingQueryRequest">
            Number of threads: <input type="text" name="threadNum"> <br /><br />
            <input type="submit" value="Search" name="havingSubmit"></p>
        </form>

        <hr />


        <h2>Find users whose user id is larger than the average user id in a thread (Nested Aggregation with Group By)</h2>

        <form method="GET" action="thread-main.php">
            <input type="hidden" id="nestedQueryRequest" name="nestedQueryRequest">
            <input type="submit" value="Find" name="nestedGroupBySubmit"></p>
        </form>

        <hr />

        <h2>Count the number of threads in a given Sub-forum (Aggregation with Group By)</h2>

        <form method="GET" action="thread-main.php">
            <input type="hidden" id="groupByQueryRequest" name="groupByQueryRequest">
            <input type="submit" value="Count" name="groupBySubmit"></p>
        </form>

        <hr />

        <h2>Find users who have started threads in all Sub-forums (Division)</h2>

        <form method="GET" action="thread-main.php">
        <input type="hidden" id="divisionQueryRequest" name="divisionQueryRequest">
            <input type="submit" value="Count" name="divisionBySubmit"></p>
        </form>

        <hr />

        <h2>Count the Tuples in threadTable</h2>
        <form method="GET" action="thread-main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="countTupleRequest" name="countTupleRequest">
            <input type="submit" value="Count" name="countTuples"></p>
        </form>

        <hr />

        <h2>Display the tuples in threadTable</h2>
        <form method="GET" action="thread-main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
            <input type="submit" value="Display" name="displayTuples"></p>
        </form>

        <?php
		//this tells the system that it's no longer just parsing html; it's now parsing PHP

        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
        $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

        function debugAlertMessage($message) {
            global $show_debug_alert_messages;

            if ($show_debug_alert_messages) {
                echo "<script type='text/javascript'>alert('" . $message . "');</script>";
            }
        }

        function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
            //echo "<br>running ".$cmdstr."<br>";
            global $db_conn, $success;

            $statement = OCIParse($db_conn, $cmdstr); 
            //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
                echo htmlentities($e['message']);
                $success = False;
            }

            $r = OCIExecute($statement, OCI_DEFAULT);
            if (!$r) {
                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
                echo htmlentities($e['message']);
                $success = False;
            }

			return $statement;
		}

        function executeBoundSQL($cmdstr, $list) {
            /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection. 
		See the sample code below for how this function is used */

			global $db_conn, $success;
			$statement = OCIParse($db_conn, $cmdstr);

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn);
                echo htmlentities($e['message']);
                $success = False;
            }

            foreach ($list as $tuple) {
                foreach ($tuple as $bind => $val) {
                    //echo $val;
                    //echo "<br>".$bind."<br>";
                    OCIBindByName($statement, $bind, $val);
                    unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
				}

                $r = OCIExecute($statement, OCI_DEFAULT);
                if (!$r) {
                    echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                    $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
                    echo htmlentities($e['message']);
                    echo "<br>";
                    $success = False;
                }
            }
        }

        function printResult($result) { //prints results from a select statement
            echo "<br>Retrieved data from table threadTable:<br>";
            echo "<table>";
            echo "<tr><th>ThreadID</th><th>Title</th><th>UserID</th><th>SubForumID</th><th>ThreadPostTime</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td></tr>"; //or just use "echo $row[0]" 
            }

            echo "</table>";
        }

        function connectToDB() {
            global $db_conn;

            // Your username is ora_(CWL_ID) and the password is a(student number). For example, 
			// ora_platypus is the username and a12345678 is the password.
            $db_conn = OCILogon("ora_aliciale", "a71346266", "dbhost.students.cs.ubc.ca:1522/stu");

            if ($db_conn) {
                debugAlertMessage("Database is Connected");
                return true;
            } else {
                debugAlertMessage("Cannot connect to Database");
                $e = OCI_Error(); // For OCILogon errors pass no handle
                echo htmlentities($e['message']);
                return false;
            }
        }

        function disconnectFromDB() {
            global $db_conn;

            debugAlertMessage("Disconnect from Database");
            OCILogoff($db_conn);
        }

        function handleUpdateRequest() {
            global $db_conn;

            $threadId_To_Update = $_POST['threadIdToUpdate'];
            $new_title = $_POST['newTitle'];

            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("UPDATE threadTable SET title='" . $new_title . "' WHERE threadID='" . $threadId_To_Update . "'");
            OCICommit($db_conn);
        }

        function handleResetRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE threadTable cascade constraints");

            // Create new table
            echo "<br> creating new table <br>";
            executePlainSQL("CREATE TABLE threadTable (threadID int PRIMARY KEY, title char(30), userID int NOT NULL, subForumID int NOT NULL, threadPostTime date, Foreign Key(userID) REFERENCES loginTable(ID) ON DELETE CASCADE, Foreign Key(subForumID) REFERENCES subForumTable(subId) ON DELETE CASCADE)");
            OCICommit($db_conn);
        }

        function handleInsertRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insId'],
                ":bind2" => $_POST['insName'],
                ":bind3" => $_POST['insUserID'],
                ":bind4" => $_POST['insSubForumID'],
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into threadTable values (:bind1, :bind2, :bind3, :bind4, SYSDATE)", $alltuples);
            OCICommit($db_conn);
        }

        function handleMatchRequest() {
            global $db_conn;

            $matchThreadID = $_POST['matchThreadID'];
            $matchThreadTitle = $_POST['matchThreadTitle'];

            if ($matchThreadID != NULL && $matchThreadTitle != NULL) {
                $result = executePlainSQL("SELECT threadID, title, userID, subForumID, threadPostTime FROM threadTable WHERE threadID = '$matchThreadID' AND title='$matchThreadTitle'");
            } else if ($matchThreadID != NULL) {
                $result = executePlainSQL("SELECT threadID, title, userID, subForumID, threadPostTime FROM threadTable WHERE threadID = '$matchThreadID'");
            } else if ($matchThreadTitle != NULL) {
                $result = executePlainSQL("SELECT threadID, title, userID, subForumID, threadPostTime FROM threadTable WHERE title='$matchThreadTitle'");
            }

            printResult($result);
        }

        function handleJoinRequest() {
            global $db_conn;

            $userToCheck = $_POST['userToCheck'];
            if ($userToCheck != NULL) {
                $result = executePlainSQL("SELECT loginTable.uname, threadTable.threadID, threadTable.title, threadTable.threadPostTime FROM threadTable INNER JOIN loginTable ON threadTable.userID = loginTable.id WHERE loginTable.id = '$userToCheck'");
                echo "<br>Retrieved data from table threadTable:<br>";
                echo "<table>";
                echo "<tr><th>UserName</th><th>ThreadID</th><th>ThreadTitle</th><th>ThreadPostTime</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td></tr>";
                }
                echo "</table>";
            }

        }

        function handleProjectRequest() {
            global $db_conn;

            $project = $_POST['projectWhich'];

            if ($project == 'ThreadID') {
                $result = executePlainSQL("SELECT threadID FROM threadTable");

                echo "<br>Retrieved data from table threadTable:<br>";
                echo "<table>";
                echo "<tr><th>ThreadID</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row[0] . "</td></tr>"; //or just use "echo $row[0]" 
                }
                echo "</table>";

            } else if ($project = 'Title') {
                $result = executePlainSQL("SELECT title FROM threadTable");
                
                echo "<br>Retrieved data from table threadTable:<br>";
                echo "<table>";
                echo "<tr><th>Title</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row[0] . "</td></tr>"; //or just use "echo $row[0]" 
                }
                echo "</table>";

            } else if ($project = 'UserID') {
                $result = executePlainSQL("SELECT userID FROM threadTable");

                echo "<br>Retrieved data from table threadTable:<br>";
                echo "<table>";
                echo "<tr><th>UserID</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row[0] . "</td></tr>"; //or just use "echo $row[0]" 
                }
                echo "</table>";

            } else if ($project = 'SubForumID') {
                $result = executePlainSQL("SELECT subForumID FROM threadTable");

                echo "<br>Retrieved data from table threadTable:<br>";
                echo "<table>";
                echo "<tr><th>SubForumID</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row[0] . "</td></tr>"; //or just use "echo $row[0]" 
                }
                echo "</table>";

            } else if ($project = 'ThreadPostTime') {
                $result = executePlainSQL("SELECT threadPostTime FROM threadTable");

                echo "<br>Retrieved data from table threadTable:<br>";
                echo "<table>";
                echo "<tr><th>ThreadPostTime</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row[0] . "</td></tr>"; //or just use "echo $row[0]" 
                }
                echo "</table>";
            }
        }

        function handleHavingRequest() {
            global $db_conn;

            $threadNum = $_POST['threadNum'];
            $result = executePlainSQL("SELECT threadTable.userID, COUNT(*) FROM threadTable GROUP BY threadTable.userID HAVING COUNT(threadTable.threadID) > $threadNum");

            
            echo "<br>Retrieved data from table threadTable:<br>";
            echo "<table>";
            echo "<tr><th>UserID</th><th>Count</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>";
            }
            echo "</table>";
        

        }

        function handleDeleteRequest() {
            global $db_conn;

            $deleteThreadID = $_POST['deleteThreadID'];
            $result = executePlainSQL("SELECT * FROM threadTable WHERE threadID = '$deleteThreadID' ");
            if (($row = oci_fetch_row($result)) != false) {
                executePlainSQL("DELETE FROM threadTable WHERE threadID = '$deleteThreadID' ");
                echo 'delete thread successfully';
                OCICommit($db_conn);
            } else {
                echo "thread doesn't exist";
            }

        }

        function handleNestedTuplesRequest() {
            global $db_conn;
            $result = executePlainSQL("SELECT threadTable.userID FROM threadTable WHERE threadTable.userID > ALL (SELECT AVG(postTable.userID) FROM postTable GROUP BY postTable.threadID)") ;

            echo "<br>Retrieved data from table threadTable:<br>";
            echo "<table>";
            echo "<tr><th>UserID</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td></tr>";
            }
            echo "</table>";
        

        }

        function handleCountRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM threadTable");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br> The number of tuples in threadTable: " . $row[0] . "<br>";
            }
        }

        function handleDisplayTuplesRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT threadID, title, userID, subForumID, threadPostTime FROM threadTable");

            printResult($result);
        }

        function handleGroupByTuplesRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT count(threadID), subForumID  FROM threadTable GROUP BY subForumID");

            echo "<br>Retrieved data from table threadTable:<br>";
                echo "<table>";
                echo "<tr><th>ThreadCount</th><th>SubForumID</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>";  
                }
                echo "</table>";
        }

        function handleDivisionTuplesRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT id, uname FROM loginTable L WHERE NOT EXISTS((SELECT A.subID FROM subForumTable A) MINUS (SELECT B.subForumID FROM threadTable B WHERE B.userID = L.id))");
            echo "<br>Retrieved data from table threadTable:<br>";
                echo "<table>";
                echo "<tr><th>UserID</th><th>UserName</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>";  
                }
                echo "</table>";
        }

        // HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
                    handleUpdateRequest();
                } else if (array_key_exists('insertQueryRequest', $_POST)) {
                    handleInsertRequest();
                } else if (array_key_exists('matchQueryRequest', $_POST)) {
                    handleMatchRequest();
                } else if (array_key_exists('projectQueryRequest', $_POST)) {
                    handleProjectRequest();
                } else if (array_key_exists('joinQueryRequest', $_POST)) {
                    handleJoinRequest();
                } else if (array_key_exists('havingQueryRequest', $_POST)) {
                    handleHavingRequest();
                } else if (array_key_exists('deleteQueryRequest', $_POST)) {
                    handleDeleteRequest();
                } 

                disconnectFromDB();
            }
        }



        // HANDLE ALL GET ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('countTuples', $_GET)) {
                    handleCountRequest();
                }

                disconnectFromDB();
            }
        }

        // HANDLE DISPLAY
        function handleDisplayRequest() {
            if (connectToDB()) {
                if (array_key_exists('displayTupleRequest', $_GET)) {
                    handleDisplayTuplesRequest();
                }

                disconnectFromDB();
            }
        }

        function handleGroupByRequest() {
            if (connectToDB()) {
                if (array_key_exists('groupBySubmit', $_GET)) {
                    handleGroupByTuplesRequest();
                }

                disconnectFromDB();
            }
        }

        function handleNestedRequest() {
            if (connectToDB()) {
                if (array_key_exists('nestedGroupBySubmit', $_GET)) {
                    handleNestedTuplesRequest();
                }

                disconnectFromDB();
            }
        }

        function handleDivisionRequest() {
            if (connectToDB()) {
                if (array_key_exists('divisionBySubmit', $_GET)) {
                    handleDivisionTuplesRequest();
                }

                disconnectFromDB();
            }
        }

		if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['matchSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['projectSubmit']) || isset($_POST['joinSubmit']) || isset($_POST['havingSubmit']) || isset($_POST['deleteSubmit'])) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest'])) {
            handleGETRequest();
        } else if (isset($_GET['displayTupleRequest'])) {
            handleDisplayRequest();
        } else if (isset($_GET['groupByQueryRequest'])) {
            handleGroupByRequest();
        } else if (isset($_GET['divisionQueryRequest'])) {
            handleDivisionRequest();
        } else if (isset($_GET['nestedQueryRequest'])) {
            handleNestedRequest();
        }
		?>
	</body>
</html>