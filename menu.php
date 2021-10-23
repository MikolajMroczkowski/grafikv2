<?php
session_start();
function renderMenu($page){
    switch($page){
      case "edit":
        $_mode = ["active","","","",""];
        break;
      case "view":
        $_mode = ["","active","","",""];
        break;
      case "settings":
        $_mode = ["","","active","",""];
        break;
      case "adminManage":
         $_mode = ["","","","active",""];
         break;
         case "adminView":
           $_mode = ["","","","","active"];
           break;

    }
echo '
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">e-grafik</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link '.$_mode[0].'" aria-current="page" href="index.php">Edycja</a>
        </li>
        <li class="nav-item">
          <a class="nav-link '.$_mode[1].'" href="view.php">Wyświetl</a>
        </li>
        <li class="nav-item">
          <a class="nav-link '.$_mode[2].'" href="settings.php">Ustawienia</a>
          </li>
          ';
          if($_SESSION['isAdmin']){
            echo '<li class="nav-item">
            <a class="nav-link '.$_mode[3].'" href="admManage.php">Zarządzaj Aplikacją</a>
            </li>
            <li class="nav-item">
          <a class="nav-link '.$_mode[4].'" href="admView.php">Przeglądaj Wpisy</a>
          </li>';
          }
          echo'
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="nav-item">
    <a class="nav-link" href="logout.php">Wyloguj się</a>
    </li>
  </ul>
      
    </div>
  </div>
</nav>
';
  }
