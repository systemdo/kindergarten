<?php
namespace Acme\SystemBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Mapping\ClassMetadata;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * FilesSystem
 *
 * @ORM\Table(name="image")
 * @ORM\Entity
 */

class FilesSystem
{
	 /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
    */
    private $typeFile;

    /*For future many files for children*/
    //public $filesChild;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('file', new Assert\File(array(
            'maxSize' => 6000000,
        )));
    }
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/'.$this->path ;
    }
    protected function setTypeFile()
    {
          $path = $this->file->getClientMimeType();
          var_dump($path);
          $path = explode("/", $path);   
          $this->typeFile = $path[0].'s';
    }
    
    public function setFile(UploadedFile $file = null, $entity)
    {
        
        $this->file = $file;
        $this->setTypeFile();
        $this->path = $this->typeFile.'/'.$entity->uploadDir;
        $this->name = $this->file->getClientOriginalName();
        /*echo "<pre>";
        var_dump($file);
        var_dump($this->getUploadRootDir());
            var_dump($this->getFile()->getClientOriginalName());
            var_dump($this->getFile()->getClientMimeType());
            var_dump($this->getFile()-> getMimeType());
         die();*/
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload()
	{
	    // the file property can be empty if the field is not required
	    if (null === $this->getFile()) {
	        return;
	    }

	    
        //echo "<pre>";
        //var_dump($this->getUploadRootDir());die();
	    $this->getFile()->move(
	        $this->getUploadRootDir(),
	        $this->getFile()->getClientOriginalName()
	    );

	    // set the path property to the filename where you've saved the file
	   // $this->path = $this->getFile()->getClientOriginalName();

	    // limpia la propiedad «file» ya que no la necesitas más
	    $this->file = null;
	}


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return FilesSystem
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return FilesSystem
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get typeFile
     *
     * @return string 
     */
    public function getTypeFile()
    {
        return $this->typeFile;
    }
}