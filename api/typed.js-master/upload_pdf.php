<html>
    <body>
        <div>
            
        </div>
<script src = "typed.js" > </script>
<div id="typed-strings">
     <p>Typed.js is a <strong>JavaScript</strong> library.</p>
     <p>It can type anything you want</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

<script>
  var typed = new Typed('#typed', {
    stringsElement: '#typed-strings'
  });
</script>

<div id="typed-strings">
  <p>Typed.js is a <strong>JavaScript</strong> library.</p>
  <p>It <em>types</em> out sentences.</p>
</div>
<span id="typed"></span>

                      </body>
</html>
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

        $myfile = fopen("output.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $newFile->output());
        fclose($myfile);
        
        echo $newFile->output();

        $output = shell_exec('conversor.py '.$uploadfile);

    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
 
}
else {
    echo 'Error! A file was not sent!';
}
 
// Echo a link back to the main page
echo '<pre>';
print_r($_FILES);

$filename = pathinfo($_FILES['uploaded_file']['name'], PATHINFO_FILENAME);



$input = shell_exec('transmitir.py '.$uploaddir.$filename.'.txt'.' 0');
echo 'transmitir.py '.$uploaddir.$filename.'.txt';
echo "<pre>$input[0]</pre>";
echo '<p>Click <a href="../index.html">here</a> to go back</p>';
?>

<html>
    
<marquee> $upload_file <br></marquee>
</html>
