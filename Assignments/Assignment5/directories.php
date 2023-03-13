<?php
class Directories{
    function blank_THE_POST(){
		$_POST["FolderN"] = "";
		$_POST["FileC"] = "";
		$_POST["submit"] = "";
		return;
	}
    function executeButtonClick(){
		if((!isset($_POST["submit"])) || ($_POST["submit"] != "submit")){
			$this->blank_THE_POST();
			return;
		}
		if((($_POST["FolderN"] == "") || ($_POST["FileC"] == ""))){
			$this->blank_THE_POST();
			return '<p>You must enter a folder name and content for the file!<p>
			        <div> <p>No folder or file was created.</p></div>';
		}
		$URLPath = "https://russet-v8.wccnet.edu/~calman/CPS-276/Assignments/Assignment5/directories/";
		$FilePath = "./directories/" . $_POST["FolderN"] . "/";
		if(is_dir($FilePath)){
			$this->blank_THE_POST();
			return '<p>A directory already exists with that name.</p>';
		}
		$newDirect = mkdir($FilePath, 0777);
		chmod($FilePath, 0777);
		if($newDirect) {
			$FilePath .= "readme.txt";
			touch($FilePath);
			chmod($FilePath, 0777);
			$handle = fopen($FilePath, "w");
			fwrite($handle, $_POST["FileC"]);
			fclose($handle);
			$URLPath .= $FilePath; 
		}
		$this->blank_THE_POST();
		return '<div><p>File and directory were created</p></div>
			    <div><p><a href = "' . $URLPath . '">Path to where file is located.</a></p></div>';
	}
}
?>