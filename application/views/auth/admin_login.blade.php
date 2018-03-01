@layout('layouts.admin_app')

@section('content')
<!-- InstanceBeginEditable name="Edit1" -->
<div id="contents" class="clearfix">
  <section>
    <div id="form">
        {{Form::open('admin/login', 'post')}}
        {{Form::token()}}
        <table border="0" align="center" cellpadding="5" cellspacing="2" class="table1">
          @if ($errors->has('username'))
          <tr>
              <td colspan="2">
                  <p><strong>{{ $errors->first('username') }}</strong></p>
              </td>
          </tr>
          @endif
          @if ($errors->has('password'))
          <tr>
              <td colspan="2">
                  <p><strong>{{ $errors->first('password') }}</strong></p>
              </td>
          </tr>
          @endif
          <tr>
              <td align="center" class="td1"><p>{{__('messages.login_id_admin')}}</p></td>
              <td>
                  <p class="username">
                      {{ Form::text('username', $input['username'], array('id' => 'username', 'maxlength' => '32', 'autocomplete' => 'OFF', 'required', 'autofocus')) }}
                  </p>
              </td>
          </tr>
          <tr>
              <td align="center" class="td1"><p>{{__('messages.login_password')}}</p></td>
              <td>
                  <p class="password">
                      {{ Form::password('password', array('id' => 'password', 'maxlength' => '32', 'autocomplete' => 'OFF', 'required')) }}
                  </p>
              </td>
          </tr>
          <tr>
              <td colspan="2" align="center"><p class="submit">&nbsp;</p></td>
          </tr>
          <tr>
              <td colspan="2" align="center">
                <p class="submit">{{Form::submit(__('messages.login_button'));}}</p>
              </td>
          </tr>
        </table>
      {{Form::close()}}
    </div>
  </section>
</div>
@endsection
