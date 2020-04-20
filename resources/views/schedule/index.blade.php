<!doctype html>
<html lang="ja">
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
</style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>document.getElementsByTagName("html")[0].className += " js";</script>
  <link rel="stylesheet" href="{{ asset('/css/schedule-template/style.css') }}">
  <title>Schedule Template | CodyHouse</title>

  <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

<script>  
  $(function() {
  var headNav = $("#sub");
  // headNav.css({"top": '-200px'});
	//scrollだけだと読み込み時困るのでloadも追加
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

    <h1 class="text-xl"><?php if(isset($date)){echo $date;}else{echo date("yy-m-d");} ?>の予定表</h1>

    <!--
    <a href="{{ action('ScheduleController@create', 1) }}">スケジュールを登録する</a>
    <a href="http://192.168.10.10/schedule/1">スケジュールを登録する(url)</a> 
    -->
    <?php if(isset($result)){
      var_dump("result is");
      var_dump($result);
    }?>
    <?php if(isset($date)){
      var_dump("date is");
      var_dump($date);
    }?>
    <?php if(isset($user)){
      var_dump("user is");
      var_dump($user);
    }?>
  </header>

  <div id="sub">
	<nav class="g-nav">
		<ul class="g-nav-menu">
    <table style="margin:0 auto;">
    
    <form action="{{ url('/schedule/insert')}}" method="POST" class="form-horizontal">
      @csrf
      <tr>
        <td align="right">
          開始時間：
        </td>
        <td align="left">
          <input type="time" name="start-time"><br>
        </td>
      </tr>
      <tr>
        <td align="right">
          終了時間：
        </td>
        <td align="left">
          <input type="time" name="end-time"><br>
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
      <input type="hidden" name="date" value="<?php if(isset($date)){echo $date;}else{echo date("yy-m-d");} ?>">
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
  </div>
  
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
        <li><span>18:30</span></li>
        <li><span>19:00</span></li>
        <li><span>19:30</span></li>
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
              <a data-start="11:00" data-end="12:30" data-content="event-rowing-workout" data-event="event-2" href="#0">
                <em class="cd-schedule__name">Rowing Workout</em>
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
              <a data-start="{{date('H:i',strtotime($schedule->from_time))}}" data-end="{{date('H:i',strtotime($schedule->to_time))}}"  data-content="schedule/create" data-event="event-1" href="#0">
                <em class="cd-schedule__name">{{$schedule->text}}</em>
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
              <a data-start="{{date('H:i',strtotime($ziseki->from_time))}}" data-end="{{date('H:i',strtotime($ziseki->to_time))}}"  data-content="schedule/create" data-event="event-1" href="#0">
                <em class="cd-schedule__name">{{$ziseki->text}}</em>
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

  <script src="{{ asset('/js/schedule-template/util.js') }}"></script> <!-- util functions included in the CodyHouse framework -->
  <script src="{{ asset('/js/schedule-template/main.js') }}"></script>
</body>
</html>