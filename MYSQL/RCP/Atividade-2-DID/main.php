<?php

$conn = mysqli_connect("localhost","root","Acesso_RR_(35824)","atividade");

if($conn -> connect_errno){
    echo "DEU RUIM".PHP_EOL;
}

echo "Connection Sus".PHP_EOL;

static $listaOpcoesValidasMenuPrincipal = [1, 2, 3, 4];
//$AlunosMemory = [];
$ProfessorMemory = [];
$opcao = 0;

function cadastrarProfessor($nome, $salario)
{
    global $ProfessorMemory;
    $ProfessorMemory[] = [
        "Nome" => $nome,
        "Salario" => $salario
    ];
}

function menuCadastroProfessor()
{
    echo "===Menu Cadastro===" . PHP_EOL;
    $nome = readline("Digite o NOME do Profesor(a): ");
    $salario = readline("Digite o SALARIO do Profesor(a): ");

    popen('cls', 'w');
    cadastrarProfessor($nome, $salario);

    echo "Registro realizado com sucesso !!" . PHP_EOL;
    readline("Enter, para continuar");
}

function cadastrarAluno($nome, $turma, $curso, $mensalidade)
{
    global $conn;

    mysqli_query($conn,"INSERT INTO classe values ('$nome', '$turma', '$curso', '$mensalidade')");
}

function menuCadastroAluno()
{
    echo "===Menu Cadastro===" . PHP_EOL;
    $nome = readline("Digite o NOME do aluno: ");
    $turma = readline("Digite a TURMA do aluno: ");
    $curso = readline("Digite o CURSO do aluno: ");
    $mensalidade = readline("Digite a Mensalidade do aluno: ");

    popen('cls', 'w');
    cadastrarAluno($nome, $turma, $curso, $mensalidade);

    echo "Registro realizado com sucesso !!" . PHP_EOL;
    readline("Enter, para continuar");
}

function menuListarProfessor()
{
    global $ProfessorMemory;
    echo "===Lista de Professor===" . PHP_EOL;
    foreach ($ProfessorMemory as $professor) {
        echo "+++++++++++++++++++++++++" . PHP_EOL;
        echo "Nome: " . $professor['Nome'] . PHP_EOL;
        echo "Salario: " . $professor['Salario'] . PHP_EOL;
    }
    readline("Enter, para continuar ");
}


function ListarAluno()
{
    global $conn;
    $comando_selecao = "SELECT * FROM classe;";
    $select = mysqli_query($conn,$comando_selecao);

    while($linha = mysqli_fetch_assoc($select)){
        echo "NOME: ". $linha['Nome']. PHP_EOL;
        echo "TURMA: ". $linha['Turma']. PHP_EOL;
        echo "Curso" . $linha['Curso'].PHP_EOL;
        echo "Mensalidade" . $linha['Mensalidade'].PHP_EOL;
    }
    echo "Lista de Alunos";
}

function menuExcluirAluno()
{
    global $conn;
    echo "===Menu Excluir===" . PHP_EOL;
    $nomeExclusão = readline("Digite o NOME do aluno(a) para exclusão: ");

    mysqli_query($conn,"DELETE FROM classe WHERE Nome='$nomeExclusão'");
}

function menuExcluirProfessor()
{
    global $ProfessorMemory;
    echo "===Menu Excluir===" . PHP_EOL;
    $nomeExclusão = readline("Digite o NOME do professor(a) para exclusão: ");
}

function menuAlterarAluno()
{
    global $AlunosMemory;
    global $conn;
    global $nome;

    echo "=== Menu Alterar ===" . PHP_EOL;

    $nomeUpdate = readline("Digite o nome para a atualização: ");

    $turmaUpdate = readline("Digite a sua nova turma: ");
    $cursoUpdate = readline("Digite o seu novo curso: ");
    $mensalidadeUpdate = readline("Digite o valor da sua mensalidade: ");

    mysqli_query($conn,"UPDATE classe SET " . 
    "Turma = " . "'$turmaUpdate'". "," .
    "Curso = " . "'$cursoUpdate'" . ",".
    "Mensalidade = " . "'$mensalidadeUpdate'" . 
    "WHERE Nome = ". "'$nomeUpdate'" . ";");

    if ($nomeUpdate != $nome){
        echo "Atualização feita" . PHP_EOL;
        readline("Enter, para continuar ");
    } else {
        echo "!!! INVALIDO !!!". PHP_EOL;
        readline("Enter, para continuar ");
    }

//UPDATE Aluno SET Turma = "2 TDS b", Curso = "TDS", Mensalidade = 1200 where Nome = "Wesley"//
}

function menuAlterarProfessor()
{
    //global $ProfessorMemory;
    //echo "===Menu Alterar===" . PHP_EOL;
    //$nomeAtualizacao = readline("Digite o NOME do aluno(a) para alteração: ");
    //$resultadoBusca = pegarIndiceDoArrayPeloNome($nomeAtualizacao, $ProfessorMemory);
    //if ($resultadoBusca == -1) {
    //    echo "!!!!!  Nome Invalido !!!!!" . PHP_EOL;
    //    readline("Enter, para continuar ");
    //} else {
    //    popen('cls', 'w');
    //    $dadosAntigos = $ProfessorMemory[$resultadoBusca];
    //    $nome = readline("Digite o novo NOME ou enter para permanecer o antigo [Antigo: " . $dadosAntigos['Nome'] . " ]: ");
    //    $salario = readline("Digite o novo SALARIO ou enter para permanecer o antigo [Antigo: " . $dadosAntigos['Salario'] . " ]: ");
//
    //    $ProfessorMemory[$resultadoBusca]['Nome'] = $nome != "" ? $nome : $dadosAntigos['Nome'];
    //    $ProfessorMemory[$resultadoBusca]['Mensalidade'] = $salario != "" ? $salario : $dadosAntigos['Salario'];
    //    echo "Registro atualizado com sucesso !!" . PHP_EOL;
    //    readline("Enter, para continuar");
    //}
}

