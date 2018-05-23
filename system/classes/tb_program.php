<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/05/2018
 * Time: 13:34
 */

class tb_program
{
    private $id_program;
    private $str_cod_program;
    private $str_name_program;

    /**
     * tb_program constructor.
     * @param $id_program
     * @param $str_cod_program
     * @param $str_name_program
     */
    public function __construct($id_program, $str_cod_program, $str_name_program)
    {
        $this->id_program = $id_program;
        $this->str_cod_program = $str_cod_program;
        $this->str_name_program = $str_name_program;
    }

    /**
     * @return mixed
     */
    public function getIdProgram()
    {
        return $this->id_program;
    }

    /**
     * @param mixed $id_program
     */
    public function setIdProgram($id_program)
    {
        $this->id_program = $id_program;
    }

    /**
     * @return mixed
     */
    public function getStrCodProgram()
    {
        return $this->str_cod_program;
    }

    /**
     * @param mixed $str_cod_program
     */
    public function setStrCodProgram($str_cod_program)
    {
        $this->str_cod_program = $str_cod_program;
    }

    /**
     * @return mixed
     */
    public function getStrNameProgram()
    {
        return $this->str_name_program;
    }

    /**
     * @param mixed $str_name_program
     */
    public function setStrNameProgram($str_name_program)
    {
        $this->str_name_program = $str_name_program;
    }
}