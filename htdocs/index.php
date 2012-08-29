<?php

$dir=opendir("issues/");

$i=0;
while($file=readdir($dir)) {
  if ($file != "." && $file != ".." && 
    //substr_compare($file, ".swf", -4, 4, true) == 0) {
    is_file($file)) {
      $filearray[$i++]=substr($file, 0, -4);
    }
}
closedir($dir);

rsort($filearray);

if($filearray) {
  $nr=$filearray[0];
  if(isset($_GET['nr'])) {
    $nr=$_GET['nr'];
    if (!in_array($nr, $filearray)) {
      unset($nr);
    }
  }
}

?>
<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title></title>
  <link rel="stylesheet" href="master.css" type="text/css" media="screen" charset="utf-8"/>

<script language="javascript">
</script>
</head>
<body>

<div id="page">
  <div id="header"></div>
  <div id="menu">
    <form method="GET">
    <label for="nr">Select another issue</label>
    <select name="nr" onchange="this.form.submit()">
      <option value="none"></option>
<?php
foreach($filearray as $f) {
  if ($f == $nr) {
  } else {
    print("<option value=\"$f\">$f</option>");
  }
}
?>
    </select>
    </form>
  </div>

  <div id="content">
    <iframe name="flipframe" src="$nr.swf" scrolling="no"></iframe>
  </div>

  <div id="footer"></div>

</div>

</body>
</html>
