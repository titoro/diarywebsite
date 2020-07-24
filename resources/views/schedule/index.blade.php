<!doctype html>
<html lang="ja">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous">
</script>
<style>
  #sub{
  background: #FFFFFF;
  position: relative;
  width: 100%;
  z-index: 10;
  /* top : -200px; */
  display:none;
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
  .form-horizontal{
    margin-left: 10px;
  }
  button{
    display:inline-block;
  }
  /* div{
    text-align:center;
  } */
</style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>document.getElementsByTagName("html")[0].className += " js";</script>
  <link rel="stylesheet" href="{{ asset('/css/schedule-template/style.css') }}">
  <title>Schedule Template | CodyHouse</title>

  <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <!-- <link href="{{ asset('css/c3/c3.css') }}" rel="stylesheet"> -->
  <!-- <script src="https://d3js.org/d3.v5.min.js"></script> -->
  <!-- <script src="{{ asset('js/c3/c3.js') }}" defer></script> -->
  <!-- <script src="{{ asset('js/c3/c3.mina.js') }}" defer></script> -->
  <!-- <script src="{{ asset('js/c3/c3.esm.js') }}" defer></script> -->
  

<script>  
function CSVOutput(){
                    var flag = false; // 選択されているか否かを判定する変数

                    var result = new Array();
 
                    // for (var i = 0; i < document.form1.riyu.length; i++) {

                    //   // i番目のチェックボックスがチェックされているかを判定
                    //   if (document.form1.riyu[i].checked) {
                    //     flag = true;    
                    //     // alert(document.form1.fruits[i].value + "が選択されました。");
                    //     result[i] = document.form1.riyu[i].value;
                    //   }
                    // }
                    // let user_id = 1;
                    console.log(document.form1.user_id);
                    let user_id = 1;
                    // let user_id = document.form1.user_id.value ? document.form1.user_id.value : 0;
                    
                    // alert(user_id);
                    result['user_id'] = user_id; 
                    // console.log(result);
                    // alert("debug");
                    $.ajax({
                        type:'POST', //GETかPOSTか
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                        url:'{{ action('AjaxReturnAnalystController@ajax_sample', 1) }}',//url+ファイル名 .htmlは省略可
                        dataType:'json',//他にjsonとか選べるとのこと
                        // data:JSON.stringify(result),
                        data: {'user_id': user_id},
                        _token: '{{ csrf_token() }}' 
                    }).done(function (results){
                        //$('#text').html(results);//展開したいタグのidを指定
                        // console.log(results);
                        // alert(results);
                        // alert();
                        if(!window.confirm(results['count'] + "件あります。ダウンロードしますか？")){
                          return false;
                        };
                        var token = document.getElementsByName('csrf-token').item(0).content;
                        // console.log(token);

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
                        form.setAttribute("action", "http://192.168.10.10/schedule/outputcsv");
                        form.setAttribute("method", "post");
                        form.style.display = "none";
                        document.body.appendChild(form);
                        // data = {'2' : '2', '3' :'3'};
                        // // パラメタの設定
                        // if (data !== undefined) {
                        //   for (var paramName in data) {
                        //   var input = document.createElement('input');
                        //   input.setAttribute('type', 'hidden');
                        //   input.setAttribute('name', 'status['+ paramName +']');
                        //   input.setAttribute('value', data[paramName]);
                        //   form.appendChild(input);
                        //   }
                        // }
                        var input = document.createElement('input');
                        input.setAttribute('type', 'hidden');
                        input.setAttribute('name', 'user_id');
                        input.setAttribute('value', user_id);
                        form.appendChild(input);
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

  $(function() {
  var headNav = $("#sub");
  // headNav.css({"top": '-200px'});
	// scrollだけだと読み込み時困るのでloadも追加
	// $(window).on('load scroll', function () {
  $('#sub_gamen').click(
    function(){
		//現在の位置が500px以上かつ、クラスfixedが付与されていない時
		// if($(this).scrollTop() > 500 && headNav.hasClass('fixed') == false) {
      headNav.css({"display": 'block'});
			//headerの高さ分上に設定
			// headNav.css({"top": '-100px'});
			//クラスfixedを付与
			// headNav.addClass('fixed');
			//位置を0に設定し、アニメーションのスピードを指定
			// headNav.animate({"top": 50},600);
		// }
		//現在の位置が300px以下かつ、クラスfixedが付与されている時にfixedを外す
		// else if($(this).scrollTop() < 300 && headNav.hasClass('fixed') == true){
			// headNav.removeClass('fixed');
		// }
  });
  $('#sub_close').click(
    function(){
		//現在の位置が500px以上かつ、クラスfixedが付与されていない時
		// if($(this).scrollTop() > 500 && headNav.hasClass('fixed') == false) {
      headNav.css({"display": 'none'});
			//headerの高さ分上に設定
			// headNav.css({"top": '-200px'});
			//クラスfixedを付与
			// headNav.addClass('fixed');
			//位置を0に設定し、アニメーションのスピードを指定
			// headNav.animate({"top": 0},600);
		// }
		//現在の位置が300px以下かつ、クラスfixedが付与されている時にfixedを外す
		// else if($(this).scrollTop() < 300 && headNav.hasClass('fixed') == true){
			// headNav.removeClass('fixed');
		// }
	});
});

</script>
</head>
<body>

  <header class="cd-main-header text-center flex flex-column flex-center">
    <!--
    <p class="margin-top-md margin-bottom-xl">👈 <a class="cd-article-link" href="https://codyhouse.co/gem/schedule-template">Article &amp; Download</a></p>
    -->

    <h1 class="text-xl"><?php if(isset($date)){echo $date;}else{echo date("yy-m-d");} ?>の予定表</h1><a href="/">カレンダーに戻る</a>

    <!--
    <a href="{{ action('ScheduleController@create', 1) }}">スケジュールを登録する</a>
    <a href="http://192.168.10.10/schedule/1">スケジュールを登録する(url)</a> 
    -->
    <?php if(isset($result)){
      // var_dump("result is");
      // var_dump($result);
    }?>
    <?php if(isset($date)){
      // var_dump("date is");
      // var_dump($date);
    }?>
    <?php if(isset($user)){
      // var_dump("user is");
      // var_dump($user);
    }?>
  </header>

  <div id="sub">
	<nav class="g-nav">
		<ul class="g-nav-menu">
    <table style="margin:0 auto;">
    
    <form action="{{ url('/schedule/insert')}}" method="POST" class="form-horizontal" onsubmit="submitAfterCheckZikoku();return false;">
      @csrf
      <tr>
        <td align="right">
          開始時間：
        </td>
        <td align="left">
          <input type="time" name="start-time" id="start-time"><br>
        </td>
      </tr>
      <tr>
        <td align="right">
          終了時間：
        </td>
        <td align="left">
          <input type="time" name="end-time" id="end-time"><br>
        </td>
      </tr>
      <tr>
        <td align="right">
          タイトル：
        </td>
        <td align="left">
          <input type="textbox" name="title"><br>
        </td>
      </tr>
      <tr>
        <td align="right">
          内容：
        </td>
        <td align="left">
          <input type="textbox" name="naiyo"><br>
        </td>
      </tr>
      <tr>
        <td align="right">予定・実績：</td>
        <td align="left">
          <select name="type" id="type">
          <option value="yotei">予定</option>
          <option value="ziseki">実績</option>
          </select>
        </td>
      </tr>
      <!-- tagはあとでどうするか考える！ -->
      <!--
      <tr>
        <td align="right">タグ：</td>
        <td align="left"><input type="textbox" name="naiyo"><br></td>
      </tr>
      <br>
      -->
      <!-- デフォルトでは今日の日付（どうするか考える） -->
      <input type="hidden" name="date" value={{$date}}>
      <input type="hidden" name="user_id" value={{$user}}>
      <!-- <input type="hidden" name="date" value="<?php //if(isset($date)){echo $date;}else{echo date("yy-m-d");} ?>"> -->
    </table>
      <button type="submit" name="add">
        登録
      </button>
      
      <button type="button" name="sub_gamen" id="sub_close">  
        閉じる
      </button>
    </form>
    </ul>
	</nav>
  </div>

  <div style="text-align:center;">
    <button type="submit" name="sub_gamen" id="sub_gamen" class="btn btn-primary">  
      登録画面
    </button>
    <form  style="display:inline-block;" action="/" method="POST" class="form-horizontal" name="form1" onsubmit="CSVOutput();return false;">
      <button type="submit" name="csvoutput" id="csvoutput" class="btn btn-secondary">  
        ダウンロード
      </button>
      <?php if(isset($user)){ ?>
        <input type="hidden" name="user_id" value="<?= $user ?>">
      <?php }?>
    </form>
  </div>
</form>
  
  <div class="cd-schedule cd-schedule--loading margin-top-lg margin-bottom-lg js-cd-schedule">
    <div class="cd-schedule__timeline">
      <ul>
        <li><span>09:00</span></li>
        <li><span>09:30</span></li>
        <li><span>10:00</span></li>
        <li><span>10:30</span></li>
        <li><span>11:00</span></li>
        <li><span>11:30</span></li>
        <li><span>12:00</span></li>
        <li><span>12:30</span></li>
        <li><span>13:00</span></li>
        <li><span>13:30</span></li>
        <li><span>14:00</span></li>
        <li><span>14:30</span></li>
        <li><span>15:00</span></li>
        <li><span>15:30</span></li>
        <li><span>16:00</span></li>
        <li><span>16:30</span></li>
        <li><span>17:00</span></li>
        <li><span>17:30</span></li>
        <li><span>18:00</span></li>
        <!-- <li><span>18:30</span></li>
        <li><span>19:00</span></li>
        <li><span>19:30</span></li>
        <li><span>20:00</span></li> -->
      </ul>
    </div> <!-- .cd-schedule__timeline -->
  
    <div class="cd-schedule__events">
      <ul>
        <!--
        <li class="cd-schedule__group">
          <div class="cd-schedule__top-info"><span>Monday</span></div>
  
          <ul>
            <li class="cd-schedule__event">
              <a data-start="09:30" data-end="10:30" data-content="create" data-event="event-1" href="#0">
                <em class="cd-schedule__name">Abs Circuit</em>
              </a>
            </li>

            <li class="cd-schedule__event">
              <a data-start="10:00" data-end="11:00" data-content="create" data-event="event-1" href="#0">
                <em class="cd-schedule__name">Abs Circuit</em>
              </a>
            </li>

            <li class="cd-schedule__event">
              <a data-start="10:10" data-end="10:40" data-content="create" data-event="event-1" href="#0">
                <em class="cd-schedule__name">Abs Circuit</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="11:00" data-end="12:30" data-content="event-rowing-workout" data-event="event-2" href="#0">
                <em class="cd-schedule__name">Rowing Workout</em>
              </a>
            </li>
            <li class="cd-schedule__event">
              <a data-start="12:30" data-end="13:30" data-content="create" data-event="event-1" href="#0">
                <em class="cd-schedule__name">Abs Circuit</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="14:00" data-end="15:15"  data-content="event-yoga-1" data-event="event-3" href="#0">
                <em class="cd-schedule__name">Yoga Level 1</em>
              </a>
            </li>
          </ul>
        </li>
  
        <li class="cd-schedule__group">
          <div class="cd-schedule__top-info"><span>Tuesday</span></div>
  
          <ul>
            <li class="cd-schedule__event">
              <a data-start="10:00" data-end="11:00"  data-content="event-rowing-workout" data-event="event-2" href="#0">
                <em class="cd-schedule__name">Rowing Workout</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="11:30" data-end="13:00"  data-content="event-restorative-yoga" data-event="event-4" href="#0">
                <em class="cd-schedule__name">Restorative Yoga</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="13:30" data-end="15:00" data-content="event-abs-circuit" data-event="event-1" href="#0">
                <em class="cd-schedule__name">Abs Circuit</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="15:45" data-end="16:45"  data-content="event-yoga-1" data-event="event-3" href="#0">
                <em class="cd-schedule__name">Yoga Level 1</em>
              </a>
            </li>
          </ul>
        </li>
        -->
        
        <li class="cd-schedule__group">
          <div class="cd-schedule__top-info"><span>予定</span></div>
          <ul>
          <?php if(isset($schedules)){
          ?>
          @foreach($schedules as $schedule)
            <li class="cd-schedule__event">
              <a data-start="{{date('H:i',strtotime($schedule->from_time))}}" data-end="{{date('H:i',strtotime($schedule->to_time))}}"  data-content="create" data-event="event-1" href="#0" class="yotei" title={{$schedule->title}} content-id={{$schedule->id}} date={{$date}} user-id={{$user}} type="1">
                <em class="cd-schedule__name">{{$schedule->title}}</em>
              </a>
            </li>
          @endforeach
          <?php
          }?>
          </ul>
        </li>

        <li class="cd-schedule__group">
          <div class="cd-schedule__top-info"><span>実績</span></div>
          <ul>
          <?php if(isset($zisekis)){
          ?>
          @foreach($zisekis as $ziseki)
            <li class="cd-schedule__event">
              <a data-start="{{date('H:i',strtotime($ziseki->from_time))}}" data-end="{{date('H:i',strtotime($ziseki->to_time))}}"  data-content="create" data-event="event-1" href="#0" class="ziseki" title={{$ziseki->title}} content-id={{$ziseki->id}} date={{$date}} user-id={{$user}} type="2">
                <em class="cd-schedule__name">{{$ziseki->title}}</em>
              </a>
            </li>
          @endforeach
          <?php
          }?>
          </ul>
        </li>
  
        <!-- <li class="cd-schedule__group">
          <div class="cd-schedule__top-info"><span>Wednesday</span></div>
  
          <ul>
            <li class="cd-schedule__event">
              <a data-start="09:00" data-end="10:15" data-content="event-restorative-yoga" data-event="event-4" href="#0">
                <em class="cd-schedule__name">Restorative Yoga</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="10:45" data-end="11:45" data-content="event-yoga-1" data-event="event-3" href="#0">
                <em class="cd-schedule__name">Yoga Level 1</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="12:00" data-end="13:45"  data-content="event-rowing-workout" data-event="event-2" href="#0">
                <em class="cd-schedule__name">Rowing Workout</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="13:45" data-end="15:00" data-content="event-yoga-1" data-event="event-3" href="#0">
                <em class="cd-schedule__name">Yoga Level 1</em>
              </a>
            </li>
          </ul>
        </li> -->
  
        <!-- <li class="cd-schedule__group">
          <div class="cd-schedule__top-info"><span>Thursday</span></div>
  
          <ul>
            <li class="cd-schedule__event">
              <a data-start="09:30" data-end="10:30" data-content="event-abs-circuit" data-event="event-1" href="#0">
                <em class="cd-schedule__name">Abs Circuit</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="12:00" data-end="13:45" data-content="event-restorative-yoga" data-event="event-4" href="#0">
                <em class="cd-schedule__name">Restorative Yoga</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="15:30" data-end="16:30" data-content="event-abs-circuit" data-event="event-1" href="#0">
                <em class="cd-schedule__name">Abs Circuit</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="17:00" data-end="18:30"  data-content="event-rowing-workout" data-event="event-2" href="#0">
                <em class="cd-schedule__name">Rowing Workout</em>
              </a>
            </li>
          </ul>
        
  
        <li class="cd-schedule__group">
          <div class="cd-schedule__top-info"><span>Friday</span></div>
  
          <ul>
            <li class="cd-schedule__event">
              <a data-start="10:00" data-end="11:00"  data-content="event-rowing-workout" data-event="event-2" href="#0">
                <em class="cd-schedule__name">Rowing Workout</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="12:30" data-end="14:00" data-content="event-abs-circuit" data-event="event-1" href="#0">
                <em class="cd-schedule__name">Abs Circuit</em>
              </a>
            </li>
  
            <li class="cd-schedule__event">
              <a data-start="15:45" data-end="16:45"  data-content="event-yoga-1" data-event="event-3" href="#0">
                <em class="cd-schedule__name">Yoga Level 1</em>
              </a>
            </li>
          </ul>
        </li> -->
      </ul>
    </div>
  
    <div class="cd-schedule-modal">
      <header class="cd-schedule-modal__header">
        <div class="cd-schedule-modal__content">
          <span class="cd-schedule-modal__date"></span>
          <h3 class="cd-schedule-modal__name"></h3>
        </div>
  
        <div class="cd-schedule-modal__header-bg"></div>
      </header>
  
      <div class="cd-schedule-modal__body">
        <div class="cd-schedule-modal__event-info"></div>
        <div class="cd-schedule-modal__body-bg"></div>
      </div>
  
      <a href="#0" class="cd-schedule-modal__close text-replace">Close</a>
    </div>
  
    <div class="cd-schedule__cover-layer"></div>
  </div> <!-- .cd-schedule -->

  <div style="margin-left:10px;">累計時間の比較(1日)</div>
  <div id="chart"></div>
  <div style="margin-left:10px;">スケジュール遵守率(1日)</div>
  <div id="chart2"></div>

  <script src="{{ asset('/js/schedule-template/util.js') }}"></script> <!-- util functions included in the CodyHouse framework -->
  <script src="{{ asset('/js/schedule-template/main.js') }}"></script>
  <link rel = "stylesheet" type = "text/css" href = "https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.css">
  <script src = "http://d3js.org/d3.v3.min.js" charset = "utf-8"> </script>
  <script src = "https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.js"> </script>
  <script>
    // 時刻の入力チェックをしてから登録する
    function submitAfterCheckZikoku(){
      let start_time = document.getElementById("start-time").value;
      let end_time = document.getElementById("end-time").value;

      // 暫定的
      date1 = new Date("2020-04-01" + " " + start_time + ":00");
      date2 = new Date("2020-04-01" + " " + end_time + ":00");

      console.log(date1.getTime());
      console.log(date2.getTime());

      let diff = date2.getTime() - date1.getTime();
      console.log(diff);
      if(diff < 0){
        alert("終了時刻は開始時刻より後を指定してください");
        return false;
      }
      // submit()でフォームの内容を送信
      document.add.submit();
      // alert("正常です");
    }

    function array_key_exists ( key, search ) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Felix Geisendoerfer (http://www.debuggable.com/felix)
    // *     example 1: array_key_exists('kevin', {'kevin': 'van Zonneveld'});
    // *     returns 1: true
 
      // input sanitation
      if( !search || (search.constructor !== Array && search.constructor !== Object) ){
          return false;
      }
  
      return key in search;
    }


    // 予定の時間累計を出す
    let yotei_ruikei_zikan = 0;
    let yotei_zikan_elements = document.getElementsByClassName('yotei');
    console.log(yotei_zikan_elements[0]);

    let yotei_zikan_array = Array.prototype.slice.call(yotei_zikan_elements);

    yotei_zikan_array.forEach(function(element){
      let tmp_date = element.getAttribute("date");
      let tmp_yotei_zikan_start_time = element.getAttribute("data-start");
      let tmp_yotei_zikan_end_time = element.getAttribute("data-end");

      date1 = new Date(tmp_date + " " + tmp_yotei_zikan_start_time + ":00");
      date2 = new Date(tmp_date + " " + tmp_yotei_zikan_end_time + ":00");
      console.log(date1);

      const time1 = date2.getTime() - date1.getTime();
      const sabun_hun = Math.floor(time1 / (1000 * 60 ));

      console.log(sabun_hun);
      
      yotei_ruikei_zikan += sabun_hun;
    });

    // 実績の時間累計を出す
    let ziseki_ruikei_zikan = 0;
    let ziseki_zikan_elements = document.getElementsByClassName('ziseki');
    console.log(ziseki_zikan_elements[0]);

    let ziseki_zikan_array = Array.prototype.slice.call(ziseki_zikan_elements);

    ziseki_zikan_array.forEach(function(element){
      let tmp_date = element.getAttribute("date");
      let tmp_ziseki_zikan_start_time = element.getAttribute("data-start");
      let tmp_ziseki_zikan_end_time = element.getAttribute("data-end");

      date1 = new Date(tmp_date + " " + tmp_ziseki_zikan_start_time + ":00");
      date2 = new Date(tmp_date + " " + tmp_ziseki_zikan_end_time + ":00");
      console.log(date1);

      const time1 = date2.getTime() - date1.getTime();
      const sabun_hun = Math.floor(time1 / (1000 * 60 ));

      console.log(sabun_hun);
      
      ziseki_ruikei_zikan += sabun_hun;
    });
    
    // スケジュール遵守率の算出
    let yotei_sosu = yotei_zikan_array.length;
    let yotei_dori_count = 0;
    ziseki_zikan_array.forEach(function(element){
      let title = element.getAttribute("title");
      let ziseki_zikan_start_time = element.getAttribute("data-start");
      let ziseki_zikan_end_time = element.getAttribute("data-end");
      yotei_zikan_array.forEach(function(element2){
        if(title == element2.getAttribute("title")){
          console.log(element2);
          console.log(ziseki_zikan_start_time);
          console.log(element2.getAttribute("data-start"));
          console.log(ziseki_zikan_end_time);
          console.log(element2.getAttribute("data-end"));
          if(ziseki_zikan_start_time == element2.getAttribute("data-start")
              && ziseki_zikan_end_time == element2.getAttribute("data-end")){
                yotei_dori_count = yotei_dori_count + 1;
              }
        }
      });
    });



    var chart = c3.generate({
    bindto: '#chart',
    data: {
      columns: [
        ['予定', yotei_ruikei_zikan],
        ['実績', ziseki_ruikei_zikan]
      ],
      type: 'bar'
    }
    });

    console.log(yotei_dori_count);
    console.log(yotei_sosu / yotei_dori_count);

    var chart2 = c3.generate({
    bindto: '#chart2',
    data: {
        // iris data from R
        columns: [
            ['予定達成', (yotei_dori_count/ yotei_sosu) * 100 ],
            ['予定達成できず', 100 - ((yotei_dori_count/ yotei_sosu) * 100)],
            // ['L', 60],
        ],
        type: 'pie'
    }
    });

    // setTimeout(function () {
    //     chart.transform('bar', 'data1');
    // }, 1000);

    // setTimeout(function () {
    //     chart.transform('bar', 'data2');
    // }, 2000);

    // setTimeout(function () {
    //     chart.transform('line');
    // }, 3000);

    // setTimeout(function () {
    //     chart.transform('bar');
    // }, 1000);
  </script>
</body>
</html>