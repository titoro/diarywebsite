<h3>スケジュール登録画面</h3>

<form action="{{ url('/dayschedule/insert')}}" method="POST" class="form-horizontal">
  @csrf
  
  開始時間：<input type="time" name="start-time"><br>
  終了時間：<input type="time" name="end-time"><br>
  内容：<input type="textbox" name="naiyo"><br>
  <button type="submit" name="add">
   登録
  </button>
</form>