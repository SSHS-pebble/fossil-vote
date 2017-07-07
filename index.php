<?php

//접근 선행 조건 :
//(1) $_SESSION['valid_vote_location'] 설정. (/vote/location.php 접속)

if(!isset($_SESSION)){ session_start(); }

//설곽 컴실이 아니면 요청 거부.
if(!$_SESSION['valid_vote_location']){
    http_response_code(403);
    exit;
}

//이제 새로운 세션 변수를 설정.
$_SESSION['valid_vote_entry']=TRUE;

?>

<!DOCTYPE html>

<html>
<head>
  <title>2017-2018 학생회장 선거</title>
  <meta http-equiv="content-type" content="text/html" charset="utf-8">
  <meta http-equiv="Content-Language" content="ko">
  <link rel="stylesheet" type="text/css" href="common.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>

<body class="mdl-color--green-50">
<main class="mdl-layout__content">
  <form method="POST" action="/submit.php" onsubmit="return validateForm()" id="voteForm" style="margin: 0; padding: 0;">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--2-offset mdl-cell--4-col">
      <h3 style="margin-top: 8px; margin-bottom: 0px"> 2017-2018 학생회장 선거 </h3>
    </div>
    <div class="mdl-cell mdl-cell--2-col">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"  style="width:100%; height:5px; margin-bottom: 7px">
        <input class="mdl-textfield__input" type="text" placeholder="선거코드(xxxxxx)" id="ucode" name="ucode" oninput="showValidate(this.value)" onkeydown="if (event.keyCode == 13) return false;" style="width:100%" required>
        <input type="hidden" name="candId" id="cand" required>
        <p><span id="validation_error" style="color:red; margin-top: 0; font-size: 7pt; height: 7pt"> </span></p>
      </div>
    </div>
    <div class="mdl-cell mdl-cell--2-offset mdl-cell--4-col mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title mdl-color--blue-50">
        <h1 class="mdl-card__title-text">1번 : 김동하 김찬중 김재연</h1>
        <div class="mdl-layout-spacer"></div>
        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--blue-100" onclick="send(1)"> 투표 </button>
      </div>
      <div class="mdl-card__media">
        <img style="width:100%" src="cand1-p.jpeg">
      </div>
    </div>
    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title mdl-color--teal-100">
        <h1 class="mdl-card__title-text">2번 : 오승석 백승윤 공현덕</h1>
        <div class="mdl-layout-spacer"></div>
        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--teal-200" onclick="send(2)"> 투표 </button>
      </div>
      <div class="mdl-card__media">
        <img style="width:100%" src="cand2-p.png">
      </div>
    </div>
  </div>
  </form>

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

function send(cand){
  document.getElementById("cand").value = cand;
  document.getElementById("voteForm").submit();
}
  </script>
  
</main>
</body>
</html>
