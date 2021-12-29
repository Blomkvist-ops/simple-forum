<html>
    <head>
        <title>Subforum-Thread</title>
    </head>

    <a href = 'forum-main.php'>Forum</a>
    <a href = 'subforum-thread.php'>Subforum</a>
    <a href = 'user-main.php'>User</a>
    <a href = 'thread-main.php'>Thread</a>
    <a href = 'post-main.php'>Post</a>
    <a href = 'admin.php'>Admin</a>
    <a href = 'moderator.php'>Moderator</a>
    <a href = 'favoriteList-main.php'>FavoristList</a>
    <a href = 'tag-main.php'>Tag</a>

    <body>
        <h2>Reset</h2>
        <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

        <form method="POST" action="subforum-thread.php">
            <!-- if you want another page to load after the button is clicked, you have to specify that page in the action parameter -->
            <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
            <p><input type="submit" value="Reset" name="reset"></p>
        </form>

        <hr />



        <!-- <h2>Insert Values into subForumTable</h2> -->
        <h2>Create a New Subforum </h2>

        <form method="POST" action="subforum-thread.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            Subforum ID: <input type="text" name="insId"> <br /><br />
            Subforum Name: <input type="text" name="insName"> <br /><br />
            Subforum Topic: <input type="text" name="insTopic"> <br /><br />
            Parent Domain: <input type="text" name="insDomain"> <br /><br />
            <input type="submit" value="Create" name="insertSubmit"></p>



        </form>

        <hr />


        <h2>Search a Subforum</h2>
        <p>You don't need to input both subforum id and subforum name</p>
        <form method="POST" action="subforum-thread.php"> <!--refresh page when submitted-->
            <input type="hidden" id="matchQueryRequest" name="matchQueryRequest">
            Subforum ID: <input type="text" name="matchSubId"> <br /><br />
            Subforum Name: <input type="text" name="matchSubName"> <br /><br />
            <input type="submit" value="Search" name="matchSubmit"></p>
        </form>

        <hr />
        
        <h2>Delete a Subforum</h2>
        <form method="POST" action="subforum-thread.php"> <!--refresh page when submitted-->
            <input type="hidden" id="delQueryRequest" name="delQueryRequest">
            Subforum ID: <input type="text" name="delSubId"> <br /><br />
            <input type="submit" value="Delete" name="delSubmit"></p>
        </form>

        <hr />



        <h2>Count the Tuples in subForumTable</h2>
        <form method="GET" action="subforum-thread.php"> <!--refresh page when submitted-->
            <input type="hidden" id="countTupleRequest" name="countTupleRequest">
            <input type="submit" value="Count" name="countTuples"></p>
        </form>

        <h2>Display the tuples in subForumTable</h2>
        <form method="GET" action="subforum-thread.php"> <!--refresh page when submitted-->
            <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
            <input type="submit" value="Display" name="displayTuples"></p>
        </form>

        <?php
		//this tells the system that it's no longer just parsing html; it's now parsing PHP

        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
        $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())
        $m1 = $_GET['matchDomain'];


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
            echo "<br>Retrieved data from table subForumTable:<br>";
            echo "<table>";
            echo "<tr><th>SubforumID</th><th>SubforumName</th><th>SubforumTopic</th><th>ForumDomain</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                // echo "<tr><td>" . $row["domainAddr"] . "</td><td>" . $row["fname"] . "</td></tr>"; //or just use "echo $row[0]" 
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td></tr>";
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



        function handleResetRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE subForumTable cascade constraints");

            // Create new table
            echo "<br> creating new table <br>";
            executePlainSQL("CREATE TABLE subForumTable (subId int PRIMARY KEY, subName char(30), subTopic char(30), subDomain char(30), Foreign Key (subDomain) REFERENCES forumTable(domainAddr) ON DELETE CASCADE)");
            OCICommit($db_conn);
        }

        function handleInsertRequest() {
            global $db_conn;
            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insId'],
                ":bind2" => $_POST['insName'],
                ":bind3" => $_POST['insTopic'],               
                ":bind4" => $_POST['insDomain']
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into subForumTable values (:bind1, :bind2, :bind3, :bind4)", $alltuples);
            OCICommit($db_conn);
        }

        function handleMatchRequest() {
            global $db_conn;


            $matchSubId = $_POST['matchSubId'];
            $matchSubName = $_POST['matchSubName'];

            if ($matchSubId != NULL && $matchSubName != NULL) {
                $result = executePlainSQL("SELECT subId, subName, subTopic, subDomain FROM subForumTable WHERE subId = '$matchSubId' AND subName = '$matchSubName' ");
            } else if ($matchSubId != NULL) {
                $result = executePlainSQL("SELECT subId, subName, subTopic, subDomain FROM subForumTable WHERE subId = '$matchSubId' ");
            } else if ($matchSubName != NULL) {
                $result = executePlainSQL("SELECT subId, subName, subTopic, subDomain FROM subForumTable WHERE subname = '$matchSubName' ");
            }

            printResult($result);
                
        
        }

        function handleDelRequest() {
            global $db_conn;

            $delSubId = $_POST['delSubId'];
            $result = executePlainSQL("SELECT * FROM subForumTable WHERE subId = '$delSubId' ");
            if (($row = oci_fetch_row($result)) != false) {
                executePlainSQL("DELETE FROM subForumTable WHERE subId = '$delSubId'");
                echo 'delete subforum successfully';
                OCICommit($db_conn);
            } else {
                echo "subforum doesn't exist";
            }
        }

        function handleCountRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM subForumTable");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br> The number of tuples in subForumTable: " . $row[0] . "<br>";
            }
        }



        function handleDisplayTuplesRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT subId, subName, subTopic, subDomain FROM subForumTable");

            printResult($result);
        }

        // HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('insertQueryRequest', $_POST)) {
                    handleInsertRequest();
                } else if (array_key_exists('matchQueryRequest', $_POST)) {
                    handleMatchRequest();
                } else if (array_key_exists('delQueryRequest', $_POST)) {
                    handleDelRequest();
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

		if (isset($_POST['reset']) || isset($_POST['matchSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['delSubmit'])) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest'])) {
            handleGETRequest();
        } else if (isset($_GET['displayTupleRequest'])) {
            handleDisplayRequest();
        }
		?>
	</body>
</html>

