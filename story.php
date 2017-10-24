<?php
require_once 'db.php';


//query for page text
$query1 ="
SELECT * FROM `chapter` 
WHERE`chapter`.`id` = ?
";
$statement1= db::query($query1, [$_GET['chapter']]);
$data1 = $statement1->fetchAll();


//query for choices
$query2 = "
SELECT * FROM `chapter` 
JOIN `choice`
ON `chapter`.`id`=`choice`.`chapter_id` 
WHERE`chapter`.`id` = ?
";
$statement2= db::query($query2, [$_GET['chapter']]);
$data2 = $statement2->fetchAll();

//var_dump($data1);
//var_dump($data2);

//query for illustrations
$query3="
SELECT * FROM `chapter` 
JOIN `illustration`
ON `chapter`.`id`=`illustration`.`chapter_id` 
WHERE`chapter`.`id` = ?
";

$statement3= db::query($query3, [$_GET['chapter']]);
$data3 = $statement3->fetchAll();

//var_dump($data3);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Secret of the Pyramids</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>



<div class="container">
<div class="row">
<div class="col chapter-text">

    <?php  echo $data1[0][2]; ?>

</div>


<div class="col illustration">

    <?php    echo '<img src="img/'.$data3[0]['filename'].'"  alt="">';    ?>

</div>

<div class="col chapter-choice">



<form action="story.php" method="GET">


<?php foreach($data2 as $x => $x_value) : ?>
<button type="submit" name="chapter" value="<?php echo $data2[$x]['goto_id'] ?> "><?php echo $data2[$x]['text']?></button>
<?php endforeach ?>
</form>


</div>

</div>

</div>

<?php
//var_dump($_GET);
//echo $_GET['chapter'];
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>

