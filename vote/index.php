<?php

//접근 선행 조건 :
//(1) $_SESSION['valid_vote_location'] 설정. (/vote/location.php 접속)

session_start();

//설곽 컴실이 아니면 요청 거부.
if(!isset($_SESSION['valid_vote_location'])){
    http_response_code(403);
    exit;
}

//이제 새로운 세션 변수를 설정.
$_SESSION['valid_vote_entry']=TRUE;

?>

<!DOCTYPE html>
<html>
<head>
  <title>2016-2017 학생회장 선거</title>
  <meta http-equiv="content-type" content="text/html" charset="utf-8">
  <meta http-equiv="Content-Language" content="ko">
  <link rel="stylesheet" type="text/css" href="common.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>
<body>
<main class="mdl-layout__content">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--5-offset mdl-cell--2-col">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"  style="width:100%">
        <input class="mdl-textfield__input" type="text" placeholder="선거코드(xxxxxx)" id="ucode" name="ucode" oninput="showValidate(this.value)" style="width:100%" required>
      </div>
    </div>
    <div class="mdl-cell mdl-cell--2-offset mdl-cell--4-col mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title mdl-color--blue-50">
        <h1 class="mdl-card__title-text">1번 : 김동하 김찬중 김재연</h1>
        <div class="mdl-layout-spacer"></div>
        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--blue-100"> 투표
      </div>
      <div class="mdl-card__media">
        <img style="width:100%" src="cand1.jpeg">
      </div>
    </div>
    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title mdl-color--teal-100">
        <h1 class="mdl-card__title-text">2번 : 오승석 백승윤 공현덕</h1>
        <div class="mdl-layout-spacer"></div>
        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--teal-200"> 투표
      </div>
      <div class="mdl-card__media">
        <img style="width:100%" src="cand2.png">
      </div>
    </div>

  </div>


    
  <script>
      
function validate(num){
    if(num.length!=6){
        return false;
    }
    
    num = parseInt(num,16);
    var p = Math.floor(num / 16);
    var q = num % 16;
    return (p%11===q);
}

function showValidate(num){
    if(num.length && !validate(num)){
        document.getElementById("validation_error").innerHTML = "정확한 코드가 아닙니다.";
    }
    else{
        document.getElementById("validation_error").innerHTML = " ";
    }
}

function validateForm(){
    return validate(document.getElementById("ucode").value);
}

  </script>
  
</body>
</html>