@layout('layouts.admin_app')

@section('content')
<!-- InstanceBeginEditable name="Edit1" -->
<div id="contents" class="clearfix">
  <section>
    <p class="center-box">
      <span class="redb02"><br><br></span>
      <span class="tex14 redb02">{{__('messages.logout_finish1')}}</span>
    </p>
    <p class="center-box">
      <span class="tex14 redb02"><a href="{{ url('admin/login') }}">{{__('messages.login_title')}}</a></span>
      <br>
      <br>
      <br>
    </p>
  </section>
</div>
@endsection
