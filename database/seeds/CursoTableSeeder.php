<?php

use Illuminate\Database\Seeder;
use ioxford\Models\Curso;

class CursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data_pre = array('Inicial 1','Inicial 2');
        $data_be = array('Segundo','Tercero','Cuarto');
        $data_bm = array('Quinto','Sexto','Séptimo');
        $data_ba = array('Primero','Segundo','Tercero');
        $data_bs = array('Octavo','Noveno','Décimo');
        
        foreach ($data_pre as $pre) {
            Curso::create(['nombre'=>$pre,'tipo'=>'PRE']);
        }
        foreach ($data_be as $be) {
            Curso::create(['nombre'=>$be,'tipo'=>'BE']);
        }
        foreach ($data_bm as $bm) {
            Curso::create(['nombre'=>$bm,'tipo'=>'BM']);
        }
        foreach ($data_bs as $bs) {
            Curso::create(['nombre'=>$bs,'tipo'=>'BS']);
        }
        foreach ($data_ba as $ba) {
            Curso::create(['nombre'=>$ba,'tipo'=>'BA']);
        }
        
    }
}
