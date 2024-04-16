<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

  <link rel="stylesheet" href="jquery.rateyo.css"/>
</head>
<body>
    <div class="container">
    <div id="rateYo"></div>
        <div class="row">
            <form action="" method='post'>
                <div>
                    <h3>rating</h3>
                </div>
                <div>
                    <label for="">Name</label>
                    <input type="text" name='name'>
                </div>
                <div id="rateYo" id ="rating" 
                data-rateyo-rating="4"
                data-rateyo-rating="5"
                data-rateyo-rating="3"
                >
                </div>

 
 
  <script src="jquery.js"></script>
  <script src="jquery.rateyo.js"></script>
                <span class='result'>0</span>
                <input type="hidden" name="rating">

                <input type="submit" name='add'>
            </form>
        </div>
    </div>
    <script href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>
    $(function (){
        $(".rateyo").rateYo().on("rateyo.change",function (e,data){
            var rating = data.rating;
            $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :' + rating);
            $(this).parent().find('input[name=rating]').val(rating);
        });
    });
</script>
</body>
</html>

<?php
$pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $rating = $_POST['rating'];

    $query = "INSERT INTO rating (Full_name,rating) VALUES (?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($name,$rating));

}