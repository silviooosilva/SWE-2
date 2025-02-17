<?php

require_once __DIR__ . '/vendor/autoload.php';
use Silviooosilva\Clarifiquei\Models\Engineer;
use Silviooosilva\Clarifiquei\Models\Task;

$Engineer = new Engineer();
$Task = new Task();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SWE 2 - HOME</title>
  <link rel="stylesheet" href="./public/assets/style/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
  <header class="cabecalho _fixo fixed-top w-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-5 py-2">
      <div class="container-fluid py-1">
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse mx-4 justify-content-between w-100">
        <h1>SWE 2</h1>

      <ul class="navbar-nav">
        <li class="__caminho nav-item rounded _ativado"><a href="./home.php" class="nav-link">Visão Geral</a></li>
        </li>
      </ul>
    <li class="nav-item rounded" style="list-style: none;">Sair</li>
      </div>
      </div>
    </nav>
  </header>

 <div class="container" style="margin-top: 120px;">

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn__cadastro" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Cadastrar novo Engenheiro
</button>

<button type="button" class="btn btn-primary btn__tarefa" data-bs-toggle="modal" data-bs-target="#exampleModalTarefa">
  Cadastrar nova Tarefa
</button>



<div class="form-section" style="margin-top: 70px;">
            <h2>Alocação de Tarefas</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Engenheiro</th>
                        <th>Tarefa</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

<?php

$tasks = $Task->getAllocations();
if(!$tasks) {
    echo '<tr><td colspan="4">Nenhuma tarefa encontrada</td></tr>';
}
foreach($tasks as $task):
?>

                    <tr>
                        <td><?= $task['engineer_name']; ?></td>
                        <td><?= $task['task_name']; ?></td>
                        <td><?= $task['status'] ?></td>
                        <td>

                        <?php if($task['status'] === 'Pendente'): ?>
                            <button class="btn btn-primary" id="startTask" type="submit" value="<?= $task['id']; ?>">Iniciar tarefa</button>

                        <?php elseif($task['status'] === 'Em andamento'): ?>
                            <button class="btn btn-success" id="finishTask" type="submit" value="<?= $task['id']; ?>">Concluir tarefa</button>

                            <button class="btn btn-outline-danger" id="closeTask" type="submit" value="<?= $task['id']; ?>">Encerrar tarefa</button>
                        <?php endif; ?>

                        </td>
                    </tr>

<?php endforeach; ?>
                </tbody>
            </table>
        </div>


<div class="form-section mt-5">
    <h2>Relatório de Alocação</h2>
    <?php
        $engineers = $Engineer->index();
        $labels = [];
        $progressList = [];
        if($engineers) {
            foreach($engineers as $engineer):
                $tasks = $Task->findByEngineer($engineer['id']);
                $totalHours = 0;
                $workedHours = 0;
                foreach($tasks as $task) {
                    $totalHours += $task['time'];
                    if($task['status'] === 'Concluída' || $task['status'] === 'Encerrada') {
                        $workedHours += $task['time'];
                    }
                }
                $progress = ($totalHours > 0) ? ($workedHours / $totalHours) * 100 : 0;
                $labels[] = $engineer['name'];
                $progressList[] = $progress;
            endforeach;
        }
    ?>
    <canvas id="progressChart"></canvas>
</div>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastro de novo Engenheiro</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form id="formEngineer" action="#" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="engineerName">Nome</label>
                    <input type="text" class="form-control" id="engineerName" placeholder="Nome do Engenheiro" name="engineerName">
                </div>
                <div class="form-group">
                    <label for="workload">Carga Máxima de Trabalho (horas)</label>
                    <input type="number" class="form-control" id="workload" placeholder="Carga Máxima" name="workload">
                </div>
                <div class="form-group">
                    <label for="efficiency">Eficiência (%)</label>
                    <input type="number" class="form-control" id="efficiency" placeholder="Eficiência" name="efficiency">
                </div>
            <button type="submit" class="btn btn-primary btn__submit mt-2">Cadastrar engenheiro</button>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalTarefa" tabindex="-1" aria-labelledby="exampleModalLabelTarefa" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabelTarefa">Cadastro de nova Tarefa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form id="formTask" action="#" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="taskName">Nome</label>
                    <input type="text" class="form-control" id="taskName" placeholder="Nome da Tarefa" name="taskName">
                </div>
                <div class="form-group">
                    <label for="priority">Prioridade</label>
                    <select class="form-control" id="priority" name="priority">
                        <option>Alta</option>
                        <option>Média</option>
                        <option>Baixa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="time">Tempo (horas)</label>
                    <input type="number" class="form-control" id="time" placeholder="Tempo Estimado" name="time">
                </div>

                 <div class="form-group">
                    <label for="priority">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option>Pendente</option>
                        <option>Em andamento</option>
                        <option>Concluído</option>
                    </select>
                </div>

            <button type="submit" class="btn btn-primary mt-2 btn__submit">Cadastrar tarefa</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
    </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="./public/assets/script/Engineer.js"></script>
<script src="./public/assets/script/Task.js"></script>
<script>
  const ctx = document.getElementById('progressChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($labels, JSON_UNESCAPED_UNICODE) ?>,
      datasets: [{
        label: 'Progresso (%)',
        data: <?= json_encode($progressList) ?>,
        backgroundColor: 'rgba(13, 110, 253, 0.5)'  // updated to match the project's base color
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true, max: 100 }
      },
      plugins: {
        legend: { display: false }
      }
    }
  });
</script>
</body>
</html>