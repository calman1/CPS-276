<?php
require_once('classes/StickyForm.php');
$stickyForm = new StickyForm(); $stickyForm->security();

function init(){
  global $elementsArr, $stickyForm;

  if(isset($_POST['submit'])){
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);
    if($postArr['masterStatus']['status'] == "noerrors"){
	return addData($_POST);
    }else{
	return getForm("", $postArr);
    }
  }else{
    return getForm("", $elementsArr);
  }
}

$elementsArr = [
  "masterStatus"=>[
    "status"=>"noerrors",
    "type"=>"masterStatus"
  ],
  "name"=>[
    "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'>Error, Name cannot be blank and must be a standard name</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"Christopher",
    "regex"=>"name"
  ],
  "email"=>[
    "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'>Error, must be a valid email</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"calman@admin.com",
    "regex"=>"email"
  ],
  "password"=>[
    "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'>Error, Please choose a password (8+ characters)</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"password",
    "regex"=>"password"
  ],
  "status"=>[
    "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'>There was an error</span>",
    "errorOutput"=>"",
    "type"=>"select",
    "options"=>["admin"=>"Admin","staff"=>"Staff"],
    "selected"=>"admin",
    "regex"=>"name"
  ]
];

function addData($post){
  global $elementsArr;
  require_once('classes/Pdo_methods.php');
  $pdo = new PdoMethods();

  $sql = "SELECT admin_email FROM admins WHERE admin_email = :email";
  $bindings = [[':email',$post['email'],'str']];

  $records = $pdo->selectBinded($sql,$bindings);
  
  if($records == 'error'){return getForm("<p class='errorMsg'>There was an error processing your request.</p>", $elementsArr);}
  
  if(count($records) != 0){return getForm("<p class='errorMsg'>Email already in use.</p>", $elementsArr);}

  $sql = "INSERT INTO admins (admin_name, admin_email, admin_password, admin_status) VALUES (:name, :email, :password, :status)";
  $bindings = [
    [':name',$post['name'],'str'],
    [':email',$post['email'],'str'],
    [':password',password_hash($post['password'], PASSWORD_DEFAULT),'str'],
    [':status',$post['status'],'str']
  ];

  $result = $pdo->otherBinded($sql, $bindings);

  if($result == "error"){
    return getForm("<p class='errorMsg'>There was a problem processing your form.</p>", $elementsArr);
  }else{
    return getForm("<p class='successMsg'>Admin Added</p>", $elementsArr);
  }

}

function getForm($acknowledgement, $elementsArr){
  global $stickyForm;
 $options = $stickyForm->createOptions($elementsArr['status']);

  $form = <<<HTML
    <form name="addAdmin" method="post" action="index.php?page=addAdmin">
      <div class="form-group">
        <label for="name">Name (Letters only) {$elementsArr['name']['errorOutput']}</label>
        <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}">
      </div>
      <div class="form-group">
        <label for="email">Email {$elementsArr['email']['errorOutput']}</label>
        <input type="text" class="form-control" id="email" name="email" value="{$elementsArr['email']['value']}">
      </div>
      <div class="form-group">
        <label for="password">Password {$elementsArr['password']['errorOutput']}</label>
        <input type="password" class="form-control" id="password" name="password" value="{$elementsArr['password']['value']}">
      </div>
      <div class="form-group">
        <label for="status">Status (Choose one) {$elementsArr['status']['errorOutput']}</label>
        <select class="form-control" id="status" name="status">
          $options
        </select>
      </div>
      <div class="form-group">
        <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  HTML;

  return [$acknowledgement, $form];
}

?> 