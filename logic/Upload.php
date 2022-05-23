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
        try {
            $relative_path = '/uploads/pdf/';
            $target_dir = sprintf("%s".$relative_path, $_SERVER["DOCUMENT_ROOT"]);
            $target_file = $target_dir . basename($file_name["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if (file_exists($target_file)) {
                echo "il file è già presente sul db.";
                $uploadOk = 0;
            }

            if($imageFileType != "pdf") {
                echo "caricare solo file pdf.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "file NON caricato.";
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

    private function uploadImg($file_name)
    {
        $relative_path = '/uploads/img/';
        $target_dir = sprintf("%s".$relative_path, $_SERVER["DOCUMENT_ROOT"]);
        $target_file = $target_dir . basename($file_name["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($file_name["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        }else{
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "caricare solo immagini.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($file_name["tmp_name"], $target_file)) {
                $this->target_file_to_save = $relative_path . $file_name["name"];
            } else {
                echo "error: uploading fallito.";
            }
        }
    }
}


