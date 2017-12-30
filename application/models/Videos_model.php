<?php
class Videos_model extends MY_Model {
    
    function __construct() {
        parent::__construct();
        $this->table = 'VIDEO';
    }
    /**
    * Formata os contatos para exibição dos dados na home
    *
    * @param array $contatos Lista dos contatos a serem formatados
    *
    * @return array
    */
    function Formatar($videos){
      if($videos){
        for($i = 0; $i < count($videos); $i++){
          $videos[$i]['editar_url'] = base_url('editar')."/".$videos[$i]['IDVIDEO'];
          $videos[$i]['excluir_url'] = base_url('excluir')."/".$videos[$i]['IDVIDEO'];
        }
        return $videos;
      } else {
        return false;
      }
    }
}