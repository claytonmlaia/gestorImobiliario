<?php
/*
    Criação da classe Usuario com o CRUD
*/
class ProprietarioDAO{
    
    public function create(Proprietario $proprietario) {
        try {
            $sql = "INSERT INTO proprietarios (                   
                  nome,email,telefone,dia_repasse)
                  VALUES (
                  :nome,:email,:telefone,:dia_repasse)";

            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":nome", $proprietario->getNome());
            $p_sql->bindValue(":email", $proprietario->getEmail());
            $p_sql->bindValue(":telefone", $proprietario->getTelefone());
            $p_sql->bindValue(":dia_repasse", $proprietario->getDiaRepasse());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao Inserir proprietário <br>" . $e . '<br>';
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM proprietarios order by nome asc";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaProprietarios($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
     
    public function update(Proprietario $proprietario) {
        try {
            $sql = "UPDATE proprietarios set
                
                  nome=:nome,
                  email=:email,
                  telefone=:telefone,
                  dia_repasse=:dia_repasse                  
                                                                       
                  WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":nome", $proprietario->getNome());
            $p_sql->bindValue(":email", $proprietario->getEmail());
            $p_sql->bindValue(":telefone", $proprietario->getTelefone());
            $p_sql->bindValue(":dia_repasse", $proprietario->getDiaRepasse());
            $p_sql->bindValue(":id", $proprietario->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    public function delete(Proprietario $proprietario) {
        try {
            $sql = "DELETE FROM proprietarios WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":id", $proprietario->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir proprietario<br> $e <br>";
        }
    }


    

    private function listaProprietarios($row) {
      $proprietario = new Proprietario();
      $proprietario->setId($row['id']);
      $proprietario->setNome($row['nome']);
      $proprietario->setEmail($row['email']);
      $proprietario->setTelefone($row['telefone']);
      $proprietario->setDiaRepasse($row['dia_repasse']);

        return $proprietario;
    }
 }

 ?>
