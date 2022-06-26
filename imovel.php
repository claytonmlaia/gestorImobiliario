<?php
include_once "./app/conexao/Conexao.php";
include_once "./app/dao/ImovelDAO.php";
include_once "./app/model/Imovel.php";
include_once "./app/dao/ProprietarioDAO.php";
include_once "./app/model/Proprietario.php";

//instancia as classes
$proprietario = new Proprietario();
$proprietariodao = new ProprietarioDAO();
$imovel = new Imovel();
$imoveldao = new ImovelDAO();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Cadastro de Imoveis</title>
    <style>
        .menu,
        thead {
            background-color: #bbb !important;
        }

        .row {
            padding: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light menu">
        <div class="container">
            <a class="navbar-brand" href="#">
                Cadastro de Imoveis
            </a>
        </div>
    </nav>
    <div class="container">
        <form action="app/controller/ImovelController.php" method="POST">
            <div class="row">
                <div class="col-md-8">
                    <label>Endereço</label>
                    <input type="text" name="endereco" value="" autofocus class="form-control" require />
                </div>
                <div class="col-md-4">
                    <label>Proprietario</label>
                    <select name="proprietarios_id" class="form-control">
                      <?php foreach ($proprietariodao->read() as $proprietario) : ?>
                        <option value="<?= $proprietario->getId() ?>"><?= $proprietario->getNome() ?></option>
                      <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <br>
                    <button class="btn btn-primary" type="submit" name="cadastrar">Cadastrar</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Endereço</th>
                        <th>Proprietario</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($imoveldao->read() as $imovel) : ?>
                        <tr>
                            <td><?= $imovel->getId() ?></td>
                            <td><?= $imovel->getEndereco() ?></td>
                            <td><?= $imovel->getProprietariosId() ?></td>
                            <td class="text-center">
                                <button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar><?= $imovel->getId() ?>">
                                    Editar
                                </button>
                                <a href="app/controller/ImovelController.php?del=<?= $imovel->getId() ?>">
                                <button class="btn  btn-danger btn-sm" type="button">Excluir</button>
                                </a>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editar><?= $imovel->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="app/controller/ImovelController.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Endereço</label>
                                                    <input type="text" name="endereco" value="<?= $imovel->getEndereco() ?>" class="form-control" require />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Proprietario</label>
                                                    <select name="proprietarios_id" class="form-control">
                                                      <?php foreach ($proprietariodao->read() as $proprietario) : ?>
                                                          <option value="<?= $proprietario->getId() ?>"><?= $proprietario->getNome() ?></option>
                                                      <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <br>
                                                    <input type="hidden" name="id" value="<?= $imovel->getId() ?>" />
                                                    <button class="btn btn-primary" type="submit" name="editar">Atualizar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </tbody>
            </table>
            <a class="btn btn-primary" href="/"> Inicio</a>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>