<?php


function relatorioUsuarios(){

		include('../../user/functions/conexao.php');

		$arquivo = 'usuarios.xls';

		$sql = "SELECT * FROM relatorioUsuarios";
		$query = mysqli_query($con, $sql);

		$html = '';
		$html .= '<table>';
		$html .= '<tr>';
		$html .= '<td colspan="3">Relatorio Usuários</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td><b>ID do Usuário</b></td>';
		$html .= '<td><b>Nome</b></td>';
		$html .= '<td><b>Email</b></td>';
		$html .= '<td><b>Telefone</b></td>';
		$html .= '<td><b>Endereço</b></td>';
		$html .= '<td><b>Cidade</b></td>';
		$html .= '<td><b>Estado</b></td>';
		$html .= '<td><b>Pais</b></td>';
		$html .= '<td><b>CEP</b></td>';
		$html .= '<td><b>N. Envios</b></td>';
		$html .= '<td><b>N. Caixas</b></td>';
		$html .= '</tr>';
		
		do {
			$html .= '<tr>';
			$html .= '<td>'.$row_rel['idUsuario'].'</td>';
			$html .= '<td>'.$row_rel['nome'].'</td>';
			$html .= '<td>'.$row_rel['email'].'</td>';
			$html .= '<td>'.$row_rel['telefone'].'</td>';
			$html .= '<td>'.$row_rel['endereco'].'</td>';
			$html .= '<td>'.$row_rel['cidade'].'</td>';
			$html .= '<td>'.$row_rel['estado'].'</td>';
			$html .= '<td>'.$row_rel['pais'].'</td>';
			$html .= '<td>'.$row_rel['cep'].'</td>';
			$html .= '<td>'.$row_rel['Envios'].'</td>';
			$html .= '<td>'.$row_rel['caixas'].'</td>';
			$html .= '</tr>';
		} while ($row_rel = mysqli_fetch_assoc($query));

		$html .= '</table>';

		// Configurações header para forçar o download
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		header("Content-Type:   application/ms-excel");
		//header("Content-Type:   application/force-download");
		header("Content-Disposition:  attachment; filename=\"{$arquivo}\"");
		// Envia o conteúdo do arquivo
		echo $html;
		//exit;
}


if(isset($_GET['relatorioUsuarios'])){
	relatorioUsuarios();
}

?>