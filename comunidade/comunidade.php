<?php

require __DIR__ . '/../funcoes.php';

$usuario = usuario_logado();

$id_usuario = (int) ($usuario['id'] ?? 0);

$filtro = pegar_get('filtro', 'todos');
$filtrosValidos = ['todos', 'seguindo', 'curso'];
if (!is_string($filtro) || !in_array($filtro, $filtrosValidos, true)) {
    $filtro = 'todos';
}

$usuarios = ler('usuarios');

$lista = [];

foreach (ler('avaliacoes') as $avaliacao) {

    $mostrar = true;

    if ($usuario !== null && $filtro === 'seguindo') {

        $seguindo = ids_que_sigo($usuario['id']);

        $mostrar = in_array(
            (int) $avaliacao['usuario_id'],
            $seguindo
        );
    }

    if ($usuario !== null && $filtro === 'curso') {

        $autor = achar_por_id(
            $usuarios,
            $avaliacao['usuario_id']
        );

        $mostrar = $autor !== null
            && isset($autor['curso'], $usuario['curso'])
            && $autor['curso'] === $usuario['curso'];
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
