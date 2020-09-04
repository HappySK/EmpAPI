<?php
    class employee
    {
        private $conn=null;

        function __construct()
        {
            try
            {
                $this->conn = new PDO('mysql:host=localhost;dbname=EmployeeDirectory;charset=utf8','root','');
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        function isAlreadyRegistered($data)
        {
            $sql = "SELECT * FROM emp_dir WHERE `email`=?";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute([$data->email]) && $stmt->rowCount()>0)
            {
                return true;
            }
            else
            {
                echo 'False Condition';
                return false;
            }
        }

        function register($data)
        {
            $sql = "INSERT INTO emp_dir(`name`,`email`,`designation`,`hire_date`,`salary`)VALUES(?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute([$data->name,$data->email,$data->desg,$data->date,$data->salary]))
            {
                echo "Query Executed";
            }
        }
    }

    $emp = new employee();
    if(isset($_POST['emp']) && !empty($_POST['emp']))
    {
        $emp_data = json_decode($_POST['emp']);
        if($emp->isAlreadyRegistered($emp_data))
        {
            echo "Employee Already Registered";
        }
        else
        {
            $emp->register($emp_data);
        }
    }
?>