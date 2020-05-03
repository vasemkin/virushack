<?
include '../modules/course.module.php';
$module = new CourseModule();
$data = $_REQUEST;
$spheres = [];
$categories = [];
$html = '';

foreach ($_REQUEST as $key => $value) {
    $val = substr($key, 1);
    if ($key[0] == "s") {
        array_push($spheres, $val);
    }
    else {
        array_push($categories, $val);
    }
}
if (sizeof($spheres) != 0 && sizeof($categories) != 0) {
    $params = ['spheres' => $spheres, 'categories' => $categories];
}
else if (sizeof($spheres) != 0) {
    $params = ['spheres' => $spheres];
}
else if (sizeof($categories) != 0){
    $params = ['categories' => $categories];
}
$res = $module->getCourses($params);
foreach ($res as $r) {
    $html .= "<div class='course'>" . $r['name'] . "</div>";
}
echo $html;