<?

class TestModule
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

    function addTest($params)
    {
        $query = "insert into tests(name, description, date, author, time) values(:name, :description, :date, :author, :time)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array(
            'name' => $params['name'],
            'description' => $params['description'],
            'date' => $params['date'],
            'author' => $params['author'],
            'time' => $params['time']
        ));
        $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->pdo->lastInsertId();
    }

    function addQuestions($params, $testId)
    {
        /*
        Должен приходить массив params вида:
        [
            [0] => [
                'question' => [
                    'name' => $name,
                    'test' => $testId,
                    'type' => $type
                ],
                answers => [
                    [0] => [
                        'name' => $name,
                        'question' => $question
                    ],
                    [1] => [
                        'name' => $name,
                        'question' => $question
                    ],
                    [2] => [
                        'name' => $name,
                        'question' => $question
                    ]
                ]
            ],
            [1] => [
                'question' => [
                    'name' => $name,
                    'test' => $testId,
                    'type' => $type
                ],
                answers => [
                    [0] => [
                        'name' => $name,
                        'question' => $question
                    ],
                    [1] => [
                        'name' => $name,
                        'question' => $question
                    ],
                    [2] => [
                        'name' => $name,
                        'question' => $question
                    ]
                ]
            ],
            ...
        ]
        */
        foreach ($params as $param) {
            $query = "insert into questions(name, test, type) values(:name, :test, :type)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                'name' => $params['question']['name'],
                'test' => $testId,
                'type' => $params['question']['type'],
            ));
            $stmt->fetch(PDO::FETCH_ASSOC);
            $questionId = $this->pdo->lastInsertId();
            $answers = $param['answers'];
            foreach ($answers as $answer) {
                $query = "insert into answers(question, name) values(:question, :name)";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute(array(
                    'question' => $questionId,
                    'name' => $answer['name'],
                ));
                $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
    }
}
