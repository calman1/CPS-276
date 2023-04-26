<?php

require_once('classes/StickyForm.php');
$stickyForm = new StickyForm(); $stickyForm->security();

function init(){
  global $elementsArr, $stickyForm;

  if(isset($_POST['submit'])){
    
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);
    
    if($postArr['masterStatus']['status'] == "noerrors"){
    
      return addData($_POST);
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
	"name"=>[
    "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'> Error, Name cannot be blank and must be a standard name</span>",
      "errorOutput"=>"",
      "type"=>"text",
      "value"=>"Christopher",
      "regex"=>"name"
	],
	"phone"=>[
    "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'> Error, Valid phone number required in 999.999.9999 format</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"999.999.9999",
    "regex"=>"phone"
  ],

  "address"=>[
    "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'> Error, Please enter a valid address</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"123 That road",
    "regex"=>"address"
  ],

  "city"=>[
    "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'> Error, Please enter in a valid city name</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"That place",
    "regex"=>"name"
  ],
   
  "state"=>[
    "type"=>"select",
    "options"=>["mi"=>"Michigan","oh"=>"Ohio","pa"=>"Pennslyvania","nc"=>"North Carolina","tx"=>"Texas"],
		"selected"=>"mi",
		"regex"=>"name"
	],
  
  "email"=>[
    "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'> Error, Please enter in a valid email</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"calman@admin.com",
    "regex"=>"email" 
  ],

  "date"=>[
    "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'> Error, Please enter in a valid birth date</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"99/99/9999",
    "regex"=>"date"
  ],

  "contactMethod"=>[
    "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'>There was an error</span>",
    "errorOutput"=>"",
    "type"=>"checkbox",
    "action"=>"none",
    "status"=>["Newsletter"=>"", "Email"=>"", "SMS"=>""]
  ],
  "ageGroup"=>[
    "errorMessage"=>"<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style><span class='errorMsg'> Error, You must select at least one age group option</span>",
    "errorOutput"=>"",
    "action"=>"required",
    "type"=>"radio",
    "value"=>["10-18"=>"", "19-30"=>"", "30-50"=>"", "51+"=>""]
  ]
];


function addData($post){
  global $elementsArr;   
  require_once('classes/Pdo_methods.php');
  $pdo = new PdoMethods();

  $sql = "INSERT INTO contactsTable (contact_name, contact_address, contact_city, contact_state, contact_phone, contact_email, contact_DOB, contact_contacts, contact_age) VALUES (:name, :address, :city, :state, :phone, :email, :DOB, :contacts, :age)";

  if(isset($post['contactMethod'])){
    $contactMethods = "";
    foreach($post['contactMethod'] as $v){
      $contactMethods .= $v."<br>";
    }
   
  }else{
    $contactMethods = "no contact";
  }

  $bindings = [
    [':name',$post['name'],'str'],
    [':address',$post['address'],'str'],
    [':city',$post['city'],'str'],
    [':state',$post['state'],'str'],
    [':phone',$post['phone'],'str'],
    [':email',$post['email'],'str'],
    [':DOB',$post['date'],'str'],
    [':contacts',$contactMethods,'str'],
    [':age',$post['ageGroup'],'str']
  ];

  $result = $pdo->otherBinded($sql, $bindings);

  if($result == "error"){
    return getForm("<p class='errorMsg'>There was an error processing your form</p>", $elementsArr);
  }else{
    return getForm("<p class='successMsg'>Contact Information Added</p>", $elementsArr);
  }   
}

function getForm($acknowledgement, $elementsArr){
  global $stickyForm;
  $options = $stickyForm->createOptions($elementsArr['state']);

    $form = <<<HTML
      <form method="post" action="index.php?page=addContact">
      <div class="form-group"> 
        <label for="name">Name (Letters only){$elementsArr['name']['errorOutput']}</label>
        <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}" >
      </div>
      <div class="form-group"> 
        <label for="address">Address (Number and street only) {$elementsArr['address']['errorOutput']}</label>
        <input type="text" class="form-control" id="address" name="address" value="{$elementsArr['address']['value']}">
      </div>
      <div class="form-group"> 
        <label for="city">City {$elementsArr['city']['errorOutput']}</label>
        <input type="text" class="form-control" id="city" name="city" value="{$elementsArr['city']['value']}">
      </div>   
      <div class="form-group"> 
        <label for="state">State (Select one)</label>
        <select class="form-control" id="state" name="state">
          $options
        </select>
      </div>
      <div class="form-group"> 
        <label for="phone">Phone {$elementsArr['phone']['errorOutput']}</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{$elementsArr['phone']['value']}" >
      </div>
      <div class="form-group"> 
        <label for="email-address">Email {$elementsArr['email']['errorOutput']}</label>
        <input type="text" class="form-control" id="email" name="email" value="{$elementsArr['email']['value']}" >
      </div>
      <div class="form-group"> 
        <label for="DOB">Date of Birth (MM/DD/YYYY) {$elementsArr['date']['errorOutput']}</label>
        <input type="text" class="form-control" id="date" name="date" value="{$elementsArr['date']['value']}">
      </div>
      <p>Please check all contact options (optional):{$elementsArr['contactMethod']['errorOutput']}</p>
      <span> 
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="contactMethod[]" id="contactMethod1" value="Newsletter" {$elementsArr['contactMethod']['status']['Newsletter']}>
          <label class="form-check-label" for="contactMethod1">Newsletter</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="contactMethod[]" id="contactMethod2" value="Email" {$elementsArr['contactMethod']['status']['Email']}>
          <label class="form-check-label" for="contactMethod2">Email Updates</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="contactMethod[]" id="contactMethod3" value="SMS" {$elementsArr['contactMethod']['status']['SMS']}>
          <label class="form-check-label" for="contactMethod3">Text Updates</label>
        </div>
      </span>
      <p class="padtop">Please select an age range (you must select one): {$elementsArr['ageGroup']['errorOutput']}</p>
      <span>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="ageGroup" id="ageGroup1" value="10-18"  {$elementsArr['ageGroup']['value']['10-18']}>
          <label class="form-check-label" for="ageGroup1">10-18</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="ageGroup" id="ageGroup2" value="19-30"  {$elementsArr['ageGroup']['value']['19-30']}>
          <label class="form-check-label" for="ageGroup2">19-30</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="ageGroup" id="ageGroup3" value="30-50"  {$elementsArr['ageGroup']['value']['30-50']}>
          <label class="form-check-label" for="ageGroup3">30-50</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="ageGroup" id="ageGroup4" value="51+"  {$elementsArr['ageGroup']['value']['51+']}>
          <label class="form-check-label" for="ageGroup4">51+</label>
        </div>
      </span>
      <div class="padtop">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  HTML;

  return [$acknowledgement, $form];
}
?>