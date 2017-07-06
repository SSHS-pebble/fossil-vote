## 누락되어 있는 준비 과정이 많습니다. 일단 이후에 차차 다듬어갈 예정.


* DB가 비어 있는지 미리 확인받을 것.
* 확인받은 직후, admin 계정의 접속범위를 localhost로 제한.
(/etc/mysql/my.cnf에서 bind-address=127.0.0.1 줄을 주석해제하면 된다.)

* 세션을 싹 다 비운다.(apache 서버 재시작?)

* codegened.txt를 제거하여 코드 생성이 가능하게 할 것.
* /vote/codegen.php에 접속하여 처음 한 번의 코드 생성.(이후 codegened.txt가 다시 생성된다.)
 코드 - 학번 쌍은 단 한 번만 보여지니(db에 저장되지 않음) 그 때 웹브라우저를 긁어서 코드 - 학번 쌍을 저장, 출력하여 배부.

* 사전투표 명단을 받은 뒤, 명단에 있는 사람들의 코드를 삭제한다.

* vault.php에서 투표 시간을 지정.
* .htaccess에서 location.php의 deny from all 부분을 #로 주석처리,
  투표에 사용될 설곽 컴실 컴퓨터에서, 미리 전부 /vote/location.php에 접속, 비밀번호를 입력하고 /vote/index.php로 맞춰 둘 것.
* 관리에 사용될 컴퓨터에서는, /vote/location.php에 들어가 관리실 비밀번호를 입력할 것.
* 투표가 시작되기 전에 .htaccess의 location.php를 다시 막아 놓을 것.

* 투표 종료 시간이 지나면, 관리실 컴퓨터에서 /vote/show.php에 접속하면 개표가 가능하다. 단, 이미 투표가 끝나 있어야 한다.
