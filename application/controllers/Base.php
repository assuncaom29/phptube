<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base extends CI_Controller {
	/**
     * Carrega a home
     */
	public function Index()
	{
		// Recupera os videos através do model
		$videos = $this->videos_model->GetAll('name');
		// Passa os videos para o array que será enviado à home
		$dados['videos'] = $this->videos_model->Formatar($videos);
		// Chama a home enviando um array de dados a serem exibidos
		$this->load->view('home',$dados);
	}
	/**
     * Processa o formulário para salvar os dados
     */
	public function Salvar(){
		// Recupera os videos através do model
		$videos = $this->videos_model->GetAll('NAME');
		// Passa os videos para o array que será enviado à home
		$dados['videos'] = $this->videos_model->Formatar($videos);
		// Executa o processo de validação do formulário
		$validacao = self::Validar();
		// Verifica o status da validação do formulário
		// Se não houverem erros, então insere no banco e informa ao usuário
		// caso contrário informa ao usuários os erros de validação
		if($validacao){
			// Recupera os dados do formulário
			$video = $this->input->post();
			// Insere os dados no banco recuperando o status dessa operação
			$status = $this->videos_model->Inserir($video);
			// Checa o status da operação gravando a mensagem na seção
			if(!$status){
				$this->session->set_flashdata('error', 'Não foi possível inserir o video.');
			}else{
				$this->session->set_flashdata('success', 'Video inserido com sucesso.');
				// Redireciona o usuário para a home
				redirect();
			}
		}else{
			$this->session->set_flashdata('error', validation_errors('<p>','</p>'));
		}
		// Carrega a home
		$this->load->view('home',$dados);
	}
	/**
     * Carrega a view para edição dos dados
     */
	public function Editar(){
		// Recupera o ID do registro - através da URL - a ser editado
		$id = $this->uri->segment(2);
		// Se não foi passado um ID, então redireciona para a home
		if(is_null($id))
			redirect();
		// Recupera os dados do registro a ser editado
		$dados['video'] = $this->videos_model->GetById($id);
		// Carrega a view passando os dados do registro
		$this->load->view('editar',$dados);
	}
	/**
     * Processa o formulário para atualizar os dados
     */
	public function Atualizar(){
		// Realiza o processo de validação dos dados
		$validacao = self::Validar('update');
		// Verifica o status da validação do formulário
		// Se não houverem erros, então insere no banco e informa ao usuário
		// caso contrário informa ao usuários os erros de validação
		if($validacao){
			// Recupera os dados do formulário
			$video = $this->input->post();
			// Atualiza os dados no banco recuperando o status dessa operação
			$status = $this->videos_model->Atualizar($video['IDVIDEO'],$video);
			// Checa o status da operação gravando a mensagem na seção
			if(!$status){
				$dados['video'] = $this->videos_model->GetById($contato['IDVIDEO']);
				$this->session->set_flashdata('error', 'Não foi possível atualizar o video.');
			}else{
				$this->session->set_flashdata('success', 'Video atualizado com sucesso.');
				// Redireciona o usuário para a home
				redirect();
			}
		}else{
			$this->session->set_flashdata('error', validation_errors());
		}
		// Carrega a view para edição
		$this->load->view('editar',$dados);
	}
	/**
     * Realiza o processo de exclusão dos dados
     */
	public function Excluir(){
		// Recupera o ID do registro - através da URL - a ser editado
		$id = $this->uri->segment(2);
		// Se não foi passado um ID, então redireciona para a home
		if(is_null($id))
			redirect();
		// Remove o registro do banco de dados recuperando o status dessa operação
		$status = $this->videos_model->Excluir($id);
		// Checa o status da operação gravando a mensagem na seção
		if($status){
			$this->session->set_flashdata('success', '<p>Video excluído com sucesso.</p>');
		}else{
			$this->session->set_flashdata('error', '<p>Não foi possível excluir o Video.</p>');
		}
		// Redirecionao o usuário para a home
		redirect();
	}
	/**
	* Valida os dados do formulário
	*
	* @param string $operacao Operação realizada no formulário: insert ou update
	*
	* @return boolean
	*/
	private function Validar($operacao = 'insert'){
		// Com base no parâmetro passado
		// determina as regras de validação
		switch($operacao){
			case 'insert':
				$rules['name']      = array('trim', 'required', 'min_length[5]');
				$rules['descricao'] = array('trim', 'required', 'min_length[30]');
                $rules['linkvideo'] = array('trim', 'required', 'min_length[25]');
				$rules['categoria'] = array('trim', 'required', 'min_length[5]');
				break;
			case 'update':
				$rules['name']      = array('trim', 'required', 'min_length[5]');
				$rules['descricao'] = array('trim', 'required', 'min_length[30]');
                $rules['linkvideo'] = array('trim', 'required', 'min_length[25]');
				$rules['categoria'] = array('trim', 'required', 'min_length[5]');
				break;
			default:
				$rules['name']      = array('trim', 'required', 'min_length[5]');
				$rules['descricao'] = array('trim', 'required', 'min_length[30]');
                $rules['linkvideo'] = array('trim', 'required', 'min_length[25]');
				$rules['categoria'] = array('trim', 'required', 'min_length[5]');
				break;
		}
		$this->form_validation->set_rules('name', 'Nome', $rules['name']);
		$this->form_validation->set_rules('descricao', 'Descricao', $rules['descricao']);
        $this->form_validation->set_rules('linkvideo', 'LinkVideo', $rules['linkvideo']);
        $this->form_validation->set_rules('categoria', 'Categoria', $rules['categoria']);

		// Executa a validação e retorna o status
		return $this->form_validation->run();
	}
}