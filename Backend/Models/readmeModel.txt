This folder is for the database that holds files that define the data models or DATABASE SChEMA used in the backend. 
It includes entities or classes that represent the structure and behavior of the data.

sa dali nga pagkasulti kini siya mao ang folder sa mga database.

PDO Atong gigamit kay OOP oriented ni siya which is pwede siya tawgon tawgon balik nga gamit ra ang function name.
PDO stands for PHP Data Object

$this->host = "localhost"; -> Is the name of our host, the localhost.
$this->user = "root"; -> Root is the default name of the user.
$this->pass = ""; -> Since we have no password in out database or the XAMPP, this leaves a blank.
$this->dbms = "upholster"; -> The name of our database folder.
$this->stat = false; -> The status is false is not connected and will be connected soon after.
$this->conn = $this->init(); -> This conn is to get to know if our database is connected or not.


public function getStat(){
    return $this->stat;
} -> This public function getStat only return the stat from above which is False.


public function getCon(){
    return $this->conn;
} -> This public function getCon only return the conn from above which is the $this->init();


public function closeCon(){
    $this->conn = null;
} -> This public function closeCon will only set the conn above from $this->init(); to null means empty.


private function init()
{
    try {
        $conn = new PDO("mysql:host=$this->host;dbname=" . $this->dbms, $this->user, $this->pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->stat = true;
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
} -> This private function init will determine or configure our database which is call PDO MYSQL. Then is our database is 
        connected then the stat above will be replace from false into true which mean connnected. and catch if not.