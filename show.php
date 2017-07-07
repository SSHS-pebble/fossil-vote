<?php

//개표 페이지

//접근 선행 조건 :
//(1)투표 시간 종료
//(2) $_SESSION['valid_vote_admin'] 설정. (/vote/location.php 접속)

//조건 미충족 시 : 403 요청 거부

require_once('vault.php');
$conn = new PDO('mysql:dbname=sshs_vote;host=localhost;','admin',$db_pw);

session_start();

//서울과학고 컴퓨터 관리실.
if(!$_SESSION['valid_vote_admin']){
    http_response_code(403);
    exit;
}

//투표 종료 시간이 됐을 때만 표시하게.
if(time()<$time_start){
    echo '투표 시작 전입니다.';
    exit();
}
else if(time()<$time_end){
    echo '투표 중입니다.';
    exit();
}
$query=$conn->prepare('SELECT * FROM vote_result WHERE 1');
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);
$sum = 0;
$dict = [];
foreach($results as &$row){
    $dict[$row['candId']]=$row['voteCount'];
    $sum += intval($row['voteCount']);
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>2017-2018 학생회장 선거 결과</title>
  <meta http-equiv="content-type" content="text/html" charset="utf-8">
  <meta http-equiv="Content-Language" content="ko">
  <link rel="stylesheet" type="text/css" href="common.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>

<body class="mdl-color--green-50">
<main class="mdl-layout__content" style="width: 100%">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--2-offset mdl-cell--10-col">
      <h3 style="margin-top: 8px; margin-bottom: 0px"> 2017-2018 학생회장 선거 결과 </h3>
    </div>
    <div id="elected1" class="mdl-cell mdl-cell--1-offset mdl-cell--1-col" style="height: 100pt; visibility: hidden;">
      <img style="width: 70pt; margin-top: 15pt" src="elected.png">
    </div>
    <div class="mdl-grid mdl-grid--no-spacing mdl-cell mdl-cell--8-col mdl-shadow--2dp mdl-color--blue-50" style="height: 100pt">
      <div id="bar1" class="bar mdl-color--blue-100" style="width:0"><?= $dict['1']?></div>
      <img style="width: 100pt" src="cand1.jpeg">
    </div>
    <div class="mdl-cell mdl-cell--2-col"></div>
    <div id="elected2" class="mdl-cell mdl-cell--1-offset mdl-cell--1-col" style="height: 100pt; visibility: hidden;">
      <img style="width: 70pt; margin-top: 15pt" src="elected.png">
    </div>
    <div class="mdl-grid mdl-grid--no-spacing mdl-cell mdl-cell--8-col mdl-shadow--2dp mdl-color--teal-100" style="height: 100pt">
      <div id="bar2" class="bar mdl-color--teal-200" style="width:0;"><?= $dict['2']?></div>
      <img style="width: 100pt" src="cand2.png">
    </div>
    <div class="mdl-cell mdl-cell--5-offset mdl-cell--12-col">
      <p style="font-size: 12pt" id="finished">개표 중입니다. . .</p>
    </div>
  </div>
</main>

<script>

var bar = [
    null,
    document.getElementById("bar1"),
    document.getElementById("bar2")
]
var total = [
    null,
    parseInt(bar[1].innerText),
    parseInt(bar[2].innerText)
]
var current = [null,0,0,0]

bar[1].innerText = bar[2].innerText = '0'
bar[1].style.display = bar[2].style.display = "block"

var votes = []
for(var i=1;i<=2;++i){
    var count = total[i]
    while(count>0){
        --count
        votes.push(i)
    }
}
// Fisher-Yates Shuffle
var count = votes.length
while(count>0){
    var index = Math.floor(Math.random()*count)
    --count
    var temp = votes[count]
    votes[count] = votes[index]
    votes[index] = temp
}

var id = setInterval(function(){
    if(!votes.length){
      if(total[1]>total[2]){
        document.getElementById("elected1").style.visibility = "visible"
      }
      if(total[1]<total[2]){
        document.getElementById("elected2").style.visibility = "visible"
      }
      document.getElementById("finished").innerText = "개표 완료!!"
      return
    }
    var i = votes.pop()
    ++current[i]
    bar[i].innerText = current[i]
    bar[i].style.width = 2 * current[i] + 'px'
},50)

</script>
</body>
</html>