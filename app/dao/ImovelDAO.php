<?php

class ImovelDAO{
    
    public function create(Imovel $imovel) {
        try {
            $sql = "INSERT INTO imoveis (                   
                  endereco,proprietarios_id)
                  VALUES (
                  :endereco,:proprietarios_id)";

            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":endereco", $imovel->getEndereco());
            $p_sql->bindValue(":proprietarios_id", $imovel->getProprietariosId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao Inserir imovel <br>" . $e . '<br>';
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM imoveis 
                    order by imoveis.id asc";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaImoveis($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
     
    public function update(Imovel $imovel) {
        try {
            $sql = "UPDATE imoveis set
                
                  endereco=:endereco,
                  proprietarios_id=:proprietarios_id
                                                                       
                  WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":endereco", $imovel->getEndereco());
            $p_sql->bindValue(":proprietarios_id", $imovel->getProprietariosId());
            $p_sql->bindValue(":id", $imovel->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    public function delete(Imovel $imovel) {
        try {
            $sql = "DELETE FROM imoveis WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":id", $imovel->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir imovel<br> $e <br>";
        }
    }


    

    private function listaImoveis($row) {
      $imovel = new Imovel();
      $imovel->setId($row['id']);
      $imovel->setEndereco($row['endereco']);
      $imovel->setProprietariosId($row['proprietarios_id']);

        return $imovel;
    }
 }

 ?>
