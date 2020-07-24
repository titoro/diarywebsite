<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
header{
background: #155263;
position: relative;
width: 100%;
}
.g-nav{
width: 100%;
z-index: 10;
}
.g-nav-menu{
text-align: center;
}
.g-nav-menu li{
color: #fff;
padding: 0 30px;
list-style-type: none;
display: inline-block;
line-height: 80px;
}
.fixed{
position: fixed;
top: 0;
left: 0;
}
.fixed .g-nav-menu li{
line-height: 40px;
}
section{
display: table;
width: 100%;
height: 800px;
text-align: center;
}
section p{
display: table-cell;
vertical-align: middle;
color: #fff;
}
#sec01{
background: #FF6F3C;
}
#sec02{
background: #FF9A3C;
}
#sec03{
background: #FFC93C;
}
</style>

<script src="{{ asset('js/app.js') }}" defer></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script>
// debugger;
$(function() {
	var headNav = $("header");
	// scrollだけだと読み込み時困るのでloadも追加
	// $(window).on('load scroll', function () {
  $('#sub_gamen').click(
    function(){
		//現在の位置が500px以上かつ、クラスfixedが付与されていない時
		// if($(this).scrollTop() > 500 && headNav.hasClass('fixed') == false) {
      
			//headerの高さ分上に設定
			headNav.css({"top": '-100px'});
			//クラスfixedを付与
			headNav.addClass('fixed');
			//位置を0に設定し、アニメーションのスピードを指定
			headNav.animate({"top": 0},600);
		// }
		//現在の位置が300px以下かつ、クラスfixedが付与されている時にfixedを外す
		// else if($(this).scrollTop() < 300 && headNav.hasClass('fixed') == true){
			// headNav.removeClass('fixed');
		// }
	});
});

  function doSomething(){
                    var flag = false; // 選択されているか否かを判定する変数

                    var result = new Array();
 
                    for (var i = 0; i < document.form1.riyu.length; i++) {

                      // i番目のチェックボックスがチェックされているかを判定
                      if (document.form1.riyu[i].checked) {
                        flag = true;    
                        // alert(document.form1.fruits[i].value + "が選択されました。");
                        result[i] = document.form1.riyu[i].value;
                      }
                    }

                    console.log(result);

                    $.ajax({
                        type:'POST', //GETかPOSTか
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                        url:'{{ action('AjaxReturnAnalystController@ajax_sample', 1) }}',//url+ファイル名 .htmlは省略可
                        dataType:'json',//他にjsonとか選べるとのこと
                        data:JSON.stringify(result), 
                        _token: '{{ csrf_token() }}' 
                    }).done(function (results){
                        //$('#text').html(results);//展開したいタグのidを指定
                        console.log(results);
                        // alert("ajax 成功！");
                        var token = document.getElementsByName('csrf-token').item(0).content;
                        console.log(token);

                        /* XMLHttpRequestの例
                        xhr = new XMLHttpRequest();
                        // 直接POST送信する例
                        xhr.open('POST', 'http://192.168.10.10', true);
                        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
                        var token = document.getElementsByName('csrf-token').item(0).content;
                        xhr.setRequestHeader('X-CSRF-Token', token); 
                        // フォームに入力した値をリクエストとして設定
                        var request = "";
                        for(i = 0; i < result.length; i++){
                          if(i === 0){
                            request = "result[]=" + results[i];
                          }else{
                            request += "&result[]=" + result[i];
                          }
                        }
                        // xhr.send(request);
                        xhr.send();
                        */
                        
                        // フォームの生成
                        var form = document.createElement("form");
                        form.setAttribute("action", "http://192.168.10.10/schedule/");
                        form.setAttribute("method", "post");
                        form.style.display = "none";
                        document.body.appendChild(form);
                        data = {'2' : '2', '3' :'3'};
                        // パラメタの設定
                        if (data !== undefined) {
                          for (var paramName in data) {
                          var input = document.createElement('input');
                          input.setAttribute('type', 'hidden');
                          input.setAttribute('name', 'status['+ paramName +']');
                          input.setAttribute('value', data[paramName]);
                          form.appendChild(input);
                          }
                        }
                        // CSRFトークンを付与
                        var input = document.createElement('input');
                          input.setAttribute('type', 'hidden');
                          input.setAttribute('name', '_token');
                          input.setAttribute('value', token);
                          form.appendChild(input);
                        // submit
                        form.submit();
                    }).fail(function(jqXHR,textStatus,errorThrown){
                        alert('ファイルの取得に失敗しました。');
                        console.log("ajax通信に失敗しました")
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    });
  }

 $(function(){
            $('#test').click( //起動するボタンなどのid名を指定
                function(){
                    // $.ajax({
                    //     type:'POST', //GETかPOSTか
                    //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                    //     url:'{{ action('AjaxReturnAnalystController@ajax_sample', 1) }}',//url+ファイル名 .htmlは省略可
                    //     dataType:'json',//他にjsonとか選べるとのこと
                    //     _token: '{{ csrf_token() }}' 
                    // }).done(function (results){
                    //     //$('#text').html(results);//展開したいタグのidを指定
                    //     console.log(results);
                    //     alert("ajax 成功！");
                    // }).fail(function(jqXHR,textStatus,errorThrown){
                    //     alert('ファイルの取得に失敗しました。');
                    //     console.log("ajax通信に失敗しました")
                    //     console.log(jqXHR);
                    //     console.log(textStatus);
                    //     console.log(errorThrown);
                    // });
                }
            );
        })
