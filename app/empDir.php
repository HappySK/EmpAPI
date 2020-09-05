<?php
    class employee
    {
        private $conn=null;

        function __construct()
        {
            try
            {
                $this->conn = new PDO('mysql:host=localhost;dbname=EmployeeDirectory;charset=utf8','root','Zerozam@Zam23');
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
                return false;
            }
        }

        function register($data)
        {
            $sql = "INSERT INTO emp_dir(`name`,`email`,`designation`,`hire_date`,`salary`)VALUES(?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute([$data->name,$data->email,$data->desg,$data->date,$data->salary]))
            {
                echo "Employee created successfully";
            }
        }

        function getEmployeeDetails()
        {
            $sql = "SELECT * FROM emp_dir";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute() && $stmt->rowCount()>0)
            {
                $data=array();
                while($row=$stmt->fetchObject())
                {
                    $record[0]=$row->id;
                    $record[1]=$row->name;
                    $record[2]=$row->email;
                    $record[3]=$row->designation;
                    $record[4]=$row->hire_date;
                    $record[5]=$row->salary;
                    array_push($data,$record);
                }
                return json_encode($data);
            }
            else
            {
                return "Query Wont get executed";
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

    if(isset($_GET['action']) && !empty($_GET['action']))
    {
        echo $emp->getEmployeeDetails();
    }
?>