function verificarOpcaoMenuAluno($opcao)
{
    switch ($opcao) {
        case 1:
            menuCadastroAluno();
            break;
        case 2:
            ListarAluno();
            break;
        case 3:
            menuExcluirAluno();
            break;
        case 4:
            menuAlterarAluno();
            break;
        default:
            echo "Erro cód - 001: Não deveria chegar aqui o código" . PHP_EOL;
            break;
    }
}

function menuPrincipalAluno()
{
    $opcao = 0;
    static $listaOpcoesValidasMenuAluno = [1, 2, 3, 4, 5];

    while ($opcao != 5) {
        echo "==== Menu Aluno ====" . PHP_EOL;
        echo "1 - Cadastrar Aluno" . PHP_EOL;
        echo "2 - Listar os alunos" . PHP_EOL;
        echo "3 - Excluir Aluno" . PHP_EOL;
        echo "4 - Atualizar dados Aluno" . PHP_EOL;
        echo "5 - Voltar Menu Principal" . PHP_EOL;

        $opcao = readline("Digite sua opção: ");
        popen('cls', 'w');

        if (!in_array($opcao, $listaOpcoesValidasMenuAluno)) {
            echo "!!!!!  OPÇÃO INVALIDA  !!!!!" . PHP_EOL;
            readline("Enter, para continuar");
        } else {
            verificarOpcaoMenuAluno($opcao);
        }

        popen('cls', 'w');
    }
}


function verificarOpcaoMenuProfessor($opcao)
{
    switch ($opcao) {
        case 1:
            menuCadastroProfessor();
            break;
        case 2:
            menuListarProfessor();
            break;
        case 3:
            menuExcluirProfessor();
            break;
        case 4:
            menuAlterarProfessor();
            break;
        default:
            echo "Erro cód - 001: Não deveria chegar aqui o código" . PHP_EOL;
            break;
    }
}

function menuPrincipalProfessor()
{
    $opcao = 0;
    static $listaOpcoesValidasMenuProfessor = [1, 2, 3, 4, 5];

    while ($opcao != 5) {
        echo "==== Menu Professor ====" . PHP_EOL;
        echo "1 - Cadastrar Professor(a)" . PHP_EOL;
        echo "2 - Listar os Professores" . PHP_EOL;
        echo "3 - Excluir Professor(a)" . PHP_EOL;
        echo "4 - Atualizar dados Professor(a)" . PHP_EOL;
        echo "5 - Voltar Menu Principal" . PHP_EOL;

        $opcao = readline("Digite sua opção: ");
        popen('cls', 'w');

        if (!in_array($opcao, $listaOpcoesValidasMenuProfessor)) {
            echo "!!!!!  OPÇÃO INVALIDA  !!!!!" . PHP_EOL;
            readline("Enter, para continuar");
        } else {
            verificarOpcaoMenuProfessor($opcao);
        }

        popen('cls', 'w');
    }
}

function somarMensalidade($AlunosMemory)
{
    $soma = 0;
    foreach ($AlunosMemory as $aluno) {
        $soma += $aluno["Mensalidade"];
    }

    return $soma;
}

function somarSalario($ProfessorMemory)
{
    $soma = 0;
    foreach ($ProfessorMemory as $professor) {
        $soma += $professor["Salario"];
    }

    return $soma;
}

function calcularRendimento($AlunosMemory, $ProfessorMemory)
{
    $somaMensalidades = somarMensalidade($AlunosMemory);
    $somaSalarios = somarSalario($ProfessorMemory);
    echo "==== Relatorio de rendimentos ====" . PHP_EOL;
    echo "Total de mensalidades: " . $somaMensalidades . PHP_EOL;
    echo "Total de Salarios: " . $somaSalarios . PHP_EOL;
    echo "----------------------------------" . PHP_EOL;
    echo "Diferença = " . ($somaMensalidades - $somaSalarios) . PHP_EOL;
    readline("Enter, para continuar");
}

while ($opcao != 4) {
    echo "==== Menu Principal ====" . PHP_EOL;
    echo "1 - Menu Aluno" . PHP_EOL;
    echo "2 - Menu Professor" . PHP_EOL;
    echo "3 - Calculo de rendimento" . PHP_EOL;
    echo "4 - Sair" . PHP_EOL;

    $opcao = readline("Digite sua opção: ");
    popen('cls', 'w');

    if (!in_array($opcao, $listaOpcoesValidasMenuPrincipal)) {
        echo "!!!!!  OPÇÃO INVALIDA  !!!!!" . PHP_EOL;
        readline("Enter, para continuar");
    } else if ($opcao == 1) {
        menuPrincipalAluno();
    } else if ($opcao == 2) {
        menuPrincipalProfessor();
    } else if ($opcao == 3) {
        calcularRendimento($AlunosMemory, $ProfessorMemory);
    }
}
