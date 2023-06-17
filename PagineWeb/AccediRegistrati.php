<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="C:\Users\Administrator\Desktop\Basi-Di-dati\CSSPagineWeb\AccediRegistrati.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Accedi/Registrati</title>
</head> 

<body>
     <!-- freccia di ritorno -->
     <a href="C:\Users\Administrator\Desktop\Basi-Di-dati\Home.php" class="back-button">
      <i class="fas fa-arrow-left"></i>
    </a>

  <h1>Accedi/Registrati</h1>

  <div class="button-container">
    <button onclick="showLoginForm()">Accedi</button>
    <button onclick="showRegistrationForm()">Registrati</button>
  </div>

  <div class="form-container">
    <form id="loginForm" style="display: none;">
      <h2>Accedi</h2>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username">

      <label for="password">Password:</label>
      <div class="password-container">
        <input type="password" id="password" name="password">
        <i class="fas fa-eye" id="showPassword"></i>
      </div>

      <input type="submit" value="Accedi">
    </form>

    <form id="registrationForm" style="display: none;">
      <h2>Registrati</h2>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username">

      <label for="password">Password:</label>
      <div class="password-container">
        <input type="password" id="password" name="password">
        <i class="fas fa-eye" id="showPassword"></i>
      </div>

      <input type="submit" value="Registrati">
    </form>
  </div>

  <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
  <script src="AccediRegistrati.js"></script>
</body>

</html>
