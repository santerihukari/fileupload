<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="styles.css">
</head>

<script>
$(document).ready(function(){
  $(document).on('mouseover','.preview',function(){
    var path_source=$(this).attr('href');
    $("iframe").attr("src",path_source);
    $("iframe").show();
  });
  $(document).on('mouseout','.preview',function(){
//    $("iframe").hide();

  });

});
</script>
<body>
<!--<a href="12/12-1.pdf" class="preview">Link</a>-->
<div class="box">
  <iframe src="" width="50%" height="100%" style="display:none; position:fixed;">
  </iframe>
</div>


<div style="float: right;">


  <!-- action="upload.php" method="post" -->

<div id="FileUpload">
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload" multiple><br>
    <input type="submit" value="Upload" name="submit">
  </form>

</div>



  <div style="overflow: auto; height: 100%;">

  <?php
    function cmp1($a, $b){
      if (substr_count($a,'-') == 0) {
        return 0;
      }
      $tosite = explode(".",$a);
      $tosite = explode(".",$b);
      $ea = explode("-",$tosite[0]);
      $eb = explode("-",$tosite[0]);
      $maxseries = max([count($ea),count($eb)]);
      for ($x = 0; $x <= 3; $x++) {
        if ($ea[$x] < $eb[$x]) {
          return 0;
        }
        else if ($ea[$x] > $eb[$x]) {
          return 1;
        }
      }
      return 0;
    }

    function cmp($a, $b){
      if (substr_count($a,'-') == 0) {
        return 0;
      }
      $tosite = explode(".",$a);
      $tosite = explode(".",$b);
      $ea = explode("-",$tosite[0]);
      $eb = explode("-",$tosite[0]);
      
      if ((int)$ea[1] < (int)$eb[1]) {
        return 0;
      }
      else if ((int)$ea[1] > (int)$eb[1]) {
        return 1;
      }
      else if ((int)$ea[2] < (int)$eb[2]) {
        return 0;
      }
      else if ((int)$ea[2] > (int)$eb[2]) {
        return 1;
      }
    }
  
  
    $filenames = array();
    $dir = 'files/';
    if ($handle = opendir($dir)) {
      while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
          array_push($filenames,$entry);
        }
      }
      closedir($handle);
    }
#    echo(sizeof($filenames));
#    usort($filenames, "cmp1");
    sort($filenames, SORT_NATURAL);
    foreach($filenames as $key => $value)
    {
#      if (substr_count($value, '-') > 0) {
        echo '<a href="'.$dir.$value.'" class="preview">'.$value.'</a><br>';
#      }
    }
  ?>



  </div>
</div>
</body>
</html>