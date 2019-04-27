<?php
use app\core\Helpers;

$controller = $_POST["_controller"];
$column_name = $data["column_name"];
$column_value = $data["column_value"];
$all_columns = $data["all_columns"];
$hasTemplate = $data["hasTemplate"];
$all = $data["all"];
$output = '';

if(!empty($column_value) && !empty($column_name)){
	$modelResult = $model->find()->like([$column_name => $column_value]);
}else{
	$modelResult = $model->findAll();
}
?>

<?php if(!empty($modelResult)): ?>
    <?php foreach($modelResult as $key => $value): ?>

        <?php $output .= "<tr class='i'>"; ?>

            <?php foreach($all as $column): ?>

                <?php $output .= "<td>".$value[$column]."</td>"; ?>

            <?php endforeach; ?>

            <?php if($hasTemplate === "true"): ?>
                <?php $output .=
                "<td>
                    <a href='". Helpers::Url() . '/' . $controller."/view/".$value['id']."'><span class='fa fa-eye'></span></a>
                    <a href='". Helpers::Url() . '/' . $controller."/update/".$value['id']."'><span class='fa fa-edit'></span></a>
                    <a href='". Helpers::Url() . '/' . $controller."/delete/".$value['id']."'><span class='fa fa-trash'></span></a>	
                </td>";
                ?>
            <?php endif; ?>
        <?php $output .= "</tr>"; ?>
    <?php endforeach; ?>
<?php endif; ?>
<?php

echo $output;die();

?>