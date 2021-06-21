

<?php
include_once 'config/database.php';
include_once 'objects/class.pdf2text.php';


$uploaddir = '/var/www/php/api/arquivos/';
$uploadfile = $uploaddir . basename($_FILES['uploaded_file']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $uploadfile)) {
    echo "Arquivo válido e enviado com sucesso.\n";
} else {
    echo "Possível ataque de upload de arquivo!\n";
}

// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {
    
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {

        $allowedExts = array("pdf");
        $temp = explode(".", $_FILES['uploaded_file']['name']);
        // echo $_FILES['uploaded_file']['name'];
        
        $extension = end($temp);
        $upload_pdf=$_FILES['uploaded_file']['name'];

        $newFile = new PDF2Text();
        $newFile->setFilename($_FILES['uploaded_file']['name']);
        $newFile->decodePDF();

        $myfile = fopen("output.txt", "w") or die("Nao foi capaz de abrir o arquivo!");
        fwrite($myfile, $newFile->output());
        fclose($myfile);
        
        echo $newFile->output();

        $output = shell_exec('conversor.py '.$uploadfile);

    }
    else {
        echo 'Um erro ocorreu ao abrir o arquivo, verifique se o arquivo possui espacos no nome. '
           . 'Codigo de erro: '. intval($_FILES['uploaded_file']['error']);
    }
 
}
else {
    echo 'Erro! Arquivo nao enviado!';
}
 
$filename = pathinfo($_FILES['uploaded_file']['name'], PATHINFO_FILENAME);

$input = shell_exec('transmitir.py '.$uploaddir.$filename.'.txt'.' 0');

echo '<p>Clique <a href="../index.html">aqui</a> para voltar!</p>';

?>


<html>

<link rel="stylesheet" href="spreeder.css">
<script src="spreeder.js"></script>
  <script>try{Typekit.load();}catch(e){}</script>

  <div id="container">
    <span id="left-string"></span><span id="center-character"></span><span id="right-string"></span>
  </div>

<div class="controls">
  <div class="current-wpm"><span id="wpm">150</span><span class="below">ppm</span></div>
  <div class="slider">
    <input id="wpm-slider" type="range" min="150" max="950" value="150" step="100">
  </div>
  <input type="button" id="playpause" value="Iniciar/Pausar" class="icon-play2" ></input>
</div>

  <textarea id="input-text"><?php echo $input; ?></textarea>


  <span id="test-width"></span>


</html>