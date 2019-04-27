<?php

namespace app\models;


use app\core\Model;

class Projects extends Model
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'tbl_projects';
    }



    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'ml' => [
                'LangClassName' => 'ProjectsLang',
                'LangRelationName' => 'translate',
                'LangForeignKey' => 'project_id',
                'LangAttributes' => [
                    'title', 'short', 'description'
                ]
            ]
        ];
    }
}