</script>

<header>
	<nav class="g-nav">
		<ul class="g-nav-menu">
			<li>HOME</li>
			<li>ABOUT</li>
			<li>CONTCT</li>
		</ul>
	</nav>
</header>

<section id="sec01">
	<p>コンテンツ1</p>
</section>
	
	<section id="sec02">
	<p>コンテンツ2</p>
</section>
	
	<section id="sec03">
	<p>コンテンツ3</p>
</section>

<h3>スケジュール登録画面</h3>

<form action="{{ url('/schedule/insert')}}" method="POST" class="form-horizontal">
  @csrf
  
  開始時間：<input type="time" name="start-time"><br>
  終了時間：<input type="time" name="end-time"><br>
  タイトル：<input type="textbox" name="title"><br>
  内容：<input type="textbox" name="naiyo"><br>
  <select name="type" id="type">
    <option value="yotei">予定</option>
    <option value="ziseki">実績</option>
  </select>
  <br>
  タグ：<input type="textbox" name="naiyo"><br>
  
  <button type="submit" name="add">
   登録
  </button>
</form>

<form action="{{ url('/schedule/outputcsv')}}" method="POST" class="form-horizontal">
  @csrf
  <button type="submit" name="csv">
   CSV出力
  </button>
</form>

<form action="/" method="POST" class="form-horizontal" name="form1" onsubmit="doSomething();return false;">
  <input type="checkbox" name="riyu" value="1" checked="checked">1
  <input type="checkbox" name="riyu" value="2">2
  <input type="checkbox" name="riyu" value="3">3

  <button type="submit" name="test" id="test">  
    ajax_test
  </button>
</form>

<button type="submit" name="sub_gamen" id="sub_gamen" class="btn btn-primary">  
    sub_gamen_test
</button>

<div class="cd-schedule-modal__event-info">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <div>
  <!-- <div>aaaaa</div> -->
  <?php if(isset($id)){
      // var_dump("id is");
      // var_dump($id);
  }?>
  <?php if(isset($content_id)){
      // var_dump("content_id is");
      // var_dump($content_id);
  }?>
  <?php if(isset($result_array)){
      // var_dump("result_array is");
      // var_dump($result_array);
  }?>
  <?php
      // var_dump("cid is");
      // var_dump($cid);
  ?>
  <!--
  <form action="{{ url('/schedule/create')}}" method="POST" class="form-horizontal">
  <button type="submit" name="sub_gamen" id="sub_gamen">  
    sub_gamen_test
  </button>
  </form>
  -->
  <?php if(isset($schedules)){
          ?>
          @foreach($schedules as $schedule)
            <!--
            <li class="cd-schedule__event">
              <a data-start="{{date('H:i',strtotime($schedule->from_time))}}" data-end="{{date('H:i',strtotime($schedule->to_time))}}"  data-content="create" data-event="event-1" href="#0" content-id="8">
                <em class="cd-schedule__name">{{$schedule->text}}</em>
              </a>
            </li>
            -->
            <!-- <div> -->
            <form action="{{ url('/schedule/change')}}" method="POST" class="form-horizontal" style="margin-top:10px;display:inline-block;">
            @csrf
            <?php
              // 開始時刻の初期値を取得
              preg_match("/(?P<zikan>\d+):(?P<hun>\d+):(?P<byo>\d+)/",$schedule->from_time,$m);
              $from_time = $m['zikan'] . ":" . $m['hun'];
              // 終了時刻の初期値を取得
              preg_match("/(?P<zikan>\d+):(?P<hun>\d+):(?P<byo>\d+)/",$schedule->to_time,$n);
              $to_time = $n['zikan'] . ":" . $n['hun'];
            ?>
            <li>タイトル:<input type="text" name="title" value={{$schedule->title}}></li>
            <li>開始時刻:<input type="time" name="start-time" value={{$from_time}}></li>
            <li>終了時刻:<input type="time" name="end-time" value={{$to_time}}></li>
            <li>内容:<textarea name="text" cols="50" rows="10">{{$schedule->text}}</textarea></li>
            <input type="hidden" name="schedule_id" value={{$cid}}>
            <input type="hidden" name="date" value={{$date}}>
            <input type="hidden" name="user_id" value={{$user}}>
          @endforeach

          <button type="submit" name="change" class="btn btn-primary">
            変更
          </button>
          </form>
          <!-- </div> -->

          <!-- <div> -->
          <form action="{{ url('/schedule/delete')}}" method="POST" class="form-horizontal"  style="margin-top:10px;display:inline-block;">
            @csrf
            <input type="hidden" name="schedule_id" value={{$cid}}>
            <input type="hidden" name="date" value={{$date}}>
            <input type="hidden" name="user_id" value={{$user}}>

          <button type="submit" name="delete" class="btn btn-secondary">
            削除
          </button>
          </form>
          <!-- </div> -->

          <!-- <div> -->
          <form action="{{ url('/schedule/copy')}}" method="POST" class="form-horizontal" style="margin-top:10px;display:inline-block;">
            @csrf
            <input type="hidden" name="schedule_id" value={{$cid}}>
            <input type="hidden" name="date" value={{$date}}>
            <input type="hidden" name="user_id" value={{$user}}>
            <input type="hidden" name="type" value={{$type}}>
          <button type="submit" name="delete" class="btn btn-success">
            コピー
          </button>
          </form>
          <!-- </div> -->
          <?php
  }?>
  
  </div>
</div>