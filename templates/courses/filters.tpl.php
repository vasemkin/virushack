<?
$categories = $module->getCategories();
$spheres = $module->getSpheres();
?>

<div class="courses__options">
    <div class="courses__title">Фильтры</div>
    <form action="" class="courses__area">
        <div class="courses__title courses__title_blue">Область</div>
        <? foreach ($spheres as $sph) : ?>
            <label class="container-checkbox"><?= $sph['name'] ?>
                <input type="checkbox" name="s<?= $sph['id'] ?>" onchange="filterContentCourses()">
                <span class="checkmark"></span>
            </label>
        <? endforeach; ?>
        <div class="courses__title courses__title_blue">Категории</div>
        <? foreach ($categories as $cat) : ?>
            <label class="container-checkbox"><?= $cat['name'] ?>
                <input type="checkbox" name="c<?= $cat['id'] ?>" onchange="filterContentCourses()">
                <span class="checkmark" onclick="filterContent()"></span>
            </label>
        <? endforeach; ?>
    </form>


</div><!-- /courses__options -->