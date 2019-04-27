<?php

use app\core\Helpers;

/*
***
*/
$table_rows = $model->findAll();
$view = '';
$update = '';
$delete = '';
$attributes = [];
$templates = [];
$filters = [];
/*
***
*/

// Start templates area ..
if (isset($rules)) {
    $attributes = $rules['options']['columns'];
} else {
    $attributes = $model->attributes;
}

if (isset($rules['options']['templates'])) {
    $templates = $rules['options']['templates'];
}

function viewTemplate($id, $templates)
{
    $controller = Helpers::getController();
    if (in_array('view', $templates)) {
        $view = '<a href="' . Helpers::Url() . '/' . $controller . '/view/' . $id . '"><span class="fa fa-eye"></span></a>';
        return $view;
    }
}

function updateTemplate($id, $templates)
{
    $controller = Helpers::getController();
    if (in_array('update', $templates)) {
        $update = '<a href="' . Helpers::Url() . '/' . $controller . '/update/' . $id . '"><span class="fa fa-edit"></span></a>';
        return $update;
    }
}


function deleteTemplate($id, $templates)
{
    $controller = Helpers::getController();
    if (in_array('delete', $templates)) {
        $delete = '<a href="' . Helpers::Url() . '/' . $controller . '/delete/' . $id . '"><span class="fa fa-trash"></span></a>';
        return $delete;
    }
}

// End templates area ..


// Start filters area ..

$filters = [];
if (isset($rules['options']['filters'])) {
    $filters = $rules['options']['filters'];
}


function searchInputs($filters, $attributes, $templates)
{
    $inputs = '';
    $filtersValues = array_values($filters);

    foreach ($attributes as $attr) {
        if (in_array($attr, $filtersValues)) {
            $inputs .= '<td><input autocomplete="off" class="form-control search_input" type="text" name="' . $attr . '" value="" id="' . $attr . '"></td>';
        } else {
            $inputs .= '<td></td>';
        }

    }
    if (!empty($templates)) {
        $inputs .= '<td></td>';
    }

    return $inputs;

}

// End filters area ..

?>

<!-- List Widget -->
<div id="listWidget" class="container-fluid">
    <table class="table table-bordered">

        <thead>
        <?php foreach ($attributes as $key => $attr): ?>

            <th id="<?= $attr ?>"><?= $attr ?></th>

        <?php endforeach; ?>
        <?php if (!empty($templates)): ?>
            <th></th>
        <?php endif; ?>
        </thead>
        <?php if (isset($rules['options']['filters'])): ?>
            <tr id="search">
                <?= searchInputs($filters, $attributes, $templates) ?>
            </tr>
        <?php endif; ?>
        <?php foreach ($table_rows as $rows => $row): ?>

            <tr class="i">
                <?php foreach ($attributes as $key => $attr): ?>
                    <td><?= $row[$attr] ?></td>
                <?php endforeach; ?>
                <?php if (!empty($templates)): ?>
                    <td class="templates">
                        <?= viewTemplate($row['id'], $templates) ?>
                        <?= updateTemplate($row['id'], $templates) ?>
                        <?= deleteTemplate($row['id'], $templates) ?>
                    </td>
                <?php endif; ?>
            </tr>

        <?php endforeach; ?>
    </table>
</div>