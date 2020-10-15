<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <title>My_cinema</title>
   
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light blue">
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <a href="index.html"> <h1> MY_CINEMA</h1></a>
                   

                        <a class="nav-link" href="membre.php">MEMBRE</a>
    
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">FILM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="abonnement.php">ABONNEMENT</a>
                    </li>
                   
    
                    
                </ul>
            </div>
    
           
        </nav>
    </header>
    <img class="hh"src="hh.jpg">
<section>
<div class="btn" >
    <h2> ABONNEMENT</h2>
    <form method="get">

<input type="text" name="search">
<input type="submit" name="submit1">

</div>

</form>
</section>
</body>
</html>



<?php

$pdo = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8','root','');

$genreParPage = 10;


if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0)  
{
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
 
}
else{
    $pageCourante = 1;
}
$depart =($pageCourante -1)*$genreParPage;



if (isset($_GET["submit1"])){
 $str = $_GET ["search"];
 $genreTotalsReq = $pdo->query("SELECT id_perso FROM `fiche_personne` WHERE prenom LIKE '%$str%'");
 $genreTotales =$genreTotalsReq ->rowCount();
 $pagesTotales = ceil($genreTotales/$genreParPage);

 $sth = $pdo -> query("SELECT fiche_personne.nom,prenom,abonnement.nom
  AS \"abonom\" FROM fiche_personne LEFT OUTER JOIN membre ON fiche_personne.id_perso = membre.id_fiche_perso 
  LEFT OUTER JOIN abonnement ON membre.id_abo = abonnement.id_abo LIMIT $depart,$genreParPage;
 ");



 while ($tr = $sth -> fetch(PDO::FETCH_OBJ))
 { //var_dump($tr)?>
     <br>

     <table>
         <tr>
             <th>Nom</th>
             <th> Prenom</th>
             <th>abonnement</th>
            </tr>
          <tr>
          <td>
             <?php echo $tr->nom . "<br>";?>
        </td>
        <td>
             <?php echo $tr->prenom . "<br>";?>
            
            </td>

          <td>
           <?php echo $tr->abonom . "<br>";?>
          
           </td>
          
          </tr>
         
        </table>
        <br><br>
        <?php
 }
 for($i=1;$i<=$pagesTotales;$i++)
 {
     if(isset($_GET['search'])) 
     {
         echo '<a href="abonnement.php?page='.$i.'&search='.$str.'&submit1=">'.$i.'</a>';
     }
    }
    }


?>