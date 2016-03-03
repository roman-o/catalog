
  
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="css/style1.css" media="screen" type="text/css" />
	
</head>
<body>
<div id="container">
 <div id="block">


<?php
define ('ROOT',dirname (__FILE__));
define ('DS', DIRECTORY_SEPARATOR);

$curdir = ROOT;
if ($_GET['curdir']){
	$curdir = $_GET['curdir'];
}
$parent = dirname($curdir);
$files = scandir($curdir);


?>
<a href=ff.php><img style="padding:10px;" src='images/root.png' title="ROOT"></a>
<a href=ff.php?curdir=<?=$parent;?>><img style="padding:10px;" src='images/par.png' title="Parent directory"></a>
<a href=ff.php?curdir=<?=$curdir;?>><img style="padding:10px;" src='images/refresh.png' title="обновить"></a>

<table>
<?php
 
 
foreach ($files as $name){   //вывести папки
	if (($name != '.') AND ($name != '..') ) {
	 if ( is_dir( $curdir.DS.$name ) ){
		 $type= "дириктория";
		  if ( $_GET['filename'] ==$name  ){		
?>
<form action="" method="post">
<input type="hidden" name="filename" value=<?=$_GET['filename'] ;?>>
<tr>
<td class="col1"  ><img src='images/dir.png'></td>
<td class="col2"><input type='text' name='title' value=<?=$_GET['filename']?> ><input type='submit' name='rename' value='переименовать'></form> </td>
<td> <?=$type?></td>
</tr>
<?php
		} 
	 else{
?>
<tr>
<td ><img src='images/dir.png'</td><td><a href=/ff.php?curdir=<?=$curdir.DS.$name.">".$name; ?> </td>
<td><?= $type;?></a></td>
<td class='col3'> <a href=?curdir=<?=$curdir?>&filename=<?=$name?>>Переименовать </a><br></td>
</tr>
<?php		 
	     }	
	 }	
   }
}

foreach ($files as $name){ // вывести файлы
	if (($name != '.') AND ($name != '..') ) {
	 if ( is_file( $curdir.DS.$name ) ){
		$type = "файл";
		 echo "<tr><td class='col1'><img src='images/file.png'></td><td><a href=?curdir=$curdir&filename=$name>$name </td><td>$type</a></td><td></td></tr> ";
		 if ( $_GET['filename'] ==$name  ){
		?>
		<tr><td colspan="4">
		<form action="" method="post">
		<p> Редактировать файл  <?=$_GET['filename'];?>:</p>
		<input type="hidden" name="filename" value=<?=$_GET['filename'] ;?>>
		<input type="hidden" name="curdir" value=<?=$curdir ;?>>
	    <textarea name="file_edit" ><?=file_get_contents($curdir.DS.$_GET['filename']); ?></textarea>
        <input type="submit" name="edit" value="сохранить" >
		</td></tr>
		<?php
		}
	 }	
   }
}
echo "</table>";


if (isset($_POST['rename'])) {  // переименовать папку
	
	if(rename($_GET['curdir'].DS.$_GET['filename'],$_GET['curdir'].DS.$_POST['title'])){	
	?>
	<script language = 'javascript'>
	alert('данные изменены успешно');
  
</script>
	<?
	}
	else {echo "ошибка";
	}

}
if (isset($_POST['edit'])) {   // редактировать файл
	if(file_put_contents($_GET['curdir'].DS.$_POST['filename'],$_POST['file_edit'])){
		?>
	<script language = 'javascript'>
	alert('данные изменены успешно');
   
</script>
	<?
	}
	else {echo "ошибка";
	}
}
?>
	</div>
	</div>
</body>
</html>