## Launcing

1. git 저장소를 클론합니다.
    * `git clone https://github.com/SSHS-pebble/fossil-vote.git`
2. 필요한 npm 라이브러리들을 설치합니다.
    * `npm install`
3. 실행시킵니다.
    * `npm run start`
4. 제대로 작동시키기 위해서, 백엔드도 같이 실행시킵니다. [백엔드 레포](https://github.com/SSHS-pebble/sshs-vote-backend) 참고


## Structure

사용하는 html 페이지들은 `src/pages`에, 사용하는 이미지들은 `src/static`에 있습니다.

페이지는 `koa-views`를 사용해서 렌더링하고, 이미지들은 `static-koa-router`를 사용해서 서빙합니다. 이미지들은 각 이미지의 이름을 url에 써서 외부자도 접근할 수 있습니다. (예: `cand2.png` 파일은 `localhost:3000/cand2.png`로 접근 가능)


## Misc

`.env` 파일에서 백엔드 서버 주소를 바꿀 수 있습니다.