<!--<!doctype html>
<html>
    <head>
        <title>실험용</title>
        <script src="http://code.jquery.com/jquery.min.js"></script>
    </head>
    <body>
        <h1>상태 표시줄</h1>
        <button type="button">시작!</button>
        <p></p>
        <script>

$('button').click(function(){
    var arr = [
      '237a02',
'a76402',
'1e0607',
'fd0000',
'19720a',
'f1fc02',
'30be09',
'055809',
'76ea03',
'4e1405',
'b6f600',
'3b3003',
'33e203',
'53ac04',
'68ae0a',
'f68803',
'c85a07',
'1ac406',
'7de600',
'0f6001',
'2c5203',
'3b5c03',
'ae9e01',
'ddb800',
'd7ca00',
'cd7403',
'32d605',
'399002',
'c2c208',
'690c07',
'c28e01',
'7ae809',
'653a01',
'262402',
'95c602',
'79c003',
'b73203',
'9cbc02',
'647e07',
'8e1806',
'30aa08',
'e4d403',
'66b609',
'8ff001',
'c9a208',
'966c07',
'546e06',
'd7480a',
'fa1a08',
'c98401'
    ]
    
    var len = arr.length, cnt = 0, failed = false
    
    var $parag = $('p')
    
    for(var i=0;i<len;++i){
        $.ajax({
            method: "POST",
            url: "/vote/submit.php",
            cache: false,
            data: {
                ucode: arr[i],
                candId: '1'
            }
        }).done(function(data,statusText,xhr){
            var status = xhr.status
            if(status == 201){
                if(++cnt==len){
                    $parag.html('SUCCESS!')
                }
                else if(!failed){
                    $parag.html('PROCESSING...')
                }
            }
            else{
                failed = true
                $parag.html('PROCESSING... (FAILED)')
            }
            console.log(data)
        }).fail(function(){
            failed = true
            $parag.html('PROCESSING... (FAILED)')
        })
    }
})

        </script>
    </body>
</html>-->