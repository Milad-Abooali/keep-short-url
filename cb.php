<?php
   header("Cache-Control: no-cache, no-store, must-revalidate");
   header("Pragma: no-cache");
   header("Expires: 0");
   $links = array(
                  "http://codebox.ir/cbox/rand.php",
                  "http://codebox.ir/cbox/rand.php",
                  "http://codebox.ir/cbox/rand.php",
                  "http://codebox.ir/cbox/rand.php",
                  "http://codebox.ir/cbox/rand.php",
                  "http://codebox.ir/cbox/rand.php",
                  "http://codebox.ir/cbox/rand.php",
                  "http://codebox.ir/cbox/rand.php",
                  "http://codebox.ir/cbox/rand.php",
                  "http://adcart.ir/opendirectory.php"
                  );
   $rand_link = array_rand($links, 2);
   $link = $links[$rand_link[0]];
?>
<html>
   <head>
      <meta http-equiv="cache-control" content="max-age=0" />
      <meta http-equiv="cache-control" content="no-cache" />
      <meta http-equiv="expires" content="0" />
      <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
      <meta http-equiv="pragma" content="no-cache" />
      <script type="text/javascript">
         function delayer()
         {
            window.location = "<?php echo $link; ?>" 
         }
       </script>
   </head>
   <body onLoad="setTimeout('delayer()', 1)">
   </body>
</html>