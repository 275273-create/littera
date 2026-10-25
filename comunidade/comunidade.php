<?php

require '../funcoes.php';

$usuario = usuario_logado();

$id_usuario = 0;

if ($usuario != null) {
    $id_usuario = $usuario['id'];
}

$filtro = pegar_get('filtro', 'todos');

$usuarios = ler('usuarios');

$lista = [];

foreach (ler('avaliacoes') as $avaliacao) {

    $mostrar = true;

    if ($usuario != null && $filtro == 'seguindo') {

        $seguindo = ids_que_sigo($usuario['id']);

        $mostrar = in_array(
            $avaliacao['usuario_id'],
            $seguindo
        );
    }

    if ($usuario != null && $filtro == 'curso') {

        $autor = achar_por_id(
            $usuarios,
            $avaliacao['usuario_id']
        );

        $mostrar = ($autor['curso'] == $usuario['curso']);
    }

    if ($mostrar == true) {
        $lista[] = $avaliacao;
    }
}

$lista = ordenar($lista, 'criado_em');

$resultado = paginar($lista);

$resultado['dados'] = avaliacoes_completas(
    $resultado['dados'],
    $id_usuario
);

$resultado['livros_em_alta'] = livros_em_alta('', 5);

responder($resultado);

?>
