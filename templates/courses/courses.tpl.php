<?
$courses = $module->getCourses();
?>
<div class="courses__wrapper">
    <?foreach ($courses as $course): ?>
    <div class="course"><?=$course['name']?></div>
    <?endforeach; ?>
</div>