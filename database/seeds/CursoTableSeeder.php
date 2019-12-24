<?php

use Illuminate\Database\Seeder;
use iouesa\Models\Curso;

class CursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data_ei = array('Inicial 1','Inicial 2');
        $data_be = array('Primero','Segundo','Tercero','Cuarto');
        $data_bm = array('Quinto','Sexto','Séptimo');
        $data_bs = array('Octavo','Noveno','Décimo');
        $data_bu = array('Primero','Segundo','Tercero');
        
        foreach ($data_ei as $ei) {
            Curso::create(['nombre'=>$ei,'tipo'=>'EI']);
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
        foreach ($data_bu as $bu) {
            Curso::create(['nombre'=>$bu,'tipo'=>'BU']);
        }
        
    }
}
