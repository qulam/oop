<?php

namespace app\core;


use app\config\Params;
use app\core\DB_MANAGER;
use app\core\Helpers;

class Model extends DB_MANAGER
{
    private $model;

    private $id;

    public $modelLang;

    public $modelLangName;

    public $table_name_lang;

    public $attributes = [];

    private $table_name;

    private $connect;

    private $findResult = [];

    private $afterWhere = [];

    private $afterLike = [];

    public $getRequest = [];

    public $getRequestLang = [];

    public $andWhere;

    public $language;


    public function __construct()
    {
        new DB_MANAGER();
        $this->connect = parent::connect_db();
        $this->attributes = self::attributes();
        $this->model = get_called_class();
        $this->language = Helpers::getLang();
        $this->table_name = $this->tableName();
        $this->ML();

    }


    /**
     * MultiLanguage method is related with 'app/models/ $this->getRequest['langClassName'] + ()' class
     */
    public function ML()
    {
        if (method_exists($this, 'behaviors')) {

            $behaviors = $this->behaviors();
            $checkClassName = isset($behaviors['ml']['LangClassName']) && !empty($behaviors['ml']['LangClassName']);
            $checkRelationName = isset($behaviors['ml']['LangRelationName']) && !empty($behaviors['ml']['LangRelationName']);
            $checkLangForignKey = isset($behaviors['ml']['LangForeignKey']) && !empty($behaviors['ml']['LangForeignKey']);
            $checkLangAttributes = isset($behaviors['ml']['LangAttributes']) && !empty($behaviors['ml']['LangAttributes']);

            if ($checkClassName && $checkRelationName && $checkLangForignKey) {
                $this->LangClassName = $behaviors['ml']['LangClassName'];
                $this->LangRelationName = $behaviors['ml']['LangRelationName'];
                $this->LangForeignKey = $behaviors['ml']['LangForeignKey'];
                $this->LangAttributes = $behaviors['ml']['LangAttributes'];
            }

            if (file_exists('./app/models/' . $this->getRequestLang['LangClassName'] . '.php')) {
                $langClassName = str_replace("/", "\\", "/" . __NAMESPACE__ . "/" . $this->getRequestLang['LangClassName']);
                $newLangClassName = str_replace("core", "models", $langClassName);

                $objLang = new $newLangClassName();
                $this->modelLang[$behaviors['ml']['LangRelationName']] = $objLang;
            }
        }
    }


    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        if (method_exists($this, 'behaviors')) {
            $behaviors = $this->behaviors();
            $behaviors_key = array_keys($behaviors['ml']);

            if (in_array($key, $behaviors_key) || in_array($key, $behaviors['ml']['LangAttributes'])) {
                if (in_array($key, $behaviors['ml']['LangAttributes'])) {
                    $this->getRequestLang[$behaviors['ml']['LangRelationName']][$key] = $value;
                } else {
                    $this->getRequestLang[$key] = $value;
                }
            } else {
                $this->getRequest[$key] = $value;
            }
        } else {
            $this->getRequest[$key] = $value;
        }
    }


    public function attributes()
    {
        $this->table_name = $this->tableName();
        $sql = "SHOW COLUMNS FROM $this->table_name";
        $columns = $this->connect->prepare($sql);
        $columns->execute();

        $attributes = $columns->fetchAll(\PDO::FETCH_ASSOC);
        $attr = [];
        foreach ($attributes as $key => $value) {
            $attr[] = $value['Field'];
        }

        return $attr;
    }


    public function find()
    {
        $this->table_name = $this->tableName();
        $sql = "SELECT * FROM $this->table_name";
        $query = $this->connect->prepare($sql);
        $query->execute();

        $this->findResult = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $this;

    }


    public function findAll()
    {
        $this->table_name = $this->tableName();
        $sql = "SELECT * FROM $this->table_name";
        $query = $this->connect->prepare($sql);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);

    }


    public function findOne($id = null)
    {
        $this->table_name = $this->tableName();

        if ($id != null) {
            $sql = "SELECT * FROM $this->table_name WHERE `id` = $id";
        } else {
            $sql = "SELECT * FROM $this->table_name";
        }

        $query = $this->connect->prepare($sql);
        $query->execute();

        return $query->fetch(\PDO::FETCH_ASSOC);
    }


    public function where($condition)
    {
        $result = [];
        $array_keys_cond = array_keys($condition);
        $array_value_cond = array_values($condition);

        $index = 0;
        $pos = [];

        foreach ($this->findResult as $item) {
            $i = 0;
            foreach ($array_keys_cond as $key) {

                if ($item[$key] == $condition[$key]) {
                    $pos[$i] = 'true';
                } else {
                    $pos[$i] = 'false';
                }

                $i++;
            }
            if (!in_array('false', $pos)) {
                $result[$index] = $item;
            }

            $index++;

        }

        $this->afterWhere = $result;

        return $this;

    }


    // This method must be changed ! (***)
    public function andWhere($cond, $arr)
    {
        foreach ($this->afterWhere as $col => $item) {
            $index = 0;
            foreach ($arr as $key => $val) {
                switch ($cond[0]) {
                    case '!=':
                        if ($item[$key] != $val) {
                            $this->andWhere[$index] = $item;
                            $index++;
                        }
                        break;
                    case '!==':
                        if ($item[$key] !== $val) {
                            $this->andWhere[$index] = $item;
                            $index++;
                        }
                        break;
                    case '>':
                        if ($item[$key] > $val) {
                            $this->andWhere[$index] = $item;
                            $index++;
                        }
                        break;
                    case '<':
                        if ($item[$key] < $val) {
                            $this->andWhere[$index] = $item;
                            $index++;
                        }
                        break;
                    case '>=':
                        if ($item[$key] >= $val) {
                            $this->andWhere[$index] = $item;
                            $index++;
                        }
                        break;
                    case '<=':
                        if ($item[$key] <= $val) {
                            $this->andWhere[$index] = $item;
                            $index++;
                        }
                        break;
                    default:
                    case '==':
                        if ($item[$key] == $val) {
                            $this->andWhere[$index] = $item;
                            $index++;
                        }
                        break;
                }
            }
        }
        return $this;
    }


    public function like($condition)
    {
        $this->table_name = $this->tableName();
        $result = [];

        foreach ($condition as $key => $value) {
            $result[] = $key;
            $result[] = $value;
        }

        $sql = "SELECT * FROM `$this->table_name` WHERE `$result[0]` LIKE '%" . $result[1] . "%'";
        $query = $this->connect->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        $this->afterLike = $result;

        return $result;

    }


    //Save model ..
    public function save()
    {
        if ($this->checkModel($this)) {
            if ($this->createCommand()) {
                return true;
            };

        } else {
            if ($this->updatedCommand()) {
                return true;
            };
        }
    }


    //Check model ..
    public function checkModel()
    {
        $action = Helpers::getAction();
        if ($action == 'create') {
            return true;
        }

        return false;
    }



    //Created model ..

    /**
     * @return bool
     * $modelLangName is language model name
     * $table_name_lang is $modelLang's table name
     *
     *
     */
    public function createCommand()
    {
        if (method_exists($this, 'behaviors')) {

            $className = str_replace("/", "\\", "/" . __NAMESPACE__ . "/" . $this->getRequestLang["LangClassName"]);
            $this->modelLangName = str_replace("core", "models", $className);
            $objectModelLang = new $this->modelLangName();
            $this->table_name_lang = $objectModelLang->tableName();
        }

        $this->table_name = $this->tableName();

        $columns = '';
        $values = '';

        $columnsName = array_keys($this->getRequest);
        $columnsValue = array_values($this->getRequest);

        /**Create sql query for save database**/
        for ($i = 0; $i < count($columnsName); $i++) {
            if ($i == count($columnsName) - 1) {
                $columns .= $columnsName[$i];
            } else {
                $columns .= $columnsName[$i] . ',';
            }
        }

        for ($i = 0; $i < count($columnsValue); $i++) {
            if ($i == count($columnsValue) - 1) {
                $values .= '"' . $columnsValue[$i] . '"';
            } else {
                $values .= '"' . $columnsValue[$i] . '"' . ',';
            }
        }

        $sql = "INSERT INTO `$this->table_name` ($columns) VALUES ($values)";
        $query = $this->connect->prepare($sql);

        /**Check for Multi Language**/
        if (method_exists($this, 'behaviors')) {

            /**Multi Language**/
            if ($query->execute()) {
                $this->id = $this->connect->lastInsertId();
                $langColumnsName = array_keys($this->getRequestLang[$this->getRequestLang["LangRelationName"]]);
                $langColumnsName = array_merge([$this->getRequestLang['LangForeignKey'], 'language'], $langColumnsName);
                $count = count($langColumnsName);
                $this->table_name = $this->tableName();
                $columns = '';
                $values = '';

                /**Create sql query for save multilanguage database**/
                for ($i = 0; $i < $count; $i++) {
                    if ($i == $count - 1) {
                        $columns .= $langColumnsName[$i];
                    } else {
                        $columns .= $langColumnsName[$i] . ',';
                    }
                }

                /**Create columns value for Multi Language**/
                foreach (Params::$languages as $lang) {
                    $lang_columns_value = [];
                    foreach ($this->getRequestLang['translate'] as $col => $val) {
                        $lang_columns_value[$col] = $val[$lang];
                    }
                    $lang_columns_value = array_values($lang_columns_value);
                    $lang_columns_value = array_merge([$this->id, $lang], $lang_columns_value);

                    $values = '';
                    for ($i = 0; $i < count($lang_columns_value); $i++) {
                        if ($i == count($lang_columns_value) - 1) {
                            $values .= '"' . $lang_columns_value[$i] . '"';
                        } else {
                            $values .= '"' . $lang_columns_value[$i] . '"' . ',';
                        }
                    }
                    $sql = "INSERT INTO `$this->table_name_lang` ($columns) VALUES ($values)";

                    $query = $this->connect->prepare($sql);
                    if (!$query->execute()) {
                        return false;
                    }
                }
                return true;
            } else {
                return false;
            }
        } else {
            if ($query->execute()) {
                return true;
            }
            return false;
        }
    }


    // Updated model ..
    public function updatedCommand()
    {
        $this->table_name = $this->tableName();

        $sqlBase = '';
        $id = Helpers::getId();
        $getRequest = $this->getRequest;

        $index = 0;
        foreach ($getRequest as $col => $val) {
            $sqlBase .= '`' . $col . '`' . '=' . '"' . $val . '"';
            if ($index < count($getRequest) - 1) {
                $sqlBase .= ',';
            }

            $index++;
        }

        $sql = "UPDATE `$this->table_name` SET $sqlBase WHERE `id` = $id";
        $query = $this->connect->prepare($sql);

        return $query->execute();

    }


    public function isValid($post)
    {
        $this->table_name = $this->tableName();

        $id = Helpers::getId();
        $uptaded_user = $this->find()->where(['id' => $id])->one();

        $checkEmail = $this->find()->where(['email' => $post['email']])->one();
        $checkUsername = $this->find()->where(['username' => $post['username']])->one();
        $condForUpdate = ($checkEmail['email'] == $uptaded_user['email']) && ($checkEmail['username'] == $uptaded_user['username']);

        if ((count($checkEmail) > 0 || count($checkUsername) > 0)) {
            return false;
        } else {
            $this->name = trim($post['name']);
            $this->username = trim($post['username']);
            $this->password_hash = password_hash($post['password_hash'], PASSWORD_DEFAULT);
            $this->email = trim($post['email']);
            $this->created_at = time();
            $this->status = trim($post['status']);

            return $this;
        }

    }


    public function userUpdate($post)
    {
        $hasUser = Helpers::getUser();

        //update self ..
        $users = $this->findAll();
        $usersArr = [];
        $user_password_hash = $this->find()->where(['id' => Helpers::getId()])->one()['password_hash'];

        foreach ($users as $key => $user) {
            if ($user['id'] != Helpers::getId()) {
                $usersArr[$key] = $user;
            }
        }

        foreach ($usersArr as $key => $val) {
            if (($post['email'] == $val['email']) || ($post['username'] == $val['username'])) {
                return false;
            }
        }

        $this->name = trim($post['name']);
        $this->username = trim($post['username']);

        if ($post['password_hash'] !== $user_password_hash) {
            $this->password_hash = password_hash($post['password_hash'], PASSWORD_DEFAULT);
        }

        $this->email = trim($post['email']);
        $this->created_at = time();
        $this->status = trim($post['status']);

        return $this;
    }


    public function delete()
    {
        $this->table_name = $this->tableName();
        $id = Helpers::getId();

        $sql = "DELETE FROM `$this->table_name` WHERE `id` = " . $id;
        $query = $this->connect->prepare($sql);

        return $query->execute();
    }


    public function asArray()
    {

    }


    public function one()
    {
        foreach ($this->afterWhere as $key => $value) {
            return $value;
        }
    }


    public function all()
    {
        return $this->afterWhere;
    }


    public function findColumns()
    {
        // Some codes ..

    }


    public function findModel($id)
    {
        // Some codes ..
        // return $this->where(['id' => $id]);


    }


}