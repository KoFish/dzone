<?php

function cmp($a, $b) {
  /* Assumes that the directory containing a issue has the format 
   * <name of the issue>_nr_NN_YYYY where NN is any number of numbers and YYYY 
   * is the year of publication.
   */
  $cmp_pattern = "/_nr_([0-9]*)_([0-9]{4})/";
  if ((preg_match($cmp_pattern, $a[1], $a_) == 0) || (preg_match($cmp_pattern, $b[1], $b_) == 0)) {
    strcmp($a[1],$b[1]);
  }
  $a = $a_[2].$a_[1];
  $b = $b_[2].$b_[1];

  return intval($a) > intval($b);
}

$dir=opendir("issues/");

$i=0;
while($file=readdir($dir)) {
  if ($file != "." && $file != ".." && 
    is_dir("issues/".$file)) {
      $filearray[$i++]=Array(str_replace("_", " ", $file), $file);
    }
}

closedir($dir);


if(isset($filearray) && $filearray) {
  usort($filearray, "cmp");
  $issue=$filearray[0];
  if(isset($_GET['issue'])) {
    $issue=$_GET['issue'];
    $is=false;
    foreach($filearray as $f) {
      if ($issue == $filearray[1]) {
        $is=true;
        break;
      }
    }
    if (!$is) unset($issue);
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
function switchIssue(sel) {
  selIndex = sel.selectedIndex;
  if (sel.options[selIndex].value != "none") {
    frames['flipframe'].location.href = "issues/" + sel.options[selIndex].value;
  }
}
</script>
</head>
<body>

<div id="topborder"></div>

<div id="page">
  <div id="header">
    <div id="menu">
      <form method="GET">
      <label for="issue">Välj nummer här:</label>
      <select name="issue" onchange="switchIssue(this.form.issue)">
        <!-- option value="none"></option -->
<?php
foreach($filearray as $f) {
  print("      <option value=\"$f[1]\"".(($f[1] == $issue) ? " SELECTED" : "").">$f[0]</option>\n");
}
?>
      </select>
      </form>
    </div>
    <img src="nukandu.jpg">
  </div>

  <div id="content">
  <iframe name="flipframe" src="<?php echo("issues/".$f); ?>" scrolling="no"></iframe>
  </div>

  <div id="footer">
    <span id="footer-img"></span>
    <span>
      <strong>Besöksadress:</strong>
      <blockquote>
        Brightpoint Sweden AB<br/>
        Falkenbergsgatan 3</br>
        SE-412 85 Gothenburg
      </blockquote>
    </span>
    <span>
      <strong>Kontakta växeln:</strong>
      <blockquote>
        Tel: 000-000000<br/>
        info@brightpoint.se
      </blockquote>
    </span>
    <span>
      <strong>Order och kundsupport</strong>
      <blockquote>
        Tel: 000-000000<br/>
        info@brightpoint.se
      </blockquote>
    </span>
    <span>
      <a href="www.brightpoint.com">www.BrightPoint.com</a>
    </span>
  </div>

</div>

</body>
</html>
