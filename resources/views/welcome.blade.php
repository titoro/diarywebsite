<!--
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
-->

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
<link href='{{ asset('/css/core/main.css') }}' rel='stylesheet' />
<link href='{{ asset('/css/daygrid/main.css') }}' rel='stylesheet' />
<link href='{{ asset('/css/timegrid/main.css') }}' rel='stylesheet' />
<link href='{{ asset('/css/list/main.css') }}' rel='stylesheet' />
<script src='{{ asset('/js/core/main.js') }}'></script>
<!-- <script src='{{ asset('/js/core/main.min.js') }}'></script> -->
<script src='{{ asset('/js/interaction/main.js') }}'></script>
<script src='{{ asset('/js/daygrid/main.js') }}'></script>
<script src='{{ asset('/js/timegrid/main.js') }}'></script>
<script src='{{ asset('/js/list/main.js') }}'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    // デフォルトで表示するのは本日日付にする
    var today = new Date();
    // console.log(today);

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      height: 'parent',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      defaultView: 'dayGridMonth',
      defaultDate: today,
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2019-08-01',
        },
        {
          title: 'Long Event',
          start: '2019-08-07',
          end: '2019-08-10'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2019-08-09T16:00:00'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2019-08-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2019-08-11',
          end: '2019-08-13'
        },
        {
          title: 'Meeting',
          start: '2019-08-12T10:30:00',
          end: '2019-08-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2019-08-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2019-08-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2019-08-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2019-08-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2019-08-13T07:00:00'
        },
        {
          title: 'Click for Google',
          // url: 'http://google.com/',
          start: '2019-08-28',
          imageurl : '/storage/img/pen.png'
        }
      ]
    });

  // eventRender : function e(event, element) {
  // // １．追加するノードを作成（必要に応じて高さ等の属性を設定）
  // var addNode = document.createElement("img");
  // addNode.setAttribute("src", "/storage/img/pen.png");
  // addNode.setAttribute("height", "16");
  // alert("e");
  // // とりあえず追加する場合
  // for (var i = 0, len = element.context.childNodes.length; i < len; i++) {
  //   if (element.context.childNodes[i].className == 'fc-content') {
  //         element.context.childNodes[i].appendChild(addNode);
  //   }
  // }
  
  // // タイトルの直後に追加する場合
  // for (var i = 0, len = element.context.childNodes.length; i < len; i++) {
  //   if (element.context.childNodes[i].className == 'fc-content') {
  //     for (var j = 0, len = element.context.childNodes[i].childNodes.length; j < len; j++) {
  //       if (element.context.childNodes[i].childNodes[j].className == 'fc-title') {
  //           element.context.childNodes[i].childNodes[j].appendChild(addNode);
  //       }
  //     }
  //   }
  // }
  // }

    // console.log("aa");

    calendar.render();
  });
  
  // 参考URL:https://shimz.me/blog/fullcalendar/2475
  // $('#calendar').fullCalendar({
  //   eventRender: function(events, element) {
  //   if(events.img){
  //       $(element.context)  //imgプロパティが存在するイベントだけtitleを画像に差し替え
  //     .css("border-color", "transparent")
  //     .css("background-color", "transparent")
  //     .html('<img class="photo"  src="'+events.img+'" />');
  //         }
  //     },
  //     events: [
  //   {
  //       title: '通常のイベント',
  //       start: new Date(2020, 04, 15),
  //   },			
  //   {
  //       title: '画像　イベント',
  //       start: new Date(2020, 04, 1),
  //       img: "/storage/img/pen.png"
  //   },
  //   {
  //       title: '画像　イベント',
  //       start: new Date(2020, 04, 2),
  //       img: "/storage/img/pen.png"
  //   }
  //   ]
  // });

  // var calendar = new Calendar(calendarEl, {
  // events: [
  //   {
  //     title: 'My Event',
  //     start: '2020-04-01',
  //     description: 'This is a cool event'
  //   }
  //   // more events here
  // ],
  // eventRender: function(element, event) {
  //   // var tooltip = new Tooltip(info.el, {
  //   //   title: info.event.extendedProps.description,
  //   //   placement: 'top',
  //   //   trigger: 'hover',
  //   //   container: 'body'
  //   // });
  //   // １．追加するノードを作成（必要に応じて高さ等の属性を設定）
  //   var addNode = document.createElement("img");
  //   addNode.setAttribute("src", "/storage/img/pen.png");
  //   addNode.setAttribute("height", "16");
  //   // とりあえず追加する場合
  //   for (var i = 0, len = element.context.childNodes.length; i < len; i++) {
  //     if (element.context.childNodes[i].className == 'fc-content') {
  //           element.context.childNodes[i].appendChild(addNode);
  //     }
  //   }
  // }
  // });

  // eventRender: function eventRender(events, element) {
  //   if(events.img){
  //       $(element.context)  //imgプロパティが存在するイベントだけtitleを画像に差し替え
  //     .css("border-color", "transparent")
  //     .css("background-color", "transparent")
  //     .html('<img class="photo"  src="'+events.img+'" />');
  //         }
  //     },
  //     events: [
  //   {
  //       title: '通常のイベント',
  //       start: new Date(2020, 04, 15),
  //   },			
  //   {
  //       title: '画像　イベント',
  //       start: new Date(2020, 04, 1),
  //       img: "/storage/img/pen.png"
  //   },
  //   {
  //       title: '画像　イベント',
  //       start: new Date(2020, 04, 2),
  //       img: "/storage/img/pen.png"
  //   }
  //   ]
</script>
<style>

  html, body {
    overflow: hidden; /* don't do scrollbars */
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar-container {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .fc-header-toolbar {
    /*
    the calendar will be butting up against the edges,
    but let's scoot in the header's buttons
    */
    padding-top: 1em;
    padding-left: 1em;
    padding-right: 1em;
  }

</style>
</head>
<body>
        <!--
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
  -->
  
  <div id="user">test user</div>
  <div id='calendar-container'>
    <div id='calendar'></div>
  </div>
  
</body>
</html>
