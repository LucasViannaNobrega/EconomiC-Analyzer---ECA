<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/05/2018
 * Time: 13:46
 */

class tb_functions
{
    private $id_functions;
    private $str_cod_function;
    private $str_name_function;

    /**
     * tb_functions constructor.
     * @param $id_functions
     * @param $str_cod_function
     * @param $str_name_function
     */
    public function __construct($id_functions, $str_cod_function, $str_name_function)
    {
        $this->id_functions = $id_functions;
        $this->str_cod_function = $str_cod_function;
        $this->str_name_function = $str_name_function;
    }

    /**
     * @return mixed
     */
    public function getIdFunctions()
    {
        return $this->id_functions;
    }

    /**
     * @param mixed $id_functions
     */
    public function setIdFunctions($id_functions): void
    {
        $this->id_functions = $id_functions;
    }

    /**
     * @return mixed
     */
    public function getStrCodFunction()
    {
        return $this->str_cod_function;
    }

    /**
     * @param mixed $str_cod_function
     */
    public function setStrCodFunction($str_cod_function): void
    {
        $this->str_cod_function = $str_cod_function;
    }

    /**
     * @return mixed
     */
    public function getStrNameFunction()
    {
        return $this->str_name_function;
    }

    /**
     * @param mixed $str_name_function
     */
    public function setStrNameFunction($str_name_function): void
    {
        $this->str_name_function = $str_name_function;
    }
}