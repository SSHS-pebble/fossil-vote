<?php

//개표 페이지

//접근 선행 조건 :
//(1)투표 시간 종료
//(2) $_SESSION['valid_vote_admin'] 설정. (/vote/location.php 접속)

//조건 미충족 시 : 403 요청 거부

require_once('../vault.php');
$conn = new PDO('mysql:dbname=sshs_vote;host=localhost;','admin',$db_pw);

session_start();

//서울과학고 컴퓨터 관리실.
if(!isset($_SESSION['valid_vote_admin'])){
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

<title>2016-2017 학생회장 선거 결과</title>
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<meta http-equiv="Content-Language" content="ko">
<link rel="stylesheet" type="text/css" href="common.css">

</head>

<body></body>

<div class="frame">
<table style="margin:auto">
  <thead>
    <tr>
      <th colspan="2"><h1>서울과학고 2016-2017 학생회장 선거 결과</h1></th>
    </tr>
  </thead>
  <tbody>
    <tr class="cand1">
      <td style="width:192px">
        <img src="cand1.jpg">
      </td>
      <td rowspan="2" style="width:600px">
        <div id="bar1" class="bar" style="background-color:darkred;width:0;display:none"><?= $dict['1']?></div>
      </td>
    <tr class="cand1">
      <td>
        1번 : <b>황준오</b> 김호중 김채린
      </td>
    </tr>

    <tr class="cand2">
      <td style="width:192px">
        <img src="cand2.jpg">
      </td>
      <td rowspan="2" style="width:600px">
        <div id="bar2" class="bar" style="background-color:darkgreen;width:0;display:none"><?= $dict['2']?></div>
      </td>
    <tr class="cand2">
      <td>
        2번 : <b>이의호</b> 윤현상 김동하
      </td>
    </tr>

    <tr class="cand3">
      <td style="width:192px">
        <img src="cand3.jpg">
      </td>
      <td rowspan="2" style="width:600px">
        <div id="bar3" class="bar" style="background-color:darkblue;width:0;display:none"><?= $dict['3']?></div>
      </td>
    <tr class="cand3">
      <td>
        3번 : <b>김명서</b> 이민재 안철우
      </td>
    </tr>
  </tbody>
</table>

<p>해당 집계 결과는 사전투표가 배제된 온라인 투표 결과입니다.</p>
<p id="finished">개표 중입니다. . .</p>
<?php 

$query=$conn->prepare('SELECT 1 FROM voted_status WHERE voted = 1');
$query->execute();
if($query->rowCount()!==$sum){
    echo '<p>ERROR: 현재까지 투표자 수 '.$query->rowCount().'명, 득표수 총합 '.$sum.'명으로 다르게 집계됨</p>';
}

?>
<br>

</div>
<script>

var bar = [
    null,
    document.getElementById("bar1"),
    document.getElementById("bar2"),
    document.getElementById("bar3")
]
var total = [
    null,
    parseInt(bar[1].innerText),
    parseInt(bar[2].innerText),
    parseInt(bar[3].innerText)
]
var current = [null,0,0,0]

bar[1].innerText = bar[2].innerText = bar[3].innerText = '0'
bar[1].style.display = bar[2].style.display = bar[3].style.display = "block"

var votes = []
for(var i=1;i<=3;++i){
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
      document.getElementById("finished").innerText = "개표가 완료되었습니다."
      return
    }
    var i = votes.pop()
    ++current[i]
    bar[i].innerText = current[i]
    bar[i].style.width = 1.5 * current[i] + 'px'
},50)


</script>
</body>
</html>