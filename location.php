<?php

require_once('vault.php');

//세션 설정 페이지(설곽 컴실에서 들어왔다는 걸 확인하기 위해 세팅한다.)

//접근 선행 조건 :
//(1).htaccess에서 잠금 해제
//(2)$_POST['password'] 에 올바른 초기화 비밀번호 설정

?>

<!doctype html>
<html>
<head>
</head>
<body>

<?php
if(!isset($_POST) || !isset($_POST['password'])){
?>

<form method="POST" action="">

비밀번호 <input type="password" name="password">
<br>
<input type="submit" value="제출">

</form>

<?php
} else{
    require_once('vault.php');
    ini_set('session.gc_maxlifetime', $time_end-$time_start+18000);
    session_set_cookie_params($time_end-$time_start+18000); //5시간 여유.

    if(password_verify($_POST['password'],'$2y$10$tIEF3kMNsf7QGIgysYjvNOhQbuh.9NTKdrWLutQGNqXcxnutvqaSW')){//set
        session_start();
        $_SESSION['valid_vote_location']=TRUE; //투표 컴퓨터 권한
        echo '<p>서울과학고 컴퓨터실 세션 설정이 완료되었습니다.</p>';
    }
    else if(password_verify($_POST['password'],'$2y$10$tr8cGCY/lqV1dmK1lHcof.1wO3usX0Q1s7/bU000Z9UkIJjg2OIxu')){//admin
        session_start();
        $_SESSION['valid_vote_admin']=TRUE; //관리자 권한
        echo '<p>서울과학고 컴퓨터 관리실 세션 설정이 완료되었습니다.</p>';
    }
    else{
        echo '<p>비밀번호가 틀립니다.</p>';
        #echo password_hash($_POST['password'], PASSWORD_DEFAULT)."\n";
    }
}
?>

</body>
</html>
