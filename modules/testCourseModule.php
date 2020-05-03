<?
include 'course.module.php';

$module = new CourseModule();
$params = ['spheres' => [1, 3], 'categories' => [1, 3, 4]];
$res = $module->getCourses($params);
foreach ($res as $r) {
    var_dump($r);
    var_dump('<br/><br/>');
}