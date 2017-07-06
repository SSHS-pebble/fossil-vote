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

<title>2017-2018 학생회장 선거</title>
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<meta http-equiv="Content-Language" content="ko">
<link rel="stylesheet" type="text/css" href="common.css">

</head>
<body>

  <form method="POST" action="/submit.php" onsubmit="return validateForm()" class="frame">
    <table style="margin:0px 12px">
      <thead>
        <tr>
          <th colspan="6"><h1>서울과학고 2017-2018 학생회장 선거</h1></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="3" class="cand1"><h2>기호 1번</h2></td>
          <td colspan="3" class="cand2"><h2>기호 2번</h2></td>
        </tr>
        <tr>
          <td colspan="3" class="cand1"><img src="images/cand1.jpg"></td>
          <td colspan="3" class="cand2"><img src="images/cand2.jpg"></td>
        </tr>
        <tr>
          <td class="cand1">부회장<br>2807 김호중</td>
          <td class="cand1"><b>회장<br>2516 황준오</b></td>
          <td class="cand1">부회장<br>1705 김채린</td>

          <td class="cand2">부회장<br>2309 윤현상</td>
          <td class="cand2"><b>회장<br>2212 이의호</b></td>
          <td class="cand2">부회장<br>1103 김동하</td>
        </tr>
        <tr>
          <td class="cand1"><img src="images/pic_temp.JPG" alt="김호중"></td>
          <td class="cand1"><img src="images/pic_temp.JPG" alt="황준오"></td>
          <td class="cand1"><img src="images/pic_temp.JPG" alt="김채린"></td>

          <td class="cand2"><img src="images/pic_temp.JPG" alt="윤현상"></td>
          <td class="cand2"><img src="images/pic_temp.JPG" alt="이의호"></td>
          <td class="cand2"><img src="images/pic_temp.JPG" alt="김동하"></td>
        </tr>
        <tr>
          <td colspan="3" class="cand1"><input type="radio" name="candId" value="1" required/></td>
          <td colspan="3" class="cand2"><input type="radio" name="candId" value="2" required/></td>
        </tr>
        <tr>
          <td colspan="6">
            <input type="text" id="ucode" name="ucode" placeholder="선거코드(xxxxxx)" oninput="showValidate(this.value)" required/>
<input type="submit" value="투표" />
<p><span id="validation_error" style="color:red"> </span></p>
          </td>
        </tr>
      </tbody>
    </table>
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

  </script>

</body>
</html>
