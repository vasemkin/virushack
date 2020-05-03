<?
class CourseModule
{
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

    function getCourses($params = [])
    {
        if (sizeof($params) == 0) {
            $query = 'select * from courses';
        } else {
            $cat = '';
            $sph = '';
            $query = 'SELECT courses.*, 
            categories.id AS categoryId, categories.name AS categoryName,
            spheres.NAME AS spereName
            FROM courses
            LEFT JOIN spheres ON spheres.id = courses.sphere
            LEFT JOIN course_has_categories ON course_has_categories.course = courses.id
            LEFT JOIN categories ON categories.id = course_has_categories.category';
            if (isset($params['categories']) && isset($params['spheres'])) {
                $sph = implode(', ', $params['spheres']);
                $cat = implode(', ', $params['categories']);
                $query .= " WHERE categories.id IN ($cat) AND spheres.id IN ($sph)";
            }
            else if (isset($params['categories'])) {
                $cat = implode(', ', $params['categories']);
                $query .= " WHERE categories.id IN ($cat)";
            }
            else {
                $sph = implode(', ', $params['spheres']);
                $query .= " WHERE spheres.id IN ($sph)";
            }
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function categorySort($params)
    {
    }
}
