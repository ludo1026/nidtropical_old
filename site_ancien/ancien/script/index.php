<?
//phpinfo();

class Image {
      var $filename;
      var $image;
      var $height;
      var $width;
      function Image($filename) {
               $this->load($filename);
      }
      function load($filename) {
               $this->filename = $filename;
               echo "Chargement du fichier : " . $this->filename;
               $this->image = imageCreateFromJpeg($filename);
               $this->fillInfo();
      }
      function isLoaded() {
               return $this->image;
      }
      function fillInfo() {
               if(!$this->isLoaded()) {
                   echo " : ERREUR : non chargé.";
               } else {
                   echo " : OK : chargé.";
               }
               if($this->isLoaded()) {
                   $this->width = imageSx($this->image);
                   $this->height = imageSy($this->image);
                   echo "Taille : " . $this->width . " x " . $this->height;
               }
      }
      function writeCopy($filename, $width, $height) {
               if($this->isLoaded()) {
                   $imageNew = imageCreate($width, $height);
                   if(!$imageNew) {
                       echo "ERREUR : Nouvelle image non créée";
                   }
                   imageCopyResized($imageNew, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
                   imageJpeg($imageNew, $filename);
               }
      }
}

$image = new Image("Appart_01.jpg");
header("Content-type: image/jpeg");
$image->writeCopy("./Appart_min.jpg")

?>
