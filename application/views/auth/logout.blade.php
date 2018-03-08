@layout('layouts.app')

@section('content')
<!-- InstanceBeginEditable name="Edit1" -->
<div id="contents" class="clearfix">
  <section>
    <p class="center-box">
      <span class="redb02"><br><br></span>
      <span class="tex14 redb02">{{__('messages.logout_finish1')}}</span>
    </p>
    <p class="center-box">
      <span class="tex14 redb02">{{__('messages.logout_finish2')}}</span>
    </p>
    <p class="center-box">
      <a href="{{ url('login') }}"><button type="button" style="font-size:1.4em;height:40px;width:200px">{{__('messages.login_title')}}</button></a>
      <br>
      <br>
      <br>
    </p>
  </section>
</div>
@endsection
