<?php
// Incluir la biblioteca de Firebase
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

// Configurar la conexión con Firebase
$factory = (new Factory)->withServiceAccount('..\json\desafio2-243d6-c3eb86795710.json');
$auth = $factory->createAuth();

// Obtener los datos enviados desde el formulario
$email = $_POST['email'];
$password = $_POST['password'];

try {
  // Autenticar al usuario con Firebase
  $signInResult = $auth->signInWithEmailAndPassword($email, $password);
  
  // Obtener el token de acceso del usuario
  $idToken = $signInResult->idToken();

  // Aquí puedes realizar cualquier acción adicional que necesites, como redireccionar al usuario a otra página o almacenar información en sesiones.

  // Ejemplo: Redireccionar al usuario a una página de bienvenida
  header('Location: welcome.php');
  exit;
} catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $e) {
  // Manejar el error de contraseña incorrecta
  echo 'Contraseña incorrecta';
} catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
  // Manejar el error de usuario no encontrado
  echo 'Usuario no encontrado';
} catch (\Exception $e) {
  // Manejar cualquier otro error
  echo 'Error: ' . $e->getMessage();
}
?>
