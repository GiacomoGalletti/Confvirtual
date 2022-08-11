<?php
class Upload
{
    private $target_file_to_save;

    /**
     * @throws Exception
     */

    public function __construct($file_name, $file_Type)
    {
        $this->target_file_to_save = null;
        switch ($file_Type) {
            case FileTypeEnum::PDF:
                $this->uploadPDF($file_name);
                break;

            case FileTypeEnum::IMG:
                $this->uploadImg($file_name);
                break;

            default:
                throw new Exception("FILE NON SUPPORTATO PER IL DOWNLOAD");
        }
    }

    public function getFilePath(): ?string
    {
        if ($this->target_file_to_save != null)
            return $this->target_file_to_save;
        else
            return null;
    }

    private function uploadPDF($file_name)
    {
        if ($file_name["name"] != '') {
            try {
                $relative_path = '/uploads/pdf/';
                $target_dir = sprintf("%s".$relative_path, $_SERVER["DOCUMENT_ROOT"]);
                $target_file = $target_dir . basename($file_name["name"]);
                $uploadOk = 0; // se è 0 il file va bene altrimenti viene gestito in base al valore
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if (file_exists($target_file)) {
                    echo "il file è già presente sul db.";
                    $uploadOk = 1;
                }

                if($imageFileType != "pdf") {
                    echo "caricare solo file pdf.";
                    $uploadOk = 2;
                }

                if ($uploadOk == 2) {
                    echo "file NON caricato.";
                } else if ($uploadOk == 1) {
                    echo "file NON caricato.";
                    $this->target_file_to_save = $relative_path . $file_name["name"];
                } else {
                    if (move_uploaded_file($file_name["tmp_name"], $target_file)) {
                        $this->target_file_to_save = $relative_path . $file_name["name"];
                    } else {
                        echo "error: uploading fallito.";
                    }
                }

            } catch (Exception $e)
            {
                echo '<h1> ERRORE UPLOAD FILE </h1> <p2>' . '<br> <b>Stack ERROR:</b> <br>' . $e . '</p2>' . '<p1>';
            }
        }
    }

    private function uploadImg($file_name)
    {
        if ($file_name["name"] != '') {
            $relative_path = '/uploads/img/';
            $target_dir = sprintf("%s".$relative_path, $_SERVER["DOCUMENT_ROOT"]);
            $target_file = $target_dir . basename($file_name["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($file_name["tmp_name"]);

            if($check !== false) {
                $uploadOk = 1;
            }else{
                echo "File non è un'immagine.";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                echo "File già presente.";
                $uploadOk = 0;
            }

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "caricare solo immagini.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "<p><b>File NON CARICATO</b></p>";
            } else {
                if (move_uploaded_file($file_name["tmp_name"], $target_file)) {
                    $this->target_file_to_save = $relative_path . $file_name["name"];
                } else {
                    echo "<p><b>error: uploading fallito.</b></p>";
                }
            }
        }
    }
}


