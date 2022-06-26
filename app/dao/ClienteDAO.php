<?php
/*
    Criação da classe Cliente com o CRUD
*/
class ClienteDAO{
    
    public function create(Cliente $cliente) {
        try {
            $sql = "INSERT INTO clientes (                   
                  nome,email,telefone)
                  VALUES (
                  :nome,:email,:telefone)";

            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":nome", $cliente->getNome());
            $p_sql->bindValue(":email", $cliente->getEmail());
            $p_sql->bindValue(":telefone", $cliente->getTelefone());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao Inserir cliente <br>" . $e . '<br>';
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM clientes order by nome asc";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaClientes($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
     
    public function update(Cliente $cliente) {
        try {
            $sql = "UPDATE clientes set
                
                  nome=:nome,
                  email=:email,
                  telefone=:telefone          
                                                                       
                  WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":nome", $cliente->getNome());
            $p_sql->bindValue(":email", $cliente->getEmail());
            $p_sql->bindValue(":telefone", $cliente->getTelefone());
$p_sql->bindValue(":id", $cliente->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar atualizar<br> $e <br>";
        }
    }

    public function delete(Cliente $cliente) {
        try {
            $sql = "DELETE FROM clientes WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":id", $cliente->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir cliente<br> $e <br>";
        }
    }



    private function listaClientes($row) {
        $cliente = new Cliente();
        $cliente->setId($row['id']);
        $cliente->setNome($row['nome']);
        $cliente->setEmail($row['email']);
        $cliente->setTelefone($row['telefone']);

        return $cliente;
    }
 }

 ?>
