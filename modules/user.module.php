<?
class UserModule {

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

    function getUser($id = null) {
        $query = 'SELECT * from users ';
        if ($id != null) {
            $query .= " where id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array('id' => $id));
            // $sql->execute(array('id' => $id));
        } else {
            $query .= 'order by id desc';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
        }
        return $stmt->fetchAll();
    }

    function addUser($params) {
        $query = "insert into users
            (
                login, 
                password, 
                email, 
                phone, 
                regDate, 
                name,
                surname,
                fathername,
                photo, 
                description
            ) 
            values
                (
                    :login, 
                    :password, 
                    :email, 
                    :phone, 
                    :regDate, 
                    :name,
                    :surname,
                    :fathername,
                    :photo, 
                    :description
                )";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(
            array(
                'login' => $params['login'], 
                'password' => $params['password'], 
                'email' => $params['email'], 
                'phone' => $params['phone'], 
                'regDate' => $params['regDate'], 
                'name' => $params['name'],
                'surname' => $params['surname'],
                'fathername' => $params['fathername'],
                'photo' => $params['photo'], 
                'description' => $params['description']
            )
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}