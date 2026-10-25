<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function pegar_get(string $chave, $padrao = null)
{
    return $_GET[$chave] ?? $padrao;
}

function usuario_logado(): ?array
{
    $usuario = $_SESSION['usuario'] ?? null;

    if (!is_array($usuario) || empty($usuario)) {
        return null;
    }

    return $usuario;
}

function ler(string $nome): array
{
    $dados = [
        'usuarios' => [
            [
                'id' => 1,
                'nome' => 'Ana Luísa',
                'curso' => 'Design',
                'seguindo' => [2, 3],
            ],
            [
                'id' => 2,
                'nome' => 'Rafael Moura',
                'curso' => 'Literatura',
                'seguindo' => [1, 3],
            ],
            [
                'id' => 3,
                'nome' => 'Beatriz Lima',
                'curso' => 'Psicologia',
                'seguindo' => [1, 2],
            ],
            [
                'id' => 4,
                'nome' => 'João Gabriel',
                'curso' => 'Design',
                'seguindo' => [1, 2, 3],
            ],
        ],
        'avaliacoes' => [
            [
                'id' => 1,
                'usuario_id' => 1,
                'livro_id' => 13,
                'texto' => 'Uma leitura excelente. A construção do mundo é tão viva que dá vontade de seguir viagem junto com Bilbo.',
                'nota' => 5,
                'curtidas' => 24,
                'criado_em' => '2026-10-25 10:00:00',
            ],
            [
                'id' => 2,
                'usuario_id' => 2,
                'livro_id' => 11,
                'texto' => 'A linguagem é muito bonita e a história prende pela delicadeza. Foi uma das leituras mais marcantes do semestre.',
                'nota' => 5,
                'curtidas' => 17,
                'criado_em' => '2026-10-25 09:00:00',
            ],
            [
                'id' => 3,
                'usuario_id' => 3,
                'livro_id' => 1,
                'texto' => 'Me fez pensar muito sobre escolhas, sem perder a leveza. Perfeito para conversar depois da aula.',
                'nota' => 4,
                'curtidas' => 31,
                'criado_em' => '2026-10-24 20:30:00',
            ],
            [
                'id' => 4,
                'usuario_id' => 1,
                'livro_id' => 8,
                'texto' => 'Uma obra que merece ser lida mais de uma vez. Foi uma conversa muito rica sobre história e sociedade.',
                'nota' => 4,
                'curtidas' => 18,
                'criado_em' => '2026-10-24 14:20:00',
            ],
        ],
    ];

    return $dados[$nome] ?? [];
}

function achar_por_id(array $lista, $id): ?array
{
    foreach ($lista as $item) {
        if ((int) ($item['id'] ?? 0) === (int) $id) {
            return $item;
        }
    }

    return null;
}

function ids_que_sigo(int $idUsuario): array
{
    foreach (ler('usuarios') as $usuario) {
        if ((int) ($usuario['id'] ?? 0) === $idUsuario) {
            return array_map('intval', $usuario['seguindo'] ?? []);
        }
    }

    return [];
}

function ordenar(array $lista, string $campo): array
{
    usort(
        $lista,
        static function ($a, $b) use ($campo) {
            $valorA = $a[$campo] ?? '';
            $valorB = $b[$campo] ?? '';

            if ($valorA === $valorB) {
                return 0;
            }

            return $valorA > $valorB ? -1 : 1;
        }
    );

    return $lista;
}

function paginar(array $lista, int $porPagina = 10): array
{
    $paginaSolicitada = pegar_get('pagina', 1);
    $pagina = is_scalar($paginaSolicitada)
        ? max(1, (int) $paginaSolicitada)
        : 1;
    $porPagina = max(1, $porPagina);
    $total = count($lista);
    $inicio = ($pagina - 1) * $porPagina;
    $dados = array_slice($lista, $inicio, $porPagina);

    return [
        'pagina' => $pagina,
        'por_pagina' => $porPagina,
        'total' => $total,
        'dados' => $dados,
    ];
}

function avaliacoes_completas(array $avaliacoes, int $idUsuario): array
{
    $usuarios = ler('usuarios');

    foreach ($avaliacoes as $indice => $avaliacao) {
        $usuario = achar_por_id($usuarios, $avaliacao['usuario_id'] ?? 0);
        $avaliacoes[$indice] = [
            'id' => $avaliacao['id'] ?? 0,
            'usuario_id' => $avaliacao['usuario_id'] ?? 0,
            'livro_id' => $avaliacao['livro_id'] ?? 0,
            'texto' => $avaliacao['texto'] ?? '',
            'nota' => (int) ($avaliacao['nota'] ?? 0),
            'curtidas' => (int) ($avaliacao['curtidas'] ?? 0),
            'criado_em' => $avaliacao['criado_em'] ?? '',
            'usuario' => $usuario,
            'curtida' => false,
            'avaliado_por_mim' => (int) ($avaliacao['usuario_id'] ?? 0) === $idUsuario,
        ];
    }

    return $avaliacoes;
}

function livros_em_alta(string $filtro = '', int $limite = 5): array
{
    $livros = [
        ['id' => 13, 'titulo' => 'O Hobbit', 'autor' => 'J. R. R. Tolkien', 'pontuacao' => 96],
        ['id' => 11, 'titulo' => 'Ensaio Sobre a Cegueira', 'autor' => 'José Saramago', 'pontuacao' => 92],
        ['id' => 8, 'titulo' => 'Sapiens', 'autor' => 'Yuval Noah Harari', 'pontuacao' => 90],
        ['id' => 14, 'titulo' => 'Harry Potter e a Pedra Filosofal', 'autor' => 'J. K. Rowling', 'pontuacao' => 88],
        ['id' => 3, 'titulo' => 'Duna', 'autor' => 'Frank Herbert', 'pontuacao' => 86],
    ];

    usort(
        $livros,
        static function ($a, $b) {
            return ($b['pontuacao'] ?? 0) <=> ($a['pontuacao'] ?? 0);
        }
    );

    return array_slice($livros, 0, max(1, $limite));
}

function responder(array $resultado): void
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(
        $resultado,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR
    );
}
