<?php
class upload
{
    private string $target_file;

    public function __construct($file_name,$file_Type)
    {
        $this->target_file = null;
        switch (true) {
            case $file_Type instanceof FileTypeEnum:
                switch (true) {
                    case $file_Type instanceof PDF:
                        $this->uploadPDF($file_name);
                        break;

                    case $file_Type instanceof IMG:
                        $this->uploadImg($file_name);
                        break;
                }
                break;
            default:
                echo "formato non previsto nel codice";
                break;
        }
    }

    public function getFilePath()
    {
        if ($this->target_file != null)
            return $this->target_file;
        else
            return null;
    }

    private function uploadPDF($file_name)
    {
        try {
            $target_dir = sprintf("%s/uploads/pdf/", $_SERVER["DOCUMENT_ROOT"]);
            $this->target_file = $target_dir . basename($_FILES[$file_name]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($this->target_file,PATHINFO_EXTENSION));

            if (file_exists($this->target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if($imageFileType != "pdf") {
                echo "caricare solo file pdf.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $this->target_file)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES[$file_name]["name"])). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

        } catch (Exception $e)
        {
            echo '<h1> ERRORE UPLOAD FILE </h1> <p2>';
            echo '<br> <b>Stack ERROR:</b> <br>' . $e;
            echo '</p2>';
            echo'<p1>';
        }
    }

    private function uploadImg($file_name)
    {
        $target_dir = sprintf("%s/uploads/img/", $_SERVER["DOCUMENT_ROOT"]);
        $this->target_file = $target_dir . basename($_FILES[$file_name]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($this->target_file,PATHINFO_EXTENSION));

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES[$file_name]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if (file_exists($this->target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "caricare solo file pdf.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $this->target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES[$file_name]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}


