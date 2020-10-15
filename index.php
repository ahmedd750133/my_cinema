
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
            <h2> FILM</h2>

<form  action ='index.php' method="get">
    <input  type ='hidden' name ='page'>
    <input type="text" name="search">
    <button class="btn1" type="submit"  name= "film"> FILM</button>
    <button class="btn1" type= "submit" name= "genre">GENRE</button>
    <button class="btn1"type="submit" name= "distrib">DISTRIBUTEUR</button>
</form>
</section>
</body>
</html>


<?php




/********************************** TITRE DE FILM ************************************************************************************************************/
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


if (isset($_GET["film"])){
    $str = $_GET ["search"];
    $genreTotalsReq = $pdo->query("SELECT titre FROM film WHERE titre LIKE '%$str%'");
    $genreTotales =$genreTotalsReq ->rowCount();
    $pagesTotales = ceil($genreTotales/$genreParPage);
 
    $film = $pdo -> query("SELECT titre,resum FROM film WHERE titre LIKE '%$str%' ORDER BY titre ASC LIMIT $depart,$genreParPage ");
   
  
while ($tr = $film-> fetch(PDO::FETCH_OBJ))
{
?>

    <br>

    <table>
         <tr>
             <th>Titre </th>
             <th>Resum</th>
             
          </tr>
          <tr>
          <td>
             <?php echo $tr->titre . "<br>";?>
            </td>
            <td>
             <?php echo $tr->resum . "<br>";?>
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
        echo '<a class="ahh" href="index.php?page='.$i.'&search='.$str.'&film=">'.$i.'</a>';
    }
}
}



/******************************GENRE FILM*****************************************************************************************************************/

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


if (isset($_GET["genre"])){
    $str = $_GET ["search"];
    $genreTotalsReq = $pdo->query("SELECT id_film FROM `film` LEFT JOIN `genre` ON genre.id_genre = film.id_genre WHERE nom ='$str'");
    $genreTotales =$genreTotalsReq ->rowCount();
    $pagesTotales = ceil($genreTotales/$genreParPage);
 
    $sth = $pdo -> query("SELECT titre FROM `film` LEFT JOIN `genre` ON genre.id_genre = film.id_genre WHERE nom ='$str' LIMIT $depart,$genreParPage");
   
     
    while ($tr = $sth -> fetch(PDO::FETCH_OBJ))
    
    { ?>
        <br>

        <table>
                <th>Nom du film</th>
             <tr>
             <tr>
            <td>
                <?php echo $tr->titre ."<br>";?>
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
            echo '<a class="ahh" href="index.php?page='.$i.'&search='.$str.'&genre=">'.$i.'</a>';
        }
    }
    

}           

/******************************* DISTRIBUTEUR DE FILM *************************************************************************************************/

    
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


if (isset($_GET["distrib"])){
    $str = $_GET ["search"];
    $genreTotalsReq = $pdo->query("SELECT id_film FROM film LEFT JOIN distrib ON distrib.id_distrib = film.id_distrib WHERE nom='$str'");
    $genreTotales =$genreTotalsReq ->rowCount();
    $pagesTotales = ceil($genreTotales/$genreParPage);


    $dist = $pdo -> query("SELECT nom,titre FROM film LEFT JOIN distrib ON distrib.id_distrib = film.id_distrib WHERE nom ='$str' LIMIT $depart,$genreParPage");
   

    while ($tr = $dist-> fetch(PDO::FETCH_OBJ))
    
    { ?>
        <br>

        <table>
                <th>Distributeur</th>
             <tr>
             <td>
                <?php echo $tr->titre ."<br>";?>
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
            echo '<a class="ahh" href="index.php?page='.$i.'&search='.$str.'&distrib=">'.$i.'</a>';;
        }
    }
    

}
   
?>