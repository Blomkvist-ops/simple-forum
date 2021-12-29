  <html>
    <head>
        <title>User-main-page</title>
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

        <form method="POST" action="user-main.php">
            <!-- if you want another page to load after the button is clicked, you have to specify that page in the action parameter -->
            <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
            <p><input type="submit" value="Reset" name="reset"></p>
        </form>

        <hr />

        <!-- <h2>Insert Values into loginTable</h2> -->
        <h2>Insert a new user</h2>
        <form method="POST" action="user-main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            User ID: <input type="text" name="insId"> <br /><br />
            Name: <input type="text" name="insName"> <br /><br />

            <input type="submit" value="Create" name="insertSubmit"></p>
        </form>

        <hr />

        <h2>Search a user</h2>
        <p>You don't need to input both user id and user name</p>
        <form method="POST" action="user-main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="matchQueryRequest" name="matchQueryRequest">
            User ID: <input type="text" name="loginId"> <br /><br />
            Name: <input type="text" name="loginName"> <br /><br />
            <input type="submit" value="Login" name="matchSubmit"></p>
        </form>

        <hr />

        <h2>Delete a user</h2>
        <form method="POST" action="user-main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
            User ID: <input type="text" name="deleteId"> <br /><br />
            <input type="submit" value="Delete" name="deleteSubmit"></p>
        </form>

        <hr />


        <h2>Update User Name</h2>
        <p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>

        <form method="POST" action="user-main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            User id: <input type="text" name="userId-old"> <br /><br />
            New Name: <input type="text" name="newName"> <br /><br />

            <input type="submit" value="Update" name="updateSubmit"></p>
        </form>

        <hr />


        <h2>Count the Tuples in loginTable</h2>
        <form method="GET" action="user-main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="countTupleRequest" name="countTupleRequest">
            <input type="submit" value="Submit Query" name="countTuples"></p>
        </form>

        <h2>Display the tuples in loginTable</h2>
        <form method="GET" action="user-main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
            <input type="submit" value="Submit Query" name="displayTuples"></p>
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
            echo "<br>Retrieved data from table loginTable:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["UNAME"] . "</td></tr>"; //or just use "echo $row[0]" 
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

            $old_id = $_POST['userId-old'];
            $new_name = $_POST['newName'];

            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("UPDATE loginTable SET uname='" . $new_name . "' WHERE id='" . $old_id . "'");
            OCICommit($db_conn);
        }

        function handleResetRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE loginTable cascade constraints");

            // Create new table
            echo "<br> creating new table <br>";
            executePlainSQL("CREATE TABLE loginTable (id int PRIMARY KEY, uname char(30))");
            OCICommit($db_conn);
        }

        function handleInsertRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insId'],
                ":bind2" => $_POST['insName']
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into loginTable values (:bind1, :bind2)", $alltuples);
            OCICommit($db_conn);
        }

        function handleMatchRequest() {
            global $db_conn;


            $loginID = $_POST['loginId'];
            $loginName = $_POST['loginName'];

            if ($loginID != NULL && $loginName != NULL) {
                $result = executePlainSQL("SELECT id,uname FROM loginTable WHERE id = '$loginID' AND uname='$loginName'");            
            } else if ($loginID != NULL) {
                $result = executePlainSQL("SELECT id,uname FROM loginTable WHERE id = '$loginID' "); 
            } else if ($loginName != NULL) {
                $result = executePlainSQL("SELECT id,uname FROM loginTable WHERE uname='$loginName'"); 
            }
            printResult($result);                            
        
        }

        function handleDeleteRequest() {
            global $db_conn;


            $deleteId = $_POST['deleteId'];

            $result = executePlainSQL("SELECT * FROM loginTable WHERE id = '$deleteId' ");
            if (($row = oci_fetch_row($result)) != false) {
                executePlainSQL("DELETE FROM loginTable  WHERE id = '$deleteId' ");
                echo 'delete thread successfully';
                OCICommit($db_conn);
            } else {
                echo "thread doesn't exist";
            }                       
        
        }

        function handleCountRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM loginTable");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br> The number of tuples in loginTable: " . $row[0] . "<br>";
            }
        }

        function handleDisplayTuplesRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT ID, uname FROM loginTable");

            printResult($result);
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

		if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['matchSubmit']) || isset($_POST['deleteSubmit']) || isset($_POST['insertSubmit'])) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest'])) {
            handleGETRequest();
        } else if (isset($_GET['displayTupleRequest'])) {
            handleDisplayRequest();
        }
		?>
	</body>
</html>

