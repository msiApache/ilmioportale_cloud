<?php


namespace Ilmioportale\Mapper;


use DateTime;
use Exception;
use Ilmioportale\Absctracts\Connection;
use PDO;
use PDOException;

class UsersMapper extends Connection
{
    /**
     * @var PDO
     */
    private $conn;

    private const SELECT = ' SELECT * FROM users ';
    private const SELECT_LOGIN = ' SELECT id, username, password FROM users WHERE username = ? ';
    private const FIND = ' SELECT * FROM users where id = :id ';
    private const INSERT = ' INSERT INTO users (username, password) VALUES (:username, :password)';
    private const UPDATE = ' UPDATE users SET username = :username, password = :password WHERE id = :id ';
    private const DELETE = ' DELETE FROM users WHERE id = :id ';

    /**
     * UsersMapper constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->conn = parent::__construct($config);
    }

    /**
     * @return array|bool
     */
    public function fetchAll()
    {
        try {
            $stmt = $this->conn->prepare(self::SELECT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function find($id)
    {
        try {
            $stmt = $this->conn->prepare(self::FIND);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function insert($username, $password)
    {
        try {
            $stmt = $this->conn->prepare(self::INSERT);
            $stmt->bindParam(':username', $username);
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $stmt->bindParam(':password', $param_password);
            $stmt->execute();
            /*echo "New records created successfully";*/
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @param $username
     * @param $password
     * @param $id
     * @return bool
     */
    public function update($username, $password, $id)
    {
        try {
            $stmt = $this->conn->prepare(self::UPDATE);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            /*echo "New records created successfully";*/
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        try {
            $stmt = $this->conn->prepare(self::DELETE);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            /*echo "Records delete successfully";*/
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @return array|bool
     */
    public function fetchAllView()
    {
        try {
            $stmt = $this->conn->prepare(self::SELECT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rows = [];
            echo "<div class='container-fluid' style='padding-top: 50px'>";
            echo "<table class=\"table table-striped\" style='background: #fff'>";
            echo "<tr>";
            echo "<th>ID ACCOUNT</th>";
            echo "<th>USERNAME</th>";
            echo "<th>PASSWORD</th>";
            echo "<th>DATA CREAZIONE ACCOUNT</th>";
            echo "</tr>";
            foreach ($result as $row) {
                $format = 'd-m-Y';
                $rowCreated_at = $row['created_at'];
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $this->dateFormatCreated_at($rowCreated_at, $format) . "</td>";
                echo "</tr>";
                echo "</div>";
                $rows[] = $row;
            }
            return $rows;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    public function findView($id)
    {
        try {
            $stmt = $this->conn->prepare(self::FIND);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rows = [];
            echo "<div class='container-fluid' style='padding-top: 50px'>";
            echo "<table class=\"table table-striped\" style='background: #fff'>";
            echo "<tr>";
            echo "<th>ID ACCOUNT</th>";
            echo "<th>USERNAME</th>";
            echo "<th>PASSWORD</th>";
            echo "<th>DATA CREAZIONE ACCOUNT</th>";
            echo "</tr>";
            foreach ($result as $row) {
                $format = 'd-m-Y';
                $rowCreated_at = $row['created_at'];
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $this->dateFormatCreated_at($rowCreated_at, $format) . "</td>";
                echo "</tr>";
                echo "</div>";
                $rows[] = $row;
            }
            return $rows;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    private function dateFormatCreated_at($rowCreated_at, $format)
    {
        try {
            $created_at = new DateTime($rowCreated_at);
            $created_at = date_format($created_at, $format);
            return $created_at;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    public function login() {

        $conn = $this->getConnMysqli();

// Define variables and initialize with empty values
        $username = $password = "";
        $username_err = $password_err = "";

// Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Check if username is empty
            if (empty(trim($_POST["username"]))) {
                $username_err = "Please enter username.";
            } else {
                $username = trim($_POST["username"]);
            }

            // Check if password is empty
            if (empty(trim($_POST["password"]))) {
                $password_err = "Please enter your password.";
            } else {
                $password = trim($_POST["password"]);
            }

            // Validate credentials
            if (empty($username_err) && empty($password_err)) {
                // Prepare a select statement
                $sql = self::SELECT_LOGIN;

                if ($stmt = mysqli_prepare($conn, $sql)) {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);

                    // Set parameters
                    $param_username = $username;

                    // Attempt to execute the prepared statement
                    if (mysqli_stmt_execute($stmt)) {
                        // Store result
                        mysqli_stmt_store_result($stmt);

                        // Check if username exists, if yes then verify password
                        if (mysqli_stmt_num_rows($stmt) == 1) {
                            // Bind result variables
                            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                            if (mysqli_stmt_fetch($stmt)) {
                                if (password_verify($password, $hashed_password)) {
                                    // Password is correct, so start a new session
                                    session_start();

                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;
                                        header("location: index.php");
                                } else {
                                    // Display an error message if password is not valid
                                    $password_err = "The password you entered was not valid.";
                                }
                            }
                        } else {
                            // Display an error message if username doesn't exist
                            $username_err = "No account found with that username.";
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }

            // Close connection
            mysqli_close($conn);
        }
    }

}