<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/05/2018
 * Time: 13:36
 */

class tb_action
{
    private $id_action;
    private $str_cod_action;
    private $str_name_action;

    /**
     * tb_action constructor.
     * @param $id_action
     * @param $str_cod_action
     * @param $str_name_action
     */
    public function __construct($id_action, $str_cod_action, $str_name_action)
    {
        $this->id_action = $id_action;
        $this->str_cod_action = $str_cod_action;
        $this->str_name_action = $str_name_action;
    }

    /**
     * @return mixed
     */
    public function getIdAction()
    {
        return $this->id_action;
    }

    /**
     * @param mixed $id_action
     */
    public function setIdAction($id_action)
    {
        $this->id_action = $id_action;
    }

    /**
     * @return mixed
     */
    public function getStrCodAction()
    {
        return $this->str_cod_action;
    }

    /**
     * @param mixed $str_cod_action
     */
    public function setStrCodAction($str_cod_action)
    {
        $this->str_cod_action = $str_cod_action;
    }

    /**
     * @return mixed
     */
    public function getStrNameAction()
    {
        return $this->str_name_action;
    }

    /**
     * @param mixed $str_name_action
     */
    public function setStrNameAction($str_name_action)
    {
        $this->str_name_action = $str_name_action;
    }
}