<?
class CourseModule {
    private $pdo;
    
    function __construct()
    {
        $this->initDb();
    }

    function initDb()
    {
        include 'db.php';
        $pdo = new PDO($_dsn, $_user, $_pass, $_opt);
        $this->pdo = $pdo;
    }
}