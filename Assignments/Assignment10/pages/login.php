<?php
    require_once('classes/StickyForm.php');
    $stickyForm = new StickyForm(); 
    
    function init(){
        global $elementsArr, $stickyForm;
      
        if(isset($_POST['login'])){ 
            $postArr = $stickyForm->validateForm($_POST, $elementsArr);
            $loginOutput = $stickyForm->login($_POST);

            if($postArr['masterStatus']['status'] == "noerrors"){
                if($loginOutput === 'success'){header('Location: index.php?page=welcome');}
                return getForm($loginOutput, $postArr);
            }
            else{
               return getForm("",$postArr);
            }
        }
        else {
            return getForm("", $elementsArr);
        } 
    }

   $elementsArr = [
	"masterStatus"=>[
	  "status"=>"noerrors",
	  "type"=>"masterStatus"
	],
	"email"=>[
      "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'>Error, Please enter in a valid email</span>",
      "errorOutput"=>"",
	  "type"=>"text",
	  "value"=>"calman@admin.com",
      "regex"=>"email" 
	],
	"password"=>[
      "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'>Error, Password can not be blank</span>",
      "errorOutput"=>"",
	  "type"=>"text",
	  "value"=>"password",
      "regex"=>"nonBlank"
	]
   ];


    function getForm($acknowledgement, $elementsArr){
        global $stickyForm;

        $loginForm=<<<HTML
            <form name="login" action="index.php?page=login" method="post">
                <div class="form-group">
                    <label for="email">Email {$elementsArr['email']['errorOutput']}</label>
                    <input type="text" class="form-control" name="email" id="email" value="{$elementsArr['email']['value']}">
                </div>
                <div class="form-group">
                    <label for="password">Password {$elementsArr['password']['errorOutput']}</label>
                    <input type="password" class="form-control" name="password" id="password" value="{$elementsArr['password']['value']}">
                </div>
                <div class="form-group padtop">
                    <input type="submit" class="btn btn-primary" name="login" id="login" value="Log In">
                </div> 
            </form>
        HTML;   
        return [$acknowledgement, $loginForm];
    }

?>