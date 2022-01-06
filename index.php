<?php
     $base_url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/coba/ajax-page/';
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Ajax - Page</title>
     <style>
          body{
               margin: 0;
          }

          div{
               padding: 5px;
          }

          div a{
               display: block;
          }

          h4{
               margin: 2px 0px;
          }

          .satu{
               width: 130px;
          }
     </style>
</head>

<body>

     <div style="display: flex;">
          <div>
               <h4>Cara 1</h4>
               <div class="satu">
                    <a href="<?php echo $base_url ?>home">Home</a>
                    <a href="<?php echo $base_url ?>profile">Profile</a>

               </div>

               <h4 style="margin-top:100px">Cara 2</h4>
               <div>
                    <a href="#home">Home</a>
                    <a href="#profile">Profile</a>

               </div>

          </div>
          <div id="main-page" style="border: 1px solid #eee; height: 100vh; width: 100%;"></div>
     </div>

     <script src="<?php echo $base_url ?>js/jquery-3.6.0.min.js"></script>
     <script>

          function getPage(url){

               $.ajax({
                    url : url,
                    dataType: 'html',
                    beforeSend: function(){
                         //Tambah animasi loading...

                    },
                    success: function(content){
                         $('#main-page').html(content);
                    }
               })

          }
          
          // Cara Satu
          //menghentikan pindah halaman saat click link
          $(document).on('click', '.satu a', function(e){

               //hentikan action click
               e.preventDefault();

               var p = $(this).attr('href'); 

               p = p.replace('<?php echo $base_url ?>', '');

               var url = '<?php echo $base_url ?>/php/'+ p +'.php';

               getPage( url );

               //mengubah URL browser
               window.history.pushState({}, '', '<?php echo $base_url ?>' + p);

          })

          // -------------------------------


          // Cara 2
          // membaca perubahan Hash URL
          $(window).on('hashchange', function(){
               var p = window.location.hash;

               p = p.replace('#', '');

               var url = '<?php echo $base_url ?>/php/'+ p +'.php';

               getPage(url);
          })



     </script>
</body>

</html>