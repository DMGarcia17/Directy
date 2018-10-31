<?php
$db = null;

header('Content-Type: application/json; charset=utf-8');

function listar_busqueda_empresas(PDO $data, $filtro)
{
    $query = $data->prepare("SELECT *
        FROM products
        WHERE name LIKE '%$filtro%'");
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $final['products'] = $res;

    return json_encode($final);
}

function listar_una_empresa(PDO $data, $filtro)
{
    $query = $data->prepare("SELECT *
        FROM products
        WHERE id_pro=$filtro");
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $final['products'] = $res;

    return json_encode($final);
}

function listar_detalles(PDO $data, $filtro)
{
    $query = $data->prepare("SELECT *
        FROM users
        WHERE username='$filtro'");
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $final['products'] = $res;

    return json_encode($final);
}

function login(PDO $data)
{
    $query = $data->prepare("SELECT * FROM users WHERE username = '{$_REQUEST['user']}'
      AND passwd = '" . base64_encode($_REQUEST['passwd']) . "'");
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    if (count($res) == 1) {
        $proc = implode("@", $res[0]);
        return "true@".$proc;
    } else {
        return "error@error";
    }
}

function registrar_usuario(PDO $data)
{
    try {
        mkdir('users/' . $_REQUEST['user'] . '/', 0777);
        mkdir('users/' . $_REQUEST['user'] . '/products/', 0777);
        $filename = 'logo.png';
        $path = 'users/' . $_REQUEST['user'] . '/' . $filename;
        file_put_contents($path, base64_decode($_REQUEST['img']));
        $sql = "INSERT INTO users
            VALUES ('{$_REQUEST['user']}', '" . base64_encode($_REQUEST['pass']) . "',
            '{$_REQUEST['company']}', '{$_REQUEST['locat']}', '$path', '{$_REQUEST['descrip']}')";
        $query = $data->prepare($sql);
        if ($query->execute()) {
            return 'true';
        } else {
            return 'false';
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function registrar_producto(PDO $data, $string)
{
    try {
        $res = explode('||', $string);
        $filename = $res[3];
        $path = 'users/' . $res[0] . '/' . $filename;
        file_put_contents($path, base64_decode($res[3]));
        $sql = "INSERT INTO products
        VALUES ('{$res[0]}', '{$res[1]}', '{$res[2]}', '$path', '{$res[4]}')";
        $query = $data->prepare($sql);
        if ($query->execute()) {
            return json_encode($result['res'] = 'Registro Existoso');
        } else {
            return json_encode($result['res'] = 'Registro Fallido');
        }
    } catch (Exception $e) {
        return json_encode($result['res'] = 'Registro Fallido' . $e->getMessage());
    }
}

function volcado(PDO $data)
{
    try{
        $res = $data->prepare("SELECT * FROM products");
        if($res->execute()){
            $r = $res->fetchAll(PDO::FETCH_ASSOC);
            $final['products'][] = $res[0]['img'];
            print_r($final);
            echo json_encode($final);
        }else{
            print_r($r);
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }

}


try {
    if ($db = new PDO('mysql:host=localhost;dbname=foodapp', 'root', '')) {
        // echo "Conexion establecida";
    } else {
        // echo "Fallo";
    }
    if ($_REQUEST['key'] == 'AJZfpodVtaCFQO5TKpV8PE7qLlKiAbNglPeNhoiudyD3LsEE2RlFq6pe') {
        switch ($_REQUEST['act']) {
      case 1:
        echo listar_busqueda_empresas($db, $_REQUEST['filtro']);
        break;
      case 2:
        echo registrar_usuario($db);
        break;
      case 3:
        echo login($db);
        break;
      case 4:
        echo volcado($db);
        break;
      case 5:
        echo listar_una_empresa($db, $_REQUEST['filtro']);
        break;
      case 6:
          listar_detalles($db, $_REQUEST['filtro']);
          break;

    }
    }
} catch (Exception $e) {
    echo $e->getMessage();
    print_r($db);
